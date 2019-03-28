<?php

namespace App\Services;
use App\SocialFacebookAccount;
use App\User;
use App\UserRoles;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {  
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => md5(rand(1,10000)),
                    'status_id' => 3,
                    'plan_id' => 1,
                    'mobile_number' => 0
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            $user_id = User::where('email','=',$providerUser->getEmail())->pluck('id')->first();
            $user_role = new UserRoles();
            $user_role->user_id = $user_id;
            $user_role->user_role_type_id = 3;
            $user_role->save();

            return $user;
        }
    }
}