<?php

namespace App\Livewire\Clients\Game;

use Livewire\Component;

class HandleGame extends Component
{
    public function render()
    {
        $min = 2 ;

        return view('livewire.clients.game.handle-game')->with(compact('min'));
    }
}
