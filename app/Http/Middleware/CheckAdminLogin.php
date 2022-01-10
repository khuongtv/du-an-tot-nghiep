<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect(route('admin_login'));
        }
        if (Auth::check() && Auth::user()->role > 100) {
            return $next($request);
        } else {
            return redirect(route('admin_login'))->with('msg_loginAdmin', 'Bạn không có quyền truy cập vào quản trị');
        }
    }
}
