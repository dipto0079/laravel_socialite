<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function login()
    {
        return Socialite::driver('github')->redirect();
    }

    public function redirect()
    {
        $gitUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'provider_id' => $gitUser->getId(),
        ], [
            'name' => $gitUser->getName(),
            'email' => $gitUser->getEmail(),
        ]);

        Auth::login($user, true);

        return to_route('dashboard');
    }
    
    public function dribbbleLogin()
    {
        return Socialite::driver('dribbble')->redirect();
    }

    public function dribbbleLRedirect()
    {
        $gitUser = Socialite::driver('dribbble')->user();

        $user = User::updateOrCreate([
            'dribbble_id' => $gitUser->getId(),
        ], [
            'name' => $gitUser->getName(),
            'email' => $gitUser->getEmail(),
        ]);

        Auth::login($user, true);

        return to_route('dashboard');
    }
}
