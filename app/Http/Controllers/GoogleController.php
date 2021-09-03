<?php

namespace App\Http\Controllers;

use App\Services\SocialNetworks\Google\LoginGoogle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect
     *
     * @return RedirectResponse
     */
    public function redirect()
    {
        $scopes = config('services.google.scope');
        return Socialite::driver('google')->scopes($scopes)->redirect();
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
        $userSns = Socialite::driver('google')->stateless()->user();

        $result = resolve(LoginGoogle::class)->run($userSns);

        if ($result) {
            return redirect()->route('home.index');
        } else {
            $request->session()->flash('error', 'You are not admin');
            return redirect()->route('login');
        }
    }
}
