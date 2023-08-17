<?php

namespace App\Http\Livewire\Billing;

use App\Models\ChartOfAccounts;
use Livewire\Component;

use Livewire\WithPagination;

class ChartAccountsTable extends Component
{
    use WithPagination;

    public $chartAccountsId ;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteChartAccounts',
    ];
    
    public function render()
    {
    $billingchartaccounts = ChartOfAccounts::with('getAccountTypes')->get();
    // dd($billingchartaccounts);
        return view('livewire.billing.chart-accounts-table')
        ->with('billingchartaccounts',$billingchartaccounts)
        ->with('getAccountTypes');
    }

    public function createChartAccounts(){
        $this->emit('resetInputFields');
        $this->emit('openChartAccountsModal');
    }

    
    public function editChartAccounts($chartAccountsId){
        $this->chartAccountsId = $chartAccountsId;
        $this->emit('chartAccountsId',$this->chartAccountsId);
        $this->emit('openChartAccountsModal');
    }

    public function deleteConfirmChartAccounts($chartAccountsId){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmChartAccountsDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $chartAccountsId
        ]);
    }

    public function deleteChartAccounts($chartAccountsId){
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        ChartOfAccounts::destroy($chartAccountsId);
        $this->resetPage();
    }
}
