<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCompanyRegistration
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            // Jika pengguna tidak terautentikasi, arahkan ke halaman login
            return redirect()->route('login');
        }

        if (!$user->companies) {
            // Jika pengguna tidak memiliki perusahaan, arahkan ke halaman imm
            if ($request->route()->getName() !== 'imm') {
                return redirect()->route('imm');
            }
        }

        // Jika pengguna memiliki perusahaan, lanjutkan ke rute yang diminta
        return $next($request);
    }
}
