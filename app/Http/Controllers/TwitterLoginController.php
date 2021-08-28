<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class TwitterLoginController extends Controller
{
    public function redirectToProvider(Request $request)
    {
        return Inertia::location(Socialite::driver('twitter')->redirect()->getTargetUrl());
    }

    public function handleProviderCallback(Request $request)
    {
        if ($request->input('error') == "access_denied") {
            return 'user has decline the authorization';
        } 

        $user = Socialite::driver('twitter')->user();
        dd($user);
    }
}
