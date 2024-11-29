<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function login(){
        return view('admin/login');
    }

    public function loginHandle(Request $request)
    {
        // Validate dữ liệu đầu vào với thông báo lỗi tùy chỉnh
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|min:6',
        ], [
            'username.required' => 'Tên đăng nhập không được để trống.',
            'username.string' => 'Tên đăng nhập phải là một chuỗi.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);
    
        // Kiểm tra xem validation có thất bại không
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Thực hiện xác thực người dùng
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            // Đăng nhập thành công, chuyển đến trang dashboard (hoặc trang quản trị)
            return redirect()->route('system.user-getall');
            // Thay đổi đường dẫn đến dashboard của bạn
        }
    
        // Nếu đăng nhập thất bại, quay lại form đăng nhập với thông báo lỗi
        return redirect()->route('system.user-getall')->with('success', 'Thêm người dùng thành công!');
    }

}
