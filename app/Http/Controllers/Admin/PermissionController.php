<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-permissions')->only('allPermissions');
        $this->middleware('can:create-permission')->only('createPermission', 'storePermission');
        $this->middleware('can:edit-permission')->only('editPermission', 'updatePermission');
        $this->middleware('can:delete-permission')->only('deletePermission');
    }

    public function allPermissions(){
        $permissions = Permission::all();
        return view('admin.Permissions.all-permission')->with('permissions', $permissions);
    }

    public function createPermission(){
        return view('admin.Permissions.create-permission');
    }

    public function storePermission(Request $request){

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lable' => ['nullable', 'string', 'max:255'],
        ]);

        Permission::create($data);

        Session::flash('statuscode', 'success');
        return redirect(route('all-permissions'))->with('status', 'Permission Created.');

    }

    public function editPermission($id){
        $permission = Permission::find($id);
        return view('admin.permissions.edit-permission')->with('permission', $permission);
    }

    public function updatePermission(Request $request, $id){

        $permission = Permission::find($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lable' => ['nullable', 'string', 'max:255'],
        ]);

        $permission->update($data);

        if ($request->has('verify')) {
            $permission->markEmailAsVerified();
        }
        Session::flash('statuscode', 'info');
        return redirect(route('all-permissions'))->with('status', 'Permission Updated.');
    }

    public function deletePermission($id){
        $permission = Permission::find($id);

        $permission->delete();
        return response()->json(['status'=>'permission Deleted.']);
    }
}
