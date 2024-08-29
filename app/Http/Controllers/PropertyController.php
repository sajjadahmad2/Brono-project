<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Property;
use App\Models\PropertySurfaceArea;
use App\Services\PropertyImporter;
use Illuminate\Http\Request;
use App\Models\Opportunity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function list(Request $req)
    {
        $perpage = $req->input('perpage', 12);

        $query = Property::query();

        // Filtering logic
        if ($req->ajax()) {

            if ($req->has('keyword') && !empty($req->keyword)) {
                $keyword = $req->keyword;
                $query->where(function ($q) use ($keyword) {
                    $q->where('ref', 'like', "%$keyword%")->orWhere('title', 'like', "%$keyword%");

                });
            }

            if ($req->has('location') && $req->location != 'all') {
                $query->where('location_detail', $req->location);
            }

            if ($req->has('propertyType') && $req->type != 'all') {
                $query->where('type', $req->propertyType);
            }

            if ($req->has('category') && $req->category != 'all') {
                $query->where('new_build', $req->category);
            }

            if ($req->has('priceRange')) {
                $priceRange = explode(';', $req->priceRange);

                $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
            }
            // if ($req->filled('areaRange')) {
            //     $areaRange = explode(';', $req->areaRange);
            //     $minArea = round($areaRange[0] * 0.092903, 2);
            //     $maxArea = round($areaRange[1] * 0.092903, 2);
            //     $query->whereHas('surfaceArea', function($q) use ($minArea, $maxArea) {
            //         $q->whereBetween('built', [$minArea, $maxArea])
            //           ->orWhereBetween('plot', [$minArea, $maxArea]);
            //     });
            // }

            $properties = $query->orderBy('id', 'DESC')->paginate($perpage);
            dd($properties);
            return view('property.partials-list', compact('properties'))->render();
        }

        // Fetch distinct types, locations, and price range
        $properties = $query->orderBy('id', 'DESC')->paginate($perpage);
        $types = Property::select('type')->distinct()->pluck('type');
        $location_detail = Property::select('location_detail')->distinct()->pluck('location_detail');
        $maxPrice = Property::max('price');
        $minPrice = Property::min('price');
        $minBuilt = PropertySurfaceArea::min('built');
        $maxBuilt = PropertySurfaceArea::max('built');
        $minPlot = PropertySurfaceArea::min('plot');
        $maxPlot = PropertySurfaceArea::max('plot');
        $minAreaSqFt = round(min($minBuilt, $minPlot) / 0.092903, 2);
        $maxAreaSqFt = round(max($maxBuilt, $maxPlot) / 0.092903, 2);

        return view('property.list', get_defined_vars());
    }

    public function show(Property $property)
    {
        return view('property.show', compact('property'));

    }

    public function add()
    {
        return view('property.add', get_defined_vars());
    }

    public function oldsave(Request $request, $id = null)
    {

        $this->validate($request, [
            'ref' => 'required|string',
            'type' => 'required|string',
            'town' => 'required|string',
            'province' => 'required|string',
            'price' => 'required|numeric',
            'currency' => 'required|string',
            'location_detail' => 'required|string',
            'beds' => 'required|integer',
            'baths' => 'required|integer',
            'pool' => 'nullable',
            'url' => 'required|url',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'data.*.feature' => 'nullable|string',
            'energy_rating.consumption' => 'nullable|string',
            'energy_rating.emissions' => 'nullable|string',
            'surface_area.built' => 'nullable|numeric',
            'surface_area.plot' => 'nullable|numeric',
            'location.latitude' => 'nullable|numeric',
            'location.longitude' => 'nullable|numeric',
        ]);

        try {
            // Determine if we're creating or updating
            if ($id) {
                $property = Property::findOrFail($id);
                $property->update([
                    'ref' => (string) $request->ref,
                    'type' => (string) $request->type,
                    'town' => (string) $request->town,
                    'province' => (string) $request->province,
                    'price' => (float) $request->price,
                    'currency' => (string) $request->currency,
                    'location_detail' => (string) $request->location_detail,
                    'status' => (string) 1,
                    'user_id' => (int) login_id(),
                    'beds' => (int) $request->beds,
                    'baths' => (int) $request->baths,
                    'pool' => (bool) $request->pool,
                ]);
            } else {
                $property = Property::create([
                    'ref' => (string) $request->ref,
                    'type' => (string) $request->type,
                    'town' => (string) $request->town,
                    'province' => (string) $request->province,
                    'price' => (float) $request->price,
                    'currency' => (string) $request->currency,
                    'location_detail' => (string) $request->location_detail,
                    'status' => (string) 1,
                    'user_id' => (int) login_id(),
                    'beds' => (int) $request->beds,
                    'baths' => (int) $request->baths,
                    'pool' => (bool) $request->pool,
                ]);
            }

            // Process images if any
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $this->processImage($property, $image);
                }
            }

            // Process features if any
            if ($request->has('data')) {
                foreach ($request->data as $feature) {
                    if (isset($feature['feature'])) {
                        $property->features()->create(['feature' => (string) $feature['feature']]);
                    }
                }
            }

            // Process URLs if any
            if ($request->has('url')) {
                $property->urls()->updateOrCreate(['language' => 'en'], ['url' => $request->url]);
            }

            // Process descriptions if any
            if ($request->has('description')) {
                $property->descriptions()->updateOrCreate(['language' => 'en'], ['description' => $request->description]);
            }

            // Process energy rating if any
            if ($request->has('energy_rating')) {
                $property->energyRating()->updateOrCreate([], [
                    'consumption' => (string) $request->energy_rating['consumption'],
                    'emissions' => (string) $request->energy_rating['emissions'],
                ]);
            }

            // Process surface area if any
            if ($request->has('surface_area')) {
                $property->surfaceArea()->updateOrCreate([], [
                    'built' => (float) $request->surface_area['built'],
                    'plot' => (float) $request->surface_area['plot'],
                ]);
            }

            // Process location if any
            if ($request->has('location')) {
                $property->location()->updateOrCreate([], [
                    'longitude' => (float) $request->location['longitude'],
                    'latitude' => (float) $request->location['latitude'],
                ]);
            }

            return redirect()->route('property.list')->with('success', 'Property saved successfully.');
        } catch (\Exception $e) {
            Log::error('Error processing property: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while processing your request.']);
        }
    }
    public function save(Request $request, $id = null)
    {

        // $this->validate($request, [
        //     'ref' => 'required|string',
        //     'type' => 'required|string',
        //     'town' => 'required|string',
        //     'province' => 'required|string',
        //     'price' => 'required|numeric',
        //     'currency' => 'required|string',
        //     'location_detail' => 'required|string',
        //     'beds' => 'required|integer',
        //     'baths' => 'required|integer',
        //     'pool' => 'nullable',
        //     'url' => 'required|url',
        //     'description' => 'required|string',
        //     'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'data.*.feature' => 'nullable|string',
        //     'energy_rating.consumption' => 'nullable|string',
        //     'energy_rating.emissions' => 'nullable|string',
        //     'surface_area.built' => 'nullable|numeric',
        //     'surface_area.plot' => 'nullable|numeric',
        //     'location.latitude' => 'nullable|numeric',
        //     'location.longitude' => 'nullable|numeric',
        // ]);

        $feature_data = $request->feature;
        // dd(convertFeatureData($feature_data));

        try {
            // Determine if we're creating or updating
            if ($id) {
                $property = Property::findOrFail($id);
                $thumbnail = $property->thumbnail;
                if ($request->has('thumbnail') && !empty($request->thumbnail)) {
                    $thumbnail = uploadFile($request->thumbnail, 'uploads/properties/thumbnails', 'thumbnail-' . login_id() . '-' . time());
                }
                $property->update([
                    'ref' => (string) $request->ref,
                    'title' => (string) $request->title,
                    'type' => (string) $request->type,
                    'town' => (string) $request->town,
                    'province' => (string) $request->province,
                    'price' => (float) $request->price,
                    'currency' => (string) $request->currency,
                    'location_detail' => (string) $request->location_detail,
                    'status' => (string) 1,
                    'user_id' => (int) login_id(),
                    'beds' => (int) $request->beds,
                    'baths' => (int) $request->baths,
                    'pool' => (bool) $request->pool,
                    'thumbnail' => $thumbnail,
                ]);
            } else {
                $property = Property::create([
                    'ref' => (string) $request->ref,
                    'title' => (string) $request->title,
                    'type' => (string) $request->type,
                    'town' => (string) $request->town,
                    'province' => (string) $request->province,
                    'price' => (float) $request->price,
                    'currency' => (string) $request->currency,
                    'location_detail' => (string) $request->location_detail,
                    'status' => (string) 1,
                    'user_id' => (int) login_id(),
                    'beds' => (int) $request->beds,
                    'baths' => (int) $request->baths,
                    'pool' => (bool) $request->pool,
                    'thumbnail' => !empty($request->thumbnail) ? uploadFile($request->thumbnail, '/properties/thumbnails', 'thumbnail-' . login_id() . '-' . time()) : null,

                ]);
            }

            // Process images if any
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $this->processImage($property, $image);
                }
            }

            // Process features if any (changed by the tagify)
            // if ($request->has('data')) {
            //     foreach ($request->data as $feature) {
            //         if (isset($feature['feature'])) {
            //             $property->features()->create(['feature' => (string) $feature['feature']]);
            //         }
            //     }
            // }

            /* based on the tagify data */

            $features = $request->feature ?? '';
            if (!empty($features)) {
                $features = convertFeatureData($features);
                foreach ($features as $feature) {
                    $property->features()->create(['feature' => (string) $feature]);
                }
            }

            // Process URLs if any
            if ($request->has('url')) {
                $property->urls()->updateOrCreate(['language' => 'en'], ['url' => $request->url]);
            }

            // Process descriptions if any
            if ($request->has('description')) {
                $property->descriptions()->updateOrCreate(['language' => 'en'], ['description' => $request->description]);
            }

            // Process energy rating if any
            if ($request->has('energy_rating')) {
                $property->energyRating()->updateOrCreate([], [
                    'consumption' => (string) $request->energy_rating['consumption'],
                    'emissions' => (string) $request->energy_rating['emissions'],
                ]);
            }

            // Process surface area if any
            if ($request->has('surface_area')) {
                $property->surfaceArea()->updateOrCreate([], [
                    'built' => (float) $request->surface_area['built'],
                    'plot' => (float) $request->surface_area['plot'],
                ]);
            }

            // Process location if any
            if ($request->has('location')) {
                $property->location()->updateOrCreate([], [
                    'longitude' => (float) $request->location['longitude'],
                    'latitude' => (float) $request->location['latitude'],
                ]);
            }

            return redirect()->route('property.list')->with('success', 'Property saved successfully.');
        } catch (\Exception $e) {
            Log::error('Error processing property: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while processing your request.']);
        }
    }
    protected function processImage(Property $property, $image)
    {
        $folderPath = 'images/properties';
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }
        try {

            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs($folderPath, $filename);
            $property->images()->create(['url' => $path]);
            return $path;
        } catch (\Exception $e) {
            Log::error('Error processing image: ' . $e->getMessage());
            throw $e; // Rethrow to trigger rollback
        }
    }

    public function oldedit(Request $property, $id)
    {
        $property = Property::find($id);

        return view('property.add', get_defined_vars());
    }
    public function edit(Request $property, $id)
    {
        $property = Property::find($id);
        $features = $property->features->pluck('feature')->toArray();
        //  dd($features);
        $features = convertFeatureData($features, 'toJson');
        return view('property.add', get_defined_vars());
    }
    public function delete($id)
    {
        $property = Property::find($id);
        $property->delete();
        return redirect()->route('property.list');
    }

    public function status($id)
    {
        $property = Property::find($id);
        $property->status = $property->status == 1 ? 0 : 1;
        $property->save();
        return redirect()->back()->with('success', 'Status Changed Successfully!');
    }
    public function import(Request $request)
    {
        // Store the uploaded file in the storage folder
        $filePath = $request->file('xmlFile')->storeAs('uploads', 'properties' . time() . '.xml');

        // Instantiate the PropertyImporter service
        $importer = new PropertyImporter();
        $path = storage_path('app/' . $filePath);

        $importer->importLargeXML($path);

        return redirect()->route('property.list');
    }

