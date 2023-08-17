<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineCostCenter;
use Livewire\Component;

class MachineCostCentersForm extends Component
{
    public $machine_cost_center_name;
    public $machinecostcentername;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machinecostcentersID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machinecostcentersID($machineconstcenters){

        $this->machinecostcentername = $machineconstcenters;
        $cost_center = MachineCostCenter::find($machineconstcenters);
        $this->machine_cost_center_name = $cost_center->machine_cost_center_name;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_cost_center_name' => 'required'
        ]);
        
        try{

            if($this->machinecostcentername){

                MachineCostCenter::find($this->machinecostcentername)->update($data);

            }else{

                MachineCostCenter::create($data);

            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machinecostcentername){
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
        $this->emit('closemachinecostcentersmodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-cost-centers-form');
    }
}
