<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function list(Request $req)
    {
        if ($req->ajax()) {
            $query = User::with('roles')->where('id','!=',1)->orderBy('id', 'DESC');
            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->editColumn('first_name', function($row) {
                    return setting('user_prefix').$row->first_name;
                })
                ->editColumn('last_name', function($row) {
                    return setting('user_prefix').$row->last_name;
                })
                ->editColumn('email', function($row) {
                    return setting('user_prefix').$row->email;
                })
                ->editColumn('role', function($row) {
                    return $row->roles[0]->name;
                })

                ->editColumn('status', function($row) {
                    return $row->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })

                // enable_designa a tag with route
                ->editColumn('enable_design', function($row) {
                    $icon = $row->enable_design == 1 ? 'fas fa-eye" title="Enable Design' : 'fas fa-eye-slash" title="Disable Design';
                    $class = $row->enable_design == 1 ? 'btn btn-success btn-sm' : 'btn btn-danger btn-sm';
                    $text = $row->enable_design == 1 ? 'Enabled' : 'Disabled';
                    // return '<a href="' . route('user.enable_design', $row->id) . '" class="' . $class . '
                    return ' <a href="' . route('user.enable_design', $row->id) . '" class="'.$class.'" onclick="event.preventDefault(); designMsg(\'' .route('user.enable_design', $row->id) . '\')">
                    <i class="' . $icon . '"></i> ' . $text . '

                    </a> ';

                })

                ->addColumn('action', function($row) {
                     return generateActionButtons($row, 'user.edit', 'user.delete', 'user.status', 'button');
                })
                ->rawColumns(['action','status','enable_design'])
                ->make(true);
        }

        $users = User::where('id','!=',1)->get();
        return view('user.list', get_defined_vars());
    }

    public function add()
    {
        $roles = Role::all();
        return view('user.add', get_defined_vars());
    }

    public function edit($id = null)
    {
        $data = User::find($id);
        $roles= Role::all();
        return view('user.edit', get_defined_vars());
    }

 public function save(Request $req, $id = null)
{
    $validationRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'location_id' => 'required',
    ];

    if (is_null($id)) {
        $validationRules['password'] = 'required';
    }

    $req->validate($validationRules);

    $userData = $req->only(['first_name', 'last_name', 'email','location_id']);
    
    if (is_null($id)) {
        $userData['password'] = bcrypt($req->password);
        $userData['role'] = 1;
        $user = User::create($userData);
        $user->assignRole(2);
        $msg = "Record Added Successfully!";
    } else {
        $user = User::findOrFail($id);
        $user->update($userData);
        $msg = "Record Edited Successfully!";
    }

    return redirect()->route('user.list')->with('success', $msg);
}


    public function delete($id = null)
    {
        User::find($id)->delete();

        return redirect()->back()->with('success', 'Record Delete Successfully!');
    }


    public function status($id = null)
    {
        $user = User::find($id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'Status Changed Successfully!');
    }

    function enableDesign($id = null)
    {
        $user = User::find($id);
        $user->enable_design = $user->enable_design == 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'Design Enabled Successfully!');
    }

}
