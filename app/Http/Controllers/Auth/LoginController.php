<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Auth\MailController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Request as FacadesRequest;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User_Info;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    const LOGIN_SUCCESS = 'Logged in successfully';
    const LOGIN_FAIL = 'Login details are not valid';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:12',
        ]);

        $credentials = array_merge($request->only('email', 'password'), ['is_verified' => User::VERIFIED]);

        if (Auth::attempt($credentials)) {
            $request->session()->put('loginId', Auth::user());
            foreach (Auth::user()->roles as $role) {
                if ($role->name == "admin") {
                    Log::channel('login_admin_history')->info('Admin to login.', ['id' => Auth::user()->id]);
                    return redirect()->route('dashboard')->with('message', self::LOGIN_SUCCESS);
                }
                if ($role->name == "user") {
                    Log::info('User to login.', ['id' => Auth::user()->id]);
                    return redirect()->route('home.user')->with('message', self::LOGIN_SUCCESS);
                }
            }
        }

        return redirect()->back()->with('message', self::LOGIN_FAIL);
    }

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {

        $user_role = Role::where('name', 'user')->first();

        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:12|confirmed',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = time();
        $user->status = User::STATUS_ACTIVATED;
        $user->save();
     
        $user->roles()->attach($user_role);

        $user_info = new User_Info();
        $user_info->user_id = $user->id;
        $user_info->fullname = "";
        $user_info->address = "";
        $user_info->age = "";
        $user_info->phone = "";
        $user_info->save();

        if (!$user->save()) {
            Log::channel('signup_user_history')->info($this->getDataLog($request, $user));
        }

        if ($user != null) {
            MailController::sendSignupEmail($user->username, $user->email, $user->verification_code);
            return redirect()->back()->with(session()->flash('message', 'Your account has been create, please check email for verification link'));
        }
        return redirect()->back()->with(session()->flash('message', 'Wrong'));
    }

    public function verifyUser(Request $request)
    {
        $verification_code = FacadesRequest::get('code');
        $user = User::Where(['verification_code' => $verification_code])->first();
        if ($user != null) {
            $user->email_verified_at = time();
            $user->is_verified = User::VERIFIED;
            $user->save();
            return redirect()->route('login')->with(session()->flash('message', 'Your account is verified, please login'));
        }
        return redirect()->route('login')->with(session()->flash('message', 'Invalid verifucation code'));
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
