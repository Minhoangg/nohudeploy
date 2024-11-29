<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lobby;

class LobbyController extends Controller
{
    public function index()
    {
        $lobbies = Lobby::get();
        return view('admin/lobby/list', ['lobbies' => $lobbies]);
    }
    public function create()
    {
        return view('admin/lobby/add');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name.required' => 'Tên sảnh không được để trống.',
                'image.image' => 'Tệp tải lên phải là ảnh.',
                'image.mimes' => 'ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
                'image.max' => 'Kích thước ảnh không được vượt quá 2MB.',
            ]
        );

        $lobby = new Lobby();
        $lobby->name = $request->input('name');
        // Handle image upload        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/games', 'public');
            $lobby->image = $imagePath;
        }

        $lobby->save();

        return redirect()->route('system.lobby-list')->with('success', 'Sảnh game đã được thêm thành công.');
    }

    public function edit($id)
    {
        $lobby = Lobby::find($id);
        return view('admin/lobby/edit', ['lobby' => $lobby]);
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name.required' => 'Tên sảnh không được để trống.',
                'image.image' => 'Tệp tải lên phải là ảnh.',
                'image.mimes' => 'ảnh phải có dạng jpeg, png, jpg, hoặc gif.',
                'image.max' => 'Kích thước ảnh không được vượt quá 2MB.',
            ]
        );

        $lobby = Lobby::find($id);
        $lobby->name = $request->input('name');
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/games', 'public');
            $lobby->image = $imagePath;
        }

        $lobby->save();

        return redirect()->route('system.lobby-list')->with('success', 'Sảnh game đã được cập nhật thành công.');
    }

    public function delete($id)
    {
        $lobby = Lobby::find($id);
        if ($lobby) {
            $lobby->delete();
            return redirect()->route('system.lobby-list')->with('success', 'Sảnh game đã được xóa thành công.');
        } else {
            return redirect()->route('system.lobby-list')->with('error', 'Không tìm thấy sảnh game.');
        }
    }
}
