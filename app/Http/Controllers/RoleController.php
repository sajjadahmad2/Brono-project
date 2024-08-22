<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function list(Request $req)
    {
        if ($req->ajax()) {
            $query = Role::orderBy('id', 'DESC')
            ->where(function($query) {
                $query->where('name', '!=', 'admin')
                      ->where('name', '!=', 'superadmin');
            });


            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->editColumn('id', function ($row) {
                    return setting('role_prefix') . $row->id;
                })
                ->editColumn('name', function ($row) {
                    return setting('role_prefix') . $row->name;
                })
                ->addColumn('action', function ($row) {
                    $html ='';
                    if (Auth::user()->can('edit role')) {
                        $html.= '
                                 <a href="' . route('role.edit', $row->id) . '" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                        ';
                    }
                    if (Auth::user()->can('delete role')){
                        $html.= '
                                 <a href="' . route('role.delete', $row->id) . '" onclick="event.preventDefault(); deleteMsg(\'' . route('role.delete', $row->id) . '\')"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                        ';
                    }

                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('role.list', get_defined_vars());
    }

    public function add()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('role.add', get_defined_vars());
    }

    public function edit($id = null)
    {
        $data = Role::find($id);

        return view('role.edit', get_defined_vars());
    }

    public function save(Request $req, $id = null)
    {

        $req->validate([
            'name' => 'required',
        ]);

        if (is_null($id)) {
            Role::create([
                'name' => $req->name,
            ]);

            $msg = "Record Added Successfully!";
        } else {
            Role::find($id)->update([
                'name' => $req->name,

            ]);

            $msg = "Record Edited Successfully!";
        }

        return redirect()->back()->with('success', $msg);
    }

    public function delete($id = null)
    {
        Role::find($id)->delete();

        return redirect()->back()->with('success', 'Record Delete Successfully!');
    }
}
