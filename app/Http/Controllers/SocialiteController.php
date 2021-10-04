<?php

namespace App\Http\Controllers;

use App\Services\SocialiteService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SocialiteController extends Controller
{
    public function redirectToProvider(Request $request)
    {
        return Inertia::location(
            SocialiteService::get($request->get('provider'))
                ->getProviderTarget()
        );
    }

    public function handleProviderCallback(Request $request)
    {
        if ($request->input('error') == "access_denied") {
            return 'user has decline the authorization';
        }

        SocialiteService::get($request->get('provider'))
            ->attachToAuthUser();
    }
}
