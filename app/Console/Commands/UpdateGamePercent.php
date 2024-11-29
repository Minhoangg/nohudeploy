<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Game;

class UpdateGamePercent extends Command
{
    // Tên của lệnh
    protected $signature = 'game:update-percent';

    // Mô tả của lệnh
    protected $description = 'Cập nhật trường percent trong bảng games mỗi 5 phút';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $games = Game::all();

        foreach ($games as $game) {
            $letters = ['D', 'C', 'B', 'A', 'S'];
            $randomPercent = $letters[array_rand($letters)];

            $game->update(['percent' => $randomPercent]);
        }

        $this->info('Trường percent đã được cập nhật cho tất cả game!');
    }
}
