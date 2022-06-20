<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SignupEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public static function sendSignupEmail($username, $email, $verification_code)
    {
        $data = [
            'username' => $username,
            'verification_code' => $verification_code
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }
}
