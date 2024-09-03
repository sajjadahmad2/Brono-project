<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyApiController extends Controller
{
    protected $specificColumnsRelationships = [

    ];
    // 1. Get all properties
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $properties = Property::with($this->specificColumnsRelationships)->paginate($perPage);

        return response()->json($properties, 200);
    }

    // 2. Get a specific property by ID
    public function show($id)
    {
        $property = Property::with($this->specificColumnsRelationships)->find($id);

        if (!$property) {
            return response()->json(['error' => 'Property not found'], 404);
        }

        return response()->json($property, 200);
    }
    // 3. Get a specific Number of properties
    public function getLimitedProperties(Request $request)
    {

        $limit = $request->input('limit', 12);

        $properties = Property::with($this->specificColumnsRelationships)->limit($limit)->get();

        return response()->json($properties, 200);
    }
    // 4. Get a Price Sorted properties
    public function getPropertiesSortedByPrice(Request $request)
    {
        $sortDirection = $request->input('sort', 'asc');
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            return response()->json(['error' => 'Invalid sort direction'], 400);
        }

        $properties = Property::with($this->specificColumnsRelationships)->orderBy('price', $sortDirection)->get();

        return response()->json($properties, 200);
    }

    //5.Get a Product through search query
    public function search(Request $request)
    {
        // Get the search keyword from the query parameter
        $keyword = $request->input('keyword');

        // If no keyword is provided, return an error
        if (!$keyword) {
            return response()->json(['error' => 'No search keyword provided'], 400);
        }

        // Perform the search
        $properties = Property::with($this->specificColumnsRelationships)->where('location_detail', 'LIKE', "%{$keyword}%")
            ->orWhere('type', 'LIKE', "%{$keyword}%")
            ->orWhere('town', 'LIKE', "%{$keyword}%")
            ->orWhere('province', 'LIKE', "%{$keyword}%")
            ->get();

        // Return the results
        return response()->json($properties, 200);
    }
    //6.Get a distinct types
    public function getDistinctTypes()
    {

        $types = Property::select('type')->distinct()->pluck('type');

        if ($types->isEmpty()) {
            return response()->json(['message' => 'No property types found'], 404);
        }

        return response()->json($types, 200);
    }

    //7. Get properties by a specific type.

    public function getByType(string $type)
    {
        $properties = Property::searchByType($type)->with($this->specificColumnsRelationships)->get();
        if ($properties->isEmpty()) {
            return response()->json(['message' => 'No properties found for the specified type'], 404);
        }

        return response()->json($properties, 200);
    }

    //8.Get Properties Currency
    public function getpropertycurrency()
    {
        $types = Property::select('currency')->distinct()->pluck('currency');

        if ($types->isEmpty()) {
            return response()->json(['message' => 'No property currency found'], 404);
        }

        return response()->json($types, 200);
    }
    //9.Get a Filter items
    public function getFilterItems()
    {
        $allItems = [];
        $types = $location = $maxPrice = $minPrice = [];
        $types = Property::select('type')->distinct()->pluck('type');
        $locations = Property::select('location_detail')->distinct()->pluck('location_detail');
        $maxPrice = Property::max('price');
        $minPrice = Property::min('price');
        $allItem = [
            'types' => $types,
            'locations' => $locations,
            'maxPrice' => $maxPrice,
            'minPrice' => $minPrice,
        ];
        if ($types->isEmpty() && $location->isEmpty() && $maxPrice->isEmpty() && $minPrice->isEmpty()) {
            return response()->json(['message' => 'No property types found'], 404);
        }

        return response()->json($allItem, 200);
    }
    //10. Filter Properties Function
    public function filterproperty(Request $req)
    {

        $query = Property::query();
        // Keyword search
        if ($req->has('keyword') && !empty($req->keyword)) {
            $keyword = $req->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('ref', 'like', "%$keyword%")
                    ->orWhere('property_title', 'like', "%$keyword%");
            });
        }
        // Price range filter
        if ($req->has('priceRange') && !empty($req->priceRange)) {
            $priceRange = explode(';', $req->priceRange);
            if (count($priceRange) === 2) {
                $priceRange = $priceRange;
                $query->where(function ($q) use ($priceRange) {
                    $q->whereBetween('price', [(float) $priceRange[0], (float) $priceRange[1]]);
                });
            }
        }
        if ($req->has('priceFrom') && !empty($req->priceFrom)) {
            $priceFrom = $req->priceFrom;
            $query->where(function ($q) use ($priceFrom) {
                $q->whereBetween('price', '>=', (float) $priceFrom);
            });
        }
        if ($req->has('priceTo') && !empty($req->priceTo)) {
            $priceTo = $req->priceTo;
            $query->where(function ($q) use ($priceTo) {
                $q->whereBetween('price', '<=', (float) $priceTo);
            });
        }
        // Area range filter
        if ($req->has('areaRange') && !empty($req->areaRange)) {
            $areaRange = explode(';', $req->areaRange);
            if (count($areaRange) === 2) {
                $minArea = (float) $areaRange[0];
                $maxArea = (float) $areaRange[1];
                $query->whereHas('surfaceArea', function ($q) use ($minArea, $maxArea) {
                    $q->whereBetween('built', [$minArea, $maxArea])
                        ->orWhereBetween('plot', [$minArea, $maxArea]);
                });
            }
        }
        // Location filter
        if ($req->has('location') && !empty($req->location)) {
            $locations = $req->location;
            if (is_string($locations)) {
                $locations = json_decode($locations, true);
            } elseif (is_object($locations)) {
                $locations = (array) $locations;
            }
            $query->where(function ($q) use ($locations) {
                foreach ($locations as $location) {
                    $q->orWhere('location_detail', 'like', "%$location%");
                }
            });
        }
        // Property type filter
        if ($req->has('propertyType') && !empty($req->propertyType)) {
            $propertyTypes = $req->propertyType;
            if (is_string($propertyTypes)) {
                $propertyTypes = json_decode($propertyTypes, true);
            } elseif (is_object($propertyTypes)) {
                $propertyTypes = (array) $propertyTypes;
            }
            $query->where(function ($q) use ($propertyTypes) {
                foreach ($propertyTypes as $propertyType) {
                    $q->orWhere('type', 'like', "%$propertyType%");
                }
            });
        }
        // Category filter
        if ($req->has('category') && !in_array('all', $req->category)) {
            $categories = $req->category;
            if (is_string($categories)) {
                $categories = json_decode($categories, true);
            } elseif (is_object($categories)) {
                $categories = (array) $categories;
            }
            $query->where(function ($q) use ($categories) {
                $q->whereIn('new_build', $categories);
            });
        }
        if ($req->has('bedroom') && $req->bedroom != 'all') {
            $bedroom = $req->bedroom;
            $query->where(function ($q) use ($bedroom) {
                $q->where('beds', $bedroom);
            });
        }
        if ($req->has('bathroom') && $req->bathroom != 'all') {
            $bathroom = $req->bathroom;
            $query->where(function ($q) use ($bathroom) {
                $q->where('baths', $bathroom);
            });
        }
        if ($req->has('pool') && $req->pool != 'all') {
            $pool = $req->pool;
            $query->where(function ($q) use ($pool) {
                $q->where('pool', $pool);
            });
        }
        if ($req->has('ref') && $req->ref != 'all') {
            $ref = $req->ref;
            $query->where(function ($q) use ($ref) {
                $q->where('ref', 'like', "%$ref%");
            });
        }
        // Fetch results without pagination
        $properties = $query->orderBy('id', 'DESC')->get();

        return response()->json([
            'status' => 'success',
            'data' => $properties,
        ], 200, [
            'Content-Type' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest',
        ]);
    }

}
