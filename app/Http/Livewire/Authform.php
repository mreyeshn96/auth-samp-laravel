<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

class Authform extends Component
{
    public $statusAuth = "UNSTARTED";
    public $responseAux = "asd";
    public $clientIp;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function startAuth(Request $request)
    {
        return true;
    }

    public function render()
    {
        return view('livewire.authform');
    }
}
