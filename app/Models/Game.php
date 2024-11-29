<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Game extends Model
{
    use HasFactory;

    // Danh sách các cột có thể gán giá trị hàng loạt
    protected $fillable = [
        'lobby_id',
        'title',
        'image',
        'min_percent',
        'max_percent',
        'min_ratio',
        'max_ratio',
        'timeend',
        'percent',
    ];
    public function lobby()
    {
        return $this->belongsTo(Lobby::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_game_sessions')
                    ->withPivot(['last_rate_received_at', 'round_min', 'round_max',  'percent'])
                    ->withTimestamps(); // Bao gồm created_at và updated_at
    }
}
