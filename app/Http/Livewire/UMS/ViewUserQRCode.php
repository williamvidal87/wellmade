<?php

namespace App\Http\Livewire\UMS;
use Barryvdh\DomPDF\Facade as PDF;

use Livewire\Component;

class ViewUserQRCode extends Component
{
    public $userID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'UserQRCode',
    ];

    public function render()
    {
        return view('livewire.u-m-s.view-user-q-r-code');
    }

    public function UserQRCode($userID){
        
        if($this->userID){
            $this->userID = null;
        }
        $this->userID = $userID;
    }
}
