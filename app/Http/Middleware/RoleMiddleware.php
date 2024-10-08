<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user(); 

        if (!$user) {
            return redirect('login');
        }

        if ($user->role === 'admin') {
            return $next($request);
        }

        if ($user->role === 'nhanvien') {
            if ($request->is('orders') || $request->is('profile')) {
                return $next($request);
            }
        }

        if ($user->role === 'khachhang') {
            if ($request->is('profile')) {
                return $next($request);
            }
        }

        return  redirect('/home');
    }
}