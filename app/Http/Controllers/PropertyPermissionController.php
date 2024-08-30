<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PropertyPermission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PropertyPermissionController extends Controller
{
    /**
     * Display a listing of the property permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = PropertyPermission::with('company')->get();
        return view('property_permissions.index', compact('permissions'));
    }
    public function manage(Request $req)
    {

        $tables = ['properties', 'property_description', 'property_features','property_urls','property_surface_areas','property_descriptions','property_energy_ratings'];
        $ignoreColumns = ['id', 'user_id', 'created_at', 'updated_at','status','property_id','language'];

        $allColumns = [];

        // Fetch columns from each table
        foreach ($tables as $table) {
            $columns = \DB::getSchemaBuilder()->getColumnListing($table);
            // Merge and filter the columns to exclude unwanted ones
            $allColumns = array_merge($allColumns, array_diff($columns, $ignoreColumns));
        }
        dd($allColumns);
        foreach ($columns as $column) {
            $exists = PropertyPermission::where('column_name', $column)
                ->exists();

            if (!$exists) {
                PropertyPermission::create([
                    'column_name' => $column,
                    'editable' => 1,
                    'company_id' => 4,
                ]);
            }
        }
        if ($req->ajax()) {
            $permission = PropertyPermission::find($req->permission);
            if ($permission) {
                $permission->editable = $permission->editable ? 0 : 1;
                $permission->save();
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Permission not found!',
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Permissions Updated Successfully!',
            ]);
        } else {

            $permissions = PropertyPermission::all();
            $roles = Role::all();

            return view('propertyPermissions.manage', get_defined_vars())->with('success', 'Permissions management updated successfully!');
        }

    }
    /**
     * Show the form for creating a new property permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('property_permissions.create', compact('companies'));
    }

    /**
     * Store a newly created property permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'column_name' => 'required|string|max:255',
            'editable' => 'required|integer|in:0,1',
            'company_id' => 'required|exists:companies,id',
        ]);

        PropertyPermission::create($request->all());

        return redirect()->route('property_permissions.index')
            ->with('success', 'Property Permission created successfully.');
    }

    /**
     * Show the form for editing the specified property permission.
     *
     * @param  \App\Models\PropertyPermission  $propertyPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyPermission $propertyPermission)
    {
        $companies = Company::all();
        return view('property_permissions.edit', compact('propertyPermission', 'companies'));
    }

    /**
     * Update the specified property permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyPermission  $propertyPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyPermission $propertyPermission)
    {
        $request->validate([
            'column_name' => 'required|string|max:255',
            'editable' => 'required|integer|in:0,1',
            'company_id' => 'required|exists:companies,id',
        ]);

        $propertyPermission->update($request->all());

        return redirect()->route('property_permissions.index')
            ->with('success', 'Property Permission updated successfully.');
    }

    /**
     * Remove the specified property permission from storage.
     *
     * @param  \App\Models\PropertyPermission  $propertyPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyPermission $propertyPermission)
    {
        $propertyPermission->delete();

        return redirect()->route('property_permissions.index')
            ->with('success', 'Property Permission deleted successfully.');
    }
}
