<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lobby;

class LobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dữ liệu mẫu cho bảng lobbies
        $lobbies = [
            ['name' => 'sảnh 1', 'image' => 'https://example.com/images/action.jpg'],
            ['name' => 'sảnh 2', 'image' => 'https://example.com/images/puzzle.jpg'],
            ['name' => 'sảnh 3', 'image' => 'https://example.com/images/adventure.jpg'],
            ['name' => 'sảnh 4', 'image' => 'https://example.com/images/sports.jpg'],
            ['name' => 'sảnh 5', 'image' => 'https://example.com/images/racing.jpg'],
        ];

        // Tạo bản ghi trong cơ sở dữ liệu
        foreach ($lobbies as $lobby) {
            Lobby::create($lobby);
        }
    }
}
