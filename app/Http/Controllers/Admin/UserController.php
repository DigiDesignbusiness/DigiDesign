<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-users')->only('allUsers');
        $this->middleware('can:create-user')->only('createUser', 'storeUser');
        $this->middleware('can:edit-user')->only('editUser', 'updateUser');
        $this->middleware('can:delete-user')->only('deleteUser');
    }

    public function allUsers()
    {
        $users = User::all();

        return view('admin.users.all-users')->with('users', $users);
    }

    public function createUser()
    {
        return view('admin.users.create-user');
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $user = User::create($data);

        if ($request->has('verify')) {
            $user->markEmailAsVerified();
        }
        Session::flash('statuscode', 'success');
        return redirect(route('all-users'))->with('status', 'User Created.');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.users.edit-user')->with('user', $user);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
        ]);

        if (!is_null($request->password)) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);
            $data['password'] = $request->password;
        }
        
        $user->update($data);

        if ($request->has('verify')) {
            $user->markEmailAsVerified();
        }
        Session::flash('statuscode', 'info');
        return redirect(route('all-users'))->with('status', 'User Updated.');
    } 
    

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return response()->json(['status'=>'User Deleted.']);
    }
}
