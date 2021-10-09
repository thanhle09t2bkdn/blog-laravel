<?php


namespace App\Http\Middleware;


use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AuthenticateWithUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (!$request->user() ||
            $request->user()->role !== User::USER_ROLE) {
            return $request->expectsJson()
                ? abort(403, 'You can not access this page.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'backend.sites.index'));
        }

        return $next($request);
    }

}
