<?php

namespace App\Http\Middleware;

use Closure;
// use App\Http\Middleware\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            // Periksa status verifikasi
            if (Auth::user()->status !== 'Terverifikasi') {
                return redirect()->route('masteranggota.index');
            }
        }

        return $next($request);
    }
}
