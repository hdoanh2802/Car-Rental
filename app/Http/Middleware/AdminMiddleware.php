<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            foreach (Auth::user()->roles as $role) {
                if ($role->name == "admin") {
                    return $next($request);
                }
                if ($role->name == "user") {
                    return redirect()->route('home.user')->with('message', "You are not admin");
                }
            }
        }
        return redirect()->route('login')->with('message', "Login details are not valid");
    }
}
