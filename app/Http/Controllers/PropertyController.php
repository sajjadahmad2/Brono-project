<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\PropertyImporter;
use Illuminate\Http\Request;
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
            if ($req->filled('keyword')) {
                $keyword = $req->keyword;
                $query->where(function ($q) use ($keyword) {
                    $q->where('ref', 'like', "%$keyword%")->orWhere('title', 'like', "%$keyword%")
                        ->orWhere('description', 'like', "%$keyword%");
                });
            }

            if ($req->filled('location') && $req->location != 'all') {
                $query->where('location_detail', $req->location);
            }

            if ($req->filled('type') && $req->type != 'all') {
                $query->where('type', $req->type);
            }

            if ($req->filled('category') && $req->category != 'all') {
                $query->where('new_build', $req->category);
            }

            if ($req->filled('price_range')) {
                $priceRange = explode(',', $req->price_range);
                $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
            }

            $properties = $query->orderBy('id', 'DESC')->paginate($perpage);
            return view('property.partials-list', compact('properties'))->render();
        }

        // Fetch distinct types, locations, and price range
        $properties = $query->orderBy('id', 'DESC')->paginate($perpage);
        $types = Property::select('type')->distinct()->pluck('type');
        $location_detail = Property::select('location_detail')->distinct()->pluck('location_detail');
        $maxPrice = Property::max('price');
        $minPrice = Property::min('price');

        return view('property.list', compact('properties', 'types', 'location_detail', 'maxPrice', 'minPrice'));
    }

    public function show(Property $property)
    {
        return view('property.show', compact('property'));

    }

    public function add()
    {
        return view('property.add');
    }

    public function save(Request $request, $id = null)
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

    public function edit(Request $property, $id)
    {
        $property = Property::find($id);

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
        //    $request->validate([
        //         'xmlFile' => 'required|file|mimes:xml|max:10240', // Max 10MB
        //     ]);

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

}
