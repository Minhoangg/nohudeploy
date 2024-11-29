<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Lobby;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy danh sách các lobbies
        $lobbies = Lobby::all();

        // Thêm dữ liệu mẫu cho mỗi lobby
        foreach ($lobbies as $lobby) {
            Game::create([
                'lobby_id' => $lobby->id,
                'title' => 'game của sảnh ' . $lobby->name,
                'image' => 'https://example.com/images/sample-game.jpg',
                'min_percent' => 80,
                'max_percent' => 95,
                'min_ratio' => 70,
                'max_ratio' => 90,
            ]);
        }
    }
}
