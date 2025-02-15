<?php

namespace App\Http\Middleware;
use RealRashid\SweetAlert\Facades\Alert;

use Closure;
use Illuminate\Http\Request;

class IsPengelola
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->hak_akses == 1) { return $next($request); }
        
        Alert::error('Gagal', 'Akses Ditolak !!!');
        return redirect('dashboard');
    }
}
