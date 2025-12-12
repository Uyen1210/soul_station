<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra: Nếu đã đăng nhập VÀ role là 'admin' thì cho qua
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Nếu không phải admin, báo lỗi 403 (Cấm truy cập) hoặc đá về trang chủ
        abort(403, 'Bạn không có quyền truy cập vào trang Quản trị!');
    }
}