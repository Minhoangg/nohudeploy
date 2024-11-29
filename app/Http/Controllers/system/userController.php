<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Events\UserCoinUpdated;

class userController extends Controller
{
    public function getAll(Request $request)
    {
        // Lấy thông tin user hiện tại
        $currentUser = Auth::user();
    
        // Kiểm tra nếu user hiện tại có role = 2
        if ($currentUser->role == 2) {
            // Chỉ lấy danh sách user có cùng ID với user hiện tại
            $query = User::where('parent_id', $currentUser->id);
        } else {
            // Nếu không phải role 2, lấy danh sách user có role = 3
            $query = User::where('role', 3);
        }
    
        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone_number', 'like', '%' . $request->search . '%');
            });
        }
    
        // Truyền danh sách user sang view
        $users = $query->get();
    
        return view('admin.user.userList', compact('users'));
    }
    
    


    public function create()
    {
        return view('admin.user.userAdd');
    }

    public function createHandle(Request $request)
    {

        // Validate dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name', // Validate cho tên người dùng
            'phone' => 'required|string|min:10|max:15|unique:users,phone_number', // Validate cho số điện thoại
            'password' => 'required|string|min:6', // Validate cho mật khẩu
            'coin' => 'required|integer|min:0', // Validate cho số lượng xu
        ], [
            'name.required' => 'Tên người dùng không được để trống.',
            'name.unique' => 'Tên đăng nhập đã tồn tại.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'coin.required' => 'Số lượng xu không được để trống.',
            'coin.integer' => 'Số lượng xu phải là một số nguyên.',
            'coin.min' => 'Số lượng xu phải lớn hơn hoặc bằng 0.',
        ]);

        // Thêm người dùng mới
        $user = User::create([
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone'],  // Cung cấp giá trị cho phone_number
            'password' => Hash::make($validatedData['password']),
            'role' => 3,
            'coin' => $validatedData['coin'],
            'parent_id' => Auth::user()->id,
        ]);


        // Chuyển hướng hoặc thông báo thành công
        return redirect()->route('system.user-getall')->with('success', 'Thêm người dùng thành công!');
    }

    public function deleteHandle($id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);

        if ($user) {
            // Xóa người dùng
            $user->delete();

            // Thông báo thành công và chuyển hướng lại trang danh sách người dùng
            return redirect()->route('system.user-getall')->with('success', 'Người dùng đã được xóa thành công!');
        } else {
            // Nếu không tìm thấy người dùng, thông báo lỗi
            return redirect()->route('system.user-getall')->with('error', 'Không tìm thấy người dùng.');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Lấy người dùng theo ID
        return view('admin.user.userEdit', compact('user')); // Trả về view sửa người dùng với dữ liệu người dùng
    }

    public function editHandle(Request $request, $id)
    {
        // Tùy chỉnh thông báo lỗi cho từng trường
        $messages = [
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.numeric' => 'Số điện thoại phải là một số.',
            'phone.unique' => 'Số điện thoại đã được sử dụng.',
            'telegram.required' => 'Telegram là bắt buộc.',
        ];

        // Validate dữ liệu với các thông báo lỗi tùy chỉnh
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users,phone_number,' . $id,
            'telegram' => 'required',
        ], $messages);

        // Tìm người dùng cần sửa
        $user = User::findOrFail($id);

        // Cập nhật thông tin
        $user->name = $request->input('name');
        $user->phone_number = $request->input('phone');
        $user->telegram = $request->input('telegram');  // Đừng quên cập nhật trường telegram

        // Lưu lại người dùng
        $user->save();

        // Chuyển hướng về danh sách người dùng và thông báo thành công
        return redirect()->route('system.user-getall')->with('success', 'Cập nhật người dùng thành công!');
    }


    public function addCoin(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'coin' => 'required|integer|min:1', // Kiểm tra nhập vào xu là số nguyên dương
        ]);

        // Tìm người dùng theo ID
        $user = User::findOrFail($id);

        // Thêm xu vào tài khoản người dùng
        $user->coin += $request->input('coin'); // Tăng số xu của người dùng
        $user->save();

        event(new UserCoinUpdated($user));

        // Trở lại danh sách người dùng và thông báo thành công
        return redirect()->route('system.user-getall')->with('success', 'Đã thêm xu thành công!');
    }
}
