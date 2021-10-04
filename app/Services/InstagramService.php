<?php

namespace App\Services;

use Laravel\Socialite\Contracts\Provider;

class InstagramService extends SocialiteService
{
    public function getProviderType(): string
    {
        return 'facebook';
    }

    public function getSocialiteDriver() : Provider
    {
        /** @var \Laravel\Socialite\Two\FacebookProvider $driver */
        $driver = parent::getSocialiteDriver();

        return $driver
            ->scopes(['instagram_basic', 'instagram_content_publish'])
            ->asPopUp()
            ->usingGraphVersion('v12.0');
    }
}
