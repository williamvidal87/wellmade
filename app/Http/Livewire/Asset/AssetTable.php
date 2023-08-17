<?php

namespace App\Http\Livewire\Asset;

use App\Models\Machines;
use Livewire\Component;

class AssetTable extends Component
{
    public $machineID;
    
    protected $listeners = [
        'refreshParent' => '$refresh',
        // 'deleteAccountTypes',
    ];

    public function render()
    {
        $machines = Machines::select('id','machine_dept_location_id','machine_description_id','machine_group_id','machine_sub_group_id')->with('getDeptLocation','getDescription','getGroups','getAssignSubGroup')->get();
        return view('livewire.asset.asset-table')
        ->with('machines',$machines);
    }
    
    public function createAsset()   //for create
    {
        $this->emit('openAssetModal');
    }

    
    public function editAsset($machineID){  //for edit
        $this->machineID = $machineID;
        $this->emit('machineID',$this->machineID);
        $this->emit('openAssetModal');
    }

    public function deleteConfirmAsset($machineID){ //for delete swal
        $this->dispatchBrowserEvent('swal:confirmAccountTypesDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machineID
        ]);
    }

    public function deleteAccountTypes($machineID){    //for delete
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        Machines::destroy($machineID);
        $this->resetPage();
    }
}
