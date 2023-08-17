<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\Valve;

class ValveForm extends Component
{
    public $valve, $valveID;

    protected $listeners = [
        'refreshValve' => '$refresh',
        'ValveID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.engine.valve-form');
    }

    public function ValveID($valveID){

        $this->valveID = $valveID;
        $valve = Valve::find($valveID);
        $this->valve = $valve->valve;

    }

    public function store(){

        $data = $this->validate([
            'valve' => 'required',
        ]);

        try{

            if($this->valveID){
                Valve::find($this->valveID)->update($data);

            }else{
                Valve::create($data);
            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->valveID){
            $action = 'edit';
            $message = 'Valve Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Valve Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeValveModal');
    }
}
