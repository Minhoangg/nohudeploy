<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Lobby extends Model
{
    use HasFactory;

    // Danh sách các cột có thể gán giá trị hàng loạt
    protected $tableName = 'lobbies';
    protected $fillable = ['name', 'image'];
    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
