<?php

namespace App\Http\Livewire\Workload;

use App\Models\WorkStatus;
use Livewire\Component;

use Livewire\WithPagination;

class WorkStatusTable extends Component
{
    use WithPagination;

    public $workstatusID ;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteWorkStatus',
    ];
    
    public function render()
    {
        return view('livewire.workload.work-status-table',[
            'workstatus' => WorkStatus::all()
        ]);
    }

    public function createWorkStatus(){
        $this->emit('resetInputFields');
        $this->emit('openWorkStatusModal');
    }

    
    public function editWorkStatus($workstatusID){
        $this->workstatusID = $workstatusID;
        $this->emit('workstatusID',$this->workstatusID);
        $this->emit('openWorkStatusModal');
    }

    public function deleteConfirmWorkStatus($workstatusID){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmWorkStatusDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $workstatusID
        ]);
    }

    public function deleteWorkStatus($workstatusID){
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        WorkStatus::destroy($workstatusID);
        $this->resetPage();
    }
}
