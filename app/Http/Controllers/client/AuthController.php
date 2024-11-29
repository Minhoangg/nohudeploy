<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Jobs\DeductCoinJob;
use Carbon\Carbon;


class AuthController extends Controller
{

    public function loginForm()
    {
        return view('client.login');
    }


    public function loginHandle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required',
        ], [
            'name.required' => 'Tên đăng nhập không được để trống.',
            'name.string' => 'Tên đăng nhập phải là một chuỗi.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // Trả lỗi về view
        }

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {

            $user = Auth::user();
            $user->is_online = true;
            $user->save();
            $job = (new DeductCoinJob($user->id))->delay(Carbon::now()->addMinutes(2));
            dispatch($job);
            return redirect()->route('client.home');
        }

        return redirect()->back()->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng.'); // Lỗi đăng nhập
    }

    public function registerForm()
    {
        return view('client.register');
    }


    public function registerHandle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:users,name',
            'phone' => 'required|numeric|unique:users,phone_number',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ], [
            'name.required' => 'Tên đăng nhập không được để trống.',
            'name.string' => 'Tên đăng nhập phải là một chuỗi.',
            'name.unique' => 'Tên đăng nhập đã tồn tại.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.numeric' => 'Số điện thoại phải là số.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu.',
            'confirm_password.same' => 'Mật khẩu nhập lại không khớp.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Tạo người dùng mới
            $user = User::create([
                'name' => $request->name,
                'phone_number' => $request->phone,
                'role' => 3,
                'coin' => 0,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('successRegister', 'Đăng ký thành công.');
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có vấn đề khi thêm vào cơ sở dữ liệu
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại sau.');
        }
    }
}
