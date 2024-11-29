<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGameSession extends Model
{
    use HasFactory;

    // Tên bảng (nếu khác tên mặc định của model)
    protected $table = 'user_game_sessions';

    // Các cột có thể fill bằng cách sử dụng create() hoặc fill()
    protected $fillable = [
        'user_id',
        'game_id',
        'round_min',
        'round_max',
        'percent',
        'time_start',
        'time_end',
    ];

    /**
     * Quan hệ với User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Quan hệ với Game
     */
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}

