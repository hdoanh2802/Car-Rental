<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_Info;

class AccountController extends Controller
{

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|min:8|max:12',
            'newpassword' => 'required|min:8|max:12|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            if (Hash::check($request->newpassword, $hashedPassword)) {
                return redirect()->back()->with(session()->flash('message', 'New password can not be the old password!'));
            }
            if (Hash::check($request->newpassword, '!=', $hashedPassword)) {
                $users = User::find(Auth::user()->id);
                $users->password = Hash::make($request->newpassword);
                $users->save();
                return redirect()->back()->with(session()->flash('message', 'Password updated successfully'));
            }
        }
        return redirect()->back()->with(session()->flash('message', 'Old password doesnt matched'));
    }

    public function updateAuth(Request $request)
    {
        $id =  Auth::user()->id;

        $user = User::find($id);
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Auth::user()->password;
        $user->status = Auth::user()->status;
        $user->save();

        $id_info = Auth::user()->userInfo->id;

        $user_info = User_Info::find($id_info);
        $user_info->user_id = $user->id;
        $user_info->fullname = $request->input('fullname');
        $user_info->address = $request->input('address');
        $user_info->phone = $request->input('phone');
        $user_info->age = $request->input('age');
        $user_info->save();

        return redirect()->back()->with('message', 'User has been updated successfully');
    }
}
