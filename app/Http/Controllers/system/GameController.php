<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lobby;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function getAll()
    {
        // Lấy toàn bộ danh sách user từ bảng users
        $games = Game::get();


        // Truyền danh sách user sang view
        return view('admin.game.gameList', compact('games'));
    }


    public function create()
    {
        $lobbies = Lobby::all();

        return view('admin.game.gameAdd', compact('lobbies'));
    }

    public function createHandle(Request $request)
    {

        // Validate dữ liệu
        $request->validate([
            'lobby_id' => 'required|exists:lobbies,id',
            'title' => 'required|string|max:255',
            'image' => 'required',
     
        ], [
            'lobby_id.required' => 'Vui lòng chọn Lobby.',
            'lobby_id.exists' => 'Lobby không tồn tại.',
            'title.required' => 'Vui lòng nhập tiêu đề game.',
            'title.string' => 'Tiêu đề game phải là một chuỗi văn bản.',
            'title.max' => 'Tiêu đề game không được vượt quá 255 ký tự.',
            'image.required' => 'Vui lòng chọn một hình ảnh.',
 
        ]);


        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/games', 'public');
        }

        // Create the game
        Game::create([
            'lobby_id' => $request->lobby_id,
            'title' => $request->title,
            'image' => $imagePath ?? null,
            'min_percent' => 22,
            'max_percent' => 22,
            'min_ratio' => 22,
            'max_ratio' => 22,
        ]);

        return redirect()->route('system.game-getall')->with('success', 'Game added successfully');
    }

    public function deleteHandle($id)
    {
        // Tìm người dùng theo ID
        $user = Game::find($id);

        if ($user) {
            // Xóa người dùng
            $user->delete();

            // Thông báo thành công và chuyển hướng lại trang danh sách người dùng
            return redirect()->route('system.game-getall')->with('success', 'Người dùng đã được xóa thành công!');
        } else {
            // Nếu không tìm thấy người dùng, thông báo lỗi
            return redirect()->route('system.game-getall')->with('error', 'Không tìm thấy người dùng.');
        }
    }

    public function edit($id)
    {
        // Fetch the game details based on the provided ID
        $game = Game::findOrFail($id);
        $lobbies = Lobby::all();  // Assuming you have a Lobby model and need to fetch all lobbies

        // Return the edit view with game data
        return view('admin.game.gameEdit', compact('game', 'lobbies'));
    }


    public function editHandle(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'lobby_id' => 'required|exists:lobbies,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
        ], [
            'lobby_id.required' => 'Vui lòng chọn Lobby.',
            'lobby_id.exists' => 'Lobby không tồn tại.',
            'title.required' => 'Vui lòng nhập tiêu đề game.',
            'title.string' => 'Tiêu đề game phải là một chuỗi văn bản.',
            'title.max' => 'Tiêu đề game không được vượt quá 255 ký tự.',
            'image.image' => 'Vui lòng chọn một hình ảnh hợp lệ.',
        ]);


        // Find the game
        $game = Game::findOrFail($id);

        // Handle image upload if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }

            $imagePath = $request->file('image')->store('images/games', 'public');
        }

        // Update the game data
        $game->update([
            'lobby_id' => $request->lobby_id,
            'title' => $request->title,
            'image' => isset($imagePath) ? $imagePath : $game->image,
            'min_percent' => 22,
            'max_percent' => 22,
            'min_ratio' => 22,
            'max_ratio' => 22,
        ]);

        return redirect()->route('system.game-getall')->with('success', 'Game updated successfully');
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

        // Trở lại danh sách người dùng và thông báo thành công
        return redirect()->route('system.user-getall')->with('success', 'Đã thêm xu thành công!');
    }
}
