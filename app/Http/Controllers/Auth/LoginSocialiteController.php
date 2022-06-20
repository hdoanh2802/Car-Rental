<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User_Info;
use DateTime;

class LoginSocialiteController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function loginWithGoogle()
    {
        try {

            $userGoogle = Socialite::driver('google')->user();

            $user = User::where('google_id', $userGoogle->id)->first();

            if ($user) {

                Auth::login($user);

                return redirect()->route('home.user')->with('message', 'login success');
            } else {
                $user_role = Role::where('name', 'user')->first();

                $newUser = new User();
                $newUser->username = $userGoogle->name;
                $newUser->email = $userGoogle->email;
                $newUser->google_id = $userGoogle->id;
                $newUser->status = User::STATUS_ACTIVATED;
                $newUser->password = encrypt('my-google');
                $newUser->is_verified = User::VERIFIED;
                $newUser->email_verified_at = time();
                $newUser->save();

                $newUser->roles()->attach($user_role);

                $user_info = new User_Info();
                $user_info->user_id = $newUser->id;
                $user_info->fullname = "";
                $user_info->age = "";
                $user_info->address = "";
                $user_info->phone = "";
                $user_info->save();

                Auth::login($newUser);

                return redirect()->route('home.user')->with('message', 'login success');
            }
        } catch (Exception $e) {
            return redirect()->route('login')->with('message', $e->getMessage());
        }
    }
}
