<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Ingameuser extends Component
{
    public $arrayPlayers;

    public function mount($listplayer)
    {
        $this->arrayPlayers = $listplayer;
    }

    public function render()
    {
        return view('livewire.ingameuser');
    }
}
