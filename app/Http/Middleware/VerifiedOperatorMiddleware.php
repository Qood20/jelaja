<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedOperatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === 'operator' && $user->status !== 'approved') {
            // Jika mengakses dashboard, biarkan lewat tapi dashboard akan menampilkan pesan pending
            if ($request->routeIs('operator.dashboard')) {
                return $next($request);
            }

            return redirect()->route('operator.dashboard')
                ->with('error', 'Akun Anda sedang menunggu verifikasi admin. Silakan tunggu hingga akun Anda disetujui.');
        }

        return $next($request);
    }
}
