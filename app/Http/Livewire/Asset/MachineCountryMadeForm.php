<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineCountryMade;
use Livewire\Component;

class MachineCountryMadeForm extends Component
{
    public $machine_country_made_name;
    public $machinecountrymadeID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machinecountrymadeID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machinecountrymadeID($machinecountrymadeID){

        $this->machinecountrymadeID = $machinecountrymadeID;
        $country_made = MachineCountryMade::find($machinecountrymadeID);
        $this->machine_cost_center_name = $country_made->machine_country_made_name;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_country_made_name' => 'required'
        ]);
        
        try{

            if($this->machinecountrymadeID){

                MachineCountryMade::find($this->machinecountrymadeID)->update($data);

            }else{

                MachineCountryMade::create($data);

            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machinecountrymadeID){
            $action = 'edit';
            $message = 'Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachinecountrymademodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-country-made-form');
    }
}
