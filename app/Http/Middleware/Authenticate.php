<?php

namespace App\Http\Middleware;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            Alert::error('Gagal', 'Akses Ditolak !!!');

            return route('login');
        }
    }
}
