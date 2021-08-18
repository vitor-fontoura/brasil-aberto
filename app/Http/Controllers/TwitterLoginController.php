<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class TwitterLoginController extends Controller
{
    public function redirectToProvider(Request $request)
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        if ($request->input('error') == "access_denied") 
        {
            return 'user has decline the authorization';
        } 
       
            $user = Socialite::driver('twitter')->user();
            $token = $user->token;
            $refreshToken = $user->refreshToken;
            $id = $user->getId();
    }
}
