<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function auth()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('github')->user();
            return redirect()->route('admin.dashboard')->with('success', 'Logged in!');
        } catch (\Exception $e) {
            return redirect()->route('frontend.index')->with('error', 'Authentication failed.');
        }
    }
}
