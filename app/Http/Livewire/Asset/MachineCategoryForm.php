<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineCategory;
use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;

class MachineCategoryForm extends Component
{
    public $machine_category_name, $machineCategoryId;
    

    protected $listeners = [
        'editMachineCategoryId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.asset.machine-category-form');
    }

    public function editMachineCategoryId($id)
    {      
        $this->machineCategoryId = $id;     

        $machineCategory = MachineCategory::find($id);
        $this->machine_category_name = $machineCategory->machine_category_name;
    }

    public function store()
    {
        $data = $this->validate([
            'machine_category_name' => 'required'
        ]);

        try {
            if($this->machineCategoryId) {
                MachineCategory::find($this->machineCategoryId)->update($data);
            }else{
                MachineCategory::create($data);
            }
           
        }catch(\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }
        if($this->machineCategoryId){
            $action = 'edit';
            $message = 'Record Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Record Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }    
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeMachineCategoryModal');       

    }   

   
}
