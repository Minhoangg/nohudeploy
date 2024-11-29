<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Lobby;
use App\Livewire\HandleGame;
use App\Models\UserGameSession;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class WellcomeController extends Controller
{
    public function index()
    {
        return view('client/wellcome');
    }

    public function home()
    {
        $lobbys = Lobby::all();
        return view('client/home', ['lobbys' => $lobbys]);
    }

    public function details($id)
    {
        $lobby = Lobby::find($id);
        $games = Game::where('lobby_id', $id)->get(); // Sử dụng get() thay vì getAll()
        return view('client/webdetail', ['games' => $games, 'lobby' => $lobby]);
    }

    public function getScore($id)
    {

        $GameId = $id;

        return view('client.getscoregame', compact('GameId'));
    }
}
