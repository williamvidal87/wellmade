<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Valve;

class ValveTable extends Component
{
    use WithPagination;
    public $valveID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'valveDelete',
    ];

    public function createvalve(){

        $this->emit('resetInputFields');
        $this->emit('openValveModal');
        $this->emit('refreshValve');
    }

    public function editValve($valveID){

        $this->valveID = $valveID;
        $this->emit('ValveID', $valveID);
        $this->emit('openValveModal');
    }

    public function deletetheValve($valveID){

        $this->dispatchBrowserEvent('swal:confirmValveDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $valveID
        ]);

    }

    public function valveDelete($id){

        Valve::destroy($id);
        $this->reset();
        // $this->emit('refreshParent');
    }

    public function render()
    {
        $valve = Valve::all()->sortBy('id');

        return view('livewire.engine.valve-table', [
            'valve'=>$valve,
        ]);
    }
}
