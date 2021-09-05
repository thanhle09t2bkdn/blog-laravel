<?php

namespace App\Services\SocialNetworks\Google;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class LoginGoogle
{
    /**
     * Login Google
     *
     * @param mixed $userSns User social network
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
                'type' => User::TYPE_GOOGLE,
            ]);

        if ($user->role == User::ROLE_ADMIN) {
            Auth::login($user, true);
            return $user;
        }

        return null;
    }
}
