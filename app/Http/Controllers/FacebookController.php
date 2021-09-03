<?php

namespace App\Http\Controllers;

use App\Services\SocialNetworks\Facebook\LoginFacebook;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    /**
     * Redirect
     *
     * @return RedirectResponse
     */
    public function redirect()
    {
        $scopes = config('services.facebook.scope');
        return Socialite::driver('facebook')->scopes($scopes)->redirect();
    }

    /**
     * Callback
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function callback(Request $request)
    {
        $userSns = Socialite::driver('facebook')->stateless()->user();

        $result = resolve(LoginFacebook::class)->run($userSns);
        if ($result) {
            return redirect()->route('home.index');
        } else {
            $request->session()->flash('error', 'You are not admin');
            return redirect()->route('login');
        }
    }
}
