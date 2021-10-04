<?php

namespace App\Services;

use App\Models\SocialiteAccount;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Facades\Socialite;

abstract class SocialiteService
{
    public static function get(string $providerType)
    {
        switch ($providerType) {
            case 'facebook' :
                return new InstagramService();
            case 'twitter' :
                return new TwitterService();
            default : 
                throw new \Exception("Unknown socialite provider {$providerType}");
        }
    }

    public function attachToAuthUser() : SocialiteAccount
    {
        $providerUser = $this->getSocialiteDriver()
            ->user();

        $account = new SocialiteAccount([
            'provider_user_id' => $providerUser->getId(),
            'provider' => $this->getProviderType(),
            'nickname' => $providerUser->getNickname(),
            'name' => $providerUser->getName(),
            'email' => $providerUser->getEmail(),
            'avatar' => $providerUser->getAvatar(),
        ]);

        $account
            ->user()
            ->associate(auth()->user())
            ->save();

        return $account;
    }

    public function getProviderTarget() : string
    {
        return $this->getSocialiteDriver()
            ->redirect()
            ->getTargetUrl();
    }

    public function getSocialiteDriver() : Provider
    {
        return Socialite::driver($this->getProviderType());
    }
    /*
    public function createOrGetUser(ProviderUser $providerUser) {
    
        $providerType = $this->getProviderType();

        $account = SocialiteAccount::whereProvider($providerType)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        }

        $account = new SocialiteAccount([
            'provider_user_id' => $providerUser->getId(),
            'provider' => $providerType
        ]);

        $user = User::whereEmail($providerUser->getEmail())->first();

        if (!$user) {

            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'password' => bcrypt(str_random(8))
            ]);
        }

        $account->user()->associate($user);
        $account->save();

        return $user;
    }
    */
    public abstract function getProviderType() : string;
}
