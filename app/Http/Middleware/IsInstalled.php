<?php

namespace App\Http\Middleware;

use Closure;
use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class IsInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     *
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if($request->path() === 'install' && !File::exists(storage_path('framework/installed'))) {
            return $next($request);
        }

        if($request->path() === 'install' && File::exists(storage_path('framework/installed'))) {
            return app()->abort(HttpResponse::HTTP_FORBIDDEN);
        }

        return redirect()->route('install');
    }
}
