<?php

namespace App\Services\SocialNetworks\Facebook;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class LoginFacebook
{
    /**
     * Login Facebook
     *
     * @param mixed $userSns User social network service
     *
     * @return null|array
     */
    public function run($userSns)
    {
        $user = resolve(UserRepository::class)
            ->createUserSns([
                'email' => $userSns->email,
                'name' => $userSns->name,
                'social_key' => $userSns->id,
                'type' => User::TYPE_FACEBOOK,
            ]);

        if ($user->role == User::ROLE_ADMIN) {
            Auth::login($user, true);
            return $user;
        }

        return null;
    }
}
