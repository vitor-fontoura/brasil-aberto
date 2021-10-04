<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    public function redirectToProvider(Request $request)
    {
        $req = Socialite::driver('facebook')
            ->scopes(['instagram_basic', 'instagram_content_publish'])
            ->asPopup()
            ->usingGraphVersion('v12.0')
            ->redirect();

        return Inertia::location($req->getTargetUrl());
        
    }

    public function handleProviderCallback(Request $request)
    {
        if ($request->input('error') == "access_denied") {
            return 'user has decline the authorization';
        }

        dump($request->all());
       
        $user = Socialite::driver('facebook')
            ->usingGraphVersion('v12.0')
            ->user();

        dd($user);
    }
}
