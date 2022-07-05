<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Redirect to the login page if not authenticated else redirect to Dashboard.
     *
     * @return RedirectResponse
     */
    public function __invoke(): RedirectResponse
    {
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        return redirect(route('dashboard'));
    }
}
