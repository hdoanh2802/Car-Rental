<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use App\Models\User_Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Row;

class UserController extends Controller
{

    public function index(HttpFoundationRequest $request)
    {
        $search = $request->get('username');
        if ($search != "") {
            $users =  User::where('username', 'like', '%' . $search . '%')->paginate(5);
            // if ($users) {
            //     Session::flash('status', 'User not found');
            // }
        }
        if ($search == "") {
            $users = User::orderByDesc('id')->paginate(5);
        }

        return view('admin.user.list-user', compact('users', 'search'));
    }

    public function create()
    {
        $status = User::STATUS;
        $role = Role::all();

        return view('admin.user.add-user', compact('status', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:12',
        ]);

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->status = $request->input('status');
        $user->is_verified = User::VERIFIED;
        $user->save();

        $role = new Role_User();
        $role->user_id = $user->id;
        $role->role_id = $request->input('role_id');
        $role->save();

        $user_info = new User_Info();
        $user_info->user_id = $user->id;
        $user_info->fullname = $request->input('fullname');
        $user_info->address = $request->input('address');
        $user_info->phone = $request->input('phone');
        $user_info->age = $request->input('age');
        $user_info->save();

        return redirect()->route('user.list')->with('message', 'New user has been added successfully');
    }

    public function edit($id)
    {
        $user =  User::find($id);
        $status = User::STATUS;
        $role = Role::all();

        return view('admin.user.edit-user', compact('user', 'status', 'role'));
    }

    public function update($id, Request $request)
    {
        $user =  User::find($id);
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->status = $request->input('status');
        $user->save();

        $role = Role_User::where('user_id', $user->id)->first();
        if ($role != null) {
            $role->role_id = $request->input('role_id');
            $role->user_id = $user->id;
            $role->save();
        }
        if ($role == null) {
            $role = new Role_User();
            $role->role_id = $request->input('role_id');
            $role->user_id = $user->id;
            $role->save();
        }

        $user_info =  User_Info::where('user_id', $user->id)->first();
        $user_info->user_id = $user->id;
        $user_info->fullname = $request->input('fullname');
        $user_info->address = $request->input('address');
        $user_info->phone = $request->input('phone');
        $user_info->age = $request->input('age');
        $user_info->save();

        return redirect()->route('user.list')->with('message', 'User has been updated successfully');
    }

    public function delete($id)
    {
        $role = Role_User::where('user_id', $id)->first();
        if ($role != null) {
            $role->delete();
        }
        User_Info::where('user_id', $id)->first()->delete();
        User::find($id)->delete();

        return redirect()->route('user.list')->with('message', 'User has been deleted successfully');
    }
}
