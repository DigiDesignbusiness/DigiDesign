<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-roles')->only('allRoles');
        $this->middleware('can:create-role')->only('createRole', 'storeRole');
        $this->middleware('can:edit-role')->only('editRole', 'updateRole');
        $this->middleware('can:delete-role')->only('deleteRole');
    }

    public function allRoles(){
        $roles = Role::all();
        return view('admin.Roles.all-roles')->with('roles', $roles);
    }

    public function createRole(){
        $permissions = Permission::all();
        return view('admin.Roles.create-role')->with('permissions', $permissions);
    }

    public function storeRole(Request $request){

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lable' => ['nullable', 'string', 'max:255'],
            'permissions' => ['required', 'array']
        ]);

        $roles = Role::create($data);
        $roles->permissions()->sync($data['permissions']);

        Session::flash('statuscode', 'success');
        return redirect(route('all-roles'))->with('status', 'Role Created.');

    }

    public function editRole($id){
        $permissions = Permission::all();

        $roles = Role::find($id);
        return view('admin.Roles.edit-role')->with('roles', $roles)->with('permissions', $permissions);
    }

    public function updateRole(Request $request, $id){

        $roles = Role::find($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lable' => ['nullable', 'string', 'max:255'],
            'permissions' => ['required', 'array']
        ]);

        $roles->update($data);
        $roles->permissions()->sync($data['permissions']);

        if ($request->has('verify')) {
            $roles->markEmailAsVerified();
        }
        Session::flash('statuscode', 'info');
        return redirect(route('all-roles'))->with('status', 'Role Updated.');
    }

    public function deleteRole($id){
        $roles = Role::find($id);

        $roles->delete();
        return response()->json(['status'=>'Role Deleted.']);
    }
}
