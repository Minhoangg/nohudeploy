<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            // Nếu chưa đăng nhập, chuyển hướng về trang login
            return redirect()->route('system.login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }
    
        // Kiểm tra vai trò của người dùng, chỉ cho phép người dùng với role 1 hoặc 2
        $user = Auth::user();
    
        if (!in_array($user->role, [1, 2])) {
            // Nếu người dùng không có role 1 hoặc 2, chuyển hướng về trang lỗi hoặc trang không có quyền truy cập
            return redirect()->route('system.login')->with('error', 'Bạn không có quyền truy cập.');
        }
    
        // Nếu đã đăng nhập và có role hợp lệ, tiếp tục với request
        return $next($request);
    }
    
}

