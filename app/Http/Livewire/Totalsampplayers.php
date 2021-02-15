<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\SampQueryAPI;

class Totalsampplayers extends Component
{
    private $instanceHandle;
    public $currentClass;
    public $returnedText;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->currentClass = "badge badge-light-warning";
        $this->returnedText = "Obteniendo cantidad de jugadores conectados . . .";
    }

    public function getTotalPlayer()
    {
        if( $this->instanceHandle == null )
        {
            $this->instanceHandle = new SampQueryAPI();
        }

        if ( $this->instanceHandle->isOnline() == false )
        {
            $this->currentClass = "badge badge-light-danger";
            $this->returnedText = "Servidor fuera de linea";
        }
        else {
            $R = $this->instanceHandle->getInfo();
            $this->currentClass = "badge badge-light-success";

            $this->currentTotalPlayers = $R['players'];
            $this->maxPlayers = $R['maxplayers'];

            $this->returnedText = "Jugadores: ".$R['players']."/".$R['maxplayers'];
        }
        return true;
    }

    public function render()
    {
        return view('livewire.totalsampplayers');
    }
}
