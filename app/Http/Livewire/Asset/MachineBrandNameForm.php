<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineBrandName;
use Livewire\Component;

class MachineBrandNameForm extends Component
{
    public $brand_name,$acro_name;
    public $machinebrandnameID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machinebrandnameID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machinebrandnameID($machinebrandnameID){

        $this->machinebrandnameID = $machinebrandnameID;
        $brand_names = MachineBrandName::find($machinebrandnameID);
        $this->brand_name = $brand_names->brand_name;
        $this->acro_name          = $brand_names->acro_name;
    
    }

    public function save(){

        $data = $this->validate([
            'brand_name' => 'required',
            'acro_name'          => ''
        ]);
        
        try{

            if($this->machinebrandnameID){

                MachineBrandName::find($this->machinebrandnameID)->update($data);

            }else{

                MachineBrandName::create($data);

            }
        } catch (\Exception $e){
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machinebrandnameID){
            $action = 'edit';
            $message = 'Brand Name Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Brand Name Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachinebrandnamemodal');
    }
    public function render()
    {
        return view('livewire.asset.machine-brand-name-form');
    }
}
