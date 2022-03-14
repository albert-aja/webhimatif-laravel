<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowRegistration
{
    /**
     * Check if registration is allowed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		if (!config('auth.allowRegistration')){
			return redirect()->route('auth-login')->with('errorMsg', __('auth.register.registerDisabled'));
		}
        
        return $next($request);
    }
}
