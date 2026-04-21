<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyKokonacci
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->email !== 'kokonacci@gmail.com') {

                Auth::logout(); // 🔒 paksa logout

                return redirect('/login')->withErrors([
                    'email' => 'Akun ini tidak diizinkan mengakses sistem.',
                ]);
            }
        }
        return $next($request);
    }
}
