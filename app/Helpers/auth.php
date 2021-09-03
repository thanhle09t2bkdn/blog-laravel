<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('authUser')) {

    /**
     * Get current User Login
     *
     * @return mixed
     */
    function authUser()
    {
        return Auth::user();
    }
}

if (!function_exists('authUserId')) {

    /**
     * Get current user id
     *
     * @return integer|string|null
     */
    function authUserId()
    {
        return Auth::id();
    }
}

if (!function_exists('isAdmin')) {

    /**
     * Check current user is admin
     *
     * @return boolean
     */
    function isAdmin()
    {
        $user = authUser();
        if (empty($user)) {
            return false;
        }

        return $user->role == User::ROLE_ADMIN;
    }
}

if (!function_exists('isMerchantWeb')) {

    /**
     * Check current user is merchant web
     *
     * @return boolean
     */
    function isMerchantWeb()
    {
        $user = authUser();
        if (empty($user)) {
            return false;
        }

        return $user->role == User::ROLE_MERCHANT_WEB;
    }
}
