<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'alumnos':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('profile');
                }
                break;
            case 'administradores':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('adminhome');
                }
                break;
            case 'coordinadores':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('coordinadorhome');
                }
                break;
            case 'asesores':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('asesorhome');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }
        return $next($request);
    }
}