// New Funtion
    // use App\Models\Property; // Make sure to import your Property model

    public function showAllLocationImages()
    {
        // Fetch all properties with their image URLs, longitude, and latitude

        return view('property.list', compact('properties'));
    }
    public function importLeads(Request $request)
    { set_time_limit(3000000);
        $chunk = $request->input('chunk');
        $chunkIndex = $request->input('chunkIndex');
        $totalChunks = $request->input('totalChunks');

        // Decode the chunk data
        $chunkData = json_decode($chunk, true);
        // Process the chunk data
        foreach ($chunkData as $leadData) {

            Opportunity::updateOrCreate(
                ['ghl_opportunity_id' => isset($leadData['id']) ? $leadData['id'] : null],
                [
                    'location_id' => isset($leadData['locationId']) ? $leadData['locationId'] : null,
                    'assigned_to' => isset($leadData['assignedTo']) ? $leadData['assignedTo'] : null,
                    'contact_id' => isset($leadData['contactId']) ? $leadData['contactId'] : null,
                    'monetary_value' => isset($leadData['monetaryValue']) ? $leadData['monetaryValue'] : null,
                    'name' => isset($leadData['name']) ? $leadData['name'] : null,
                    'pipeline_id' => isset($leadData['pipelineId']) ? $leadData['pipelineId'] : null,
                    'pipeline_stage_id' => isset($leadData['pipelineStageId']) ? $leadData['pipelineStageId'] : null,
                    'source' => isset($leadData['source']) ? $leadData['source'] : null,
                    'status' => isset($leadData['status']) ? $leadData['status'] : null,
                    'date_added' => isset($leadData['createdAt']) ? \Carbon\Carbon::createFromTimestampMs($leadData['createdAt']) : null,
                ]
            );
            // Contact::updateOrCreate(
            //     ['ghl_contact_id' =>isset($leadData['id']) ? $leadData['id'] : null],
            //     [
            //         'location_id' => isset($leadData['locationId']) ? $leadData['locationId'] : null,
            //         'name' => isset($leadData['contactName']) ? $leadData['contactName'] : null,
            //         'email' => isset($leadData['email']) ? $leadData['email'] : null,
            //         'phone' => isset($leadData['phone']) ? $leadData['phone'] : null,
            //         'address' => isset($leadData['address_1']) ? $leadData['address_1'] : null,
            //         'city' => isset($leadData['city']) ? $leadData['city'] : null,
            //         'state' => isset($leadData['state']) ? $leadData['state'] : null,
            //         'country' => isset($leadData['country']) ? $leadData['country'] : null,
            //         'postal_code' => isset($leadData['postalCode']) ? $leadData['postalCode'] : null,
            //         'company' => isset($leadData['companyName']) ? $leadData['companyName'] : null,
            //         'website' => isset($leadData['website']) ? $leadData['website'] : null,
            //         'source' => isset($leadData['source']) ? $leadData['source'] : null,
            //         'type' => isset($leadData['type']) ? $leadData['type'] : null,
            //         'assigned_to' => isset($leadData['assignedTo']) ? $leadData['assignedTo'] : null,
            //         'tags' => isset($leadData['tags']) ? (is_array($leadData['tags']) ? $leadData['tags'] : explode(', ', $leadData['tags'])) : [],
            //         'followers' => isset($leadData['followers']) ? (is_array($leadData['followers']) ? $leadData['followers'] : explode(', ', $leadData['followers'])) : [],
            //         'additional_emails' => isset($leadData['additionalEmails'])
            //         ? (is_array($leadData['additionalEmails'])
            //             ? $leadData['additionalEmails']
            //             : explode(', ', $leadData['additionalEmails']))
            //         : [],

            //     'attributions' => isset($leadData['attributions'])
            //         ? (is_array($leadData['attributions'])
            //             ? $leadData['attributions']
            //             : explode(', ', $leadData['attributions']))
            //         : [],

            //     'custom_fields' => isset($leadData['customFields'])
            //         ? (is_array($leadData['customFields'])
            //             ? $leadData['customFields']
            //             : explode(', ', $leadData['customFields']))
            //         : [],
            //         'dnd' => isset($leadData['dnd']) ? $leadData['dnd'] : false,
            //         'dnd_settings_email' => isset($leadData['dndSettings']['email']) ? $leadData['dndSettings']['email'] : null,
            //         'dnd_settings_sms' => isset($leadData['dndSettings']['sms']) ? $leadData['dndSettings']['sms'] : null,
            //         'dnd_settings_call' => isset($leadData['dndSettings']['call']) ? $leadData['dndSettings']['call'] : null,
            //         'date_added' => isset($leadData['dateAdded']) ? \Carbon\Carbon::createFromTimestampMs($leadData['dateAdded']) : null,
            //         'date_updated' => isset($leadData['dateUpdated']) ? \Carbon\Carbon::createFromTimestampMs($leadData['dateUpdated']) : null,
            //         'date_of_birth' => isset($leadData['dateOfBirth']) ? $leadData['dateOfBirth'] : null,
            //     ],
            // );
        }

        return response()->json(['message' => 'Chunk processed successfully']);
    }

}
