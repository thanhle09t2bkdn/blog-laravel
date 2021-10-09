<?php


namespace App\Http\Middleware;


use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AuthenticateWithUserOrAdminAuth
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
            ($request->user()->role !== User::USER_ROLE && $request->user()->role !== User::ADMIN_ROLE)) {
            return $request->expectsJson()
                ? abort(403, 'You can not access this page.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'frontend.sites.index'));
        }

        return $next($request);
    }
}
