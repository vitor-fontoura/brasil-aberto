<?php

namespace App\Services;

class TwitterService extends SocialiteService
{
    public function getProviderType(): string
    {
        return 'twitter';
    }
}
