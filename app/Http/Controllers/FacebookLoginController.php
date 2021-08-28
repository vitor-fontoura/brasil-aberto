<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    public function redirectToProvider(Request $request)
    {
        //return Socialite::driver('facebook')->scopes(['instagram_basic'])->asPopup()->usingGraphVersion('v11.0')->redirect();
        
        $req = Socialite::driver('facebook')->scopes(['instagram_basic'])->asPopup()->usingGraphVersion('v11.0')->redirect();
        return Inertia::location($req->getTargetUrl());
        
    }

    public function handleProviderCallback(Request $request)
    {
        if ($request->input('error') == "access_denied") {
            return 'user has decline the authorization';
        } 
       
        $user = Socialite::driver('facebook')->usingGraphVersion('v11.0')->user();
        dd($user);
    }
}
