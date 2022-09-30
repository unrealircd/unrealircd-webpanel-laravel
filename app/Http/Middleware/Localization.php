<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     *
     * @return RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('_lang')) {
            session()->put('_lang', 'en');
        }
        return $next($request);
    }
}
