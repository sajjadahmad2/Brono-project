<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function manage(Request $req)
    {
        if ($req->ajax()) {
            $permission = Permission::find($req->permission);
            $role = Role::find($req->role);

            //dd($role);

            $check = DB::table('role_has_permissions')->where('role_id', $req->role)->where('permission_id', $req->permission)->first();

            if ($check) {
                $role->revokePermissionTo($permission->name);
            } else {
                $role->givePermissionTo($permission->name);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Permissions Updated Successfully!',
            ]);
        } else {
            $permissions = Permission::all();
            $roles = Role::all();

            return view('permissions.manage', get_defined_vars())->with('success','done done done done');
        }

    }
}
