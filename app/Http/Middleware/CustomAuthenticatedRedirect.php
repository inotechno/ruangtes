<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthenticatedRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Redirect based on user type
                return $this->redirectToDashboard($user);
            }
        }

        return $next($request);
    }

    protected function redirectToDashboard($user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->route('super-admin.dashboard');
        } elseif ($user->isCompanyAdmin()) {
            return redirect()->route('company.dashboard');
        } elseif ($user->isPublicUser()) {
            return redirect()->route('public.dashboard');
        }

        return redirect('/');
    }
}
