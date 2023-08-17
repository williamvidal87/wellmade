<?php

namespace App\Http\Livewire\Billing;

use App\Models\InvoiceTypes;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceTypeTable extends Component
{
    use WithPagination;

    public $invoicetypeID ;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteInvoiceType',
    ];
    
    public function render()
    {
        return view('livewire.billing.invoice-type-table',[
            'invoicetype' => InvoiceTypes::all()
        ]);
    }

    public function createInvoiceType(){
        $this->emit('resetInputFields');
        $this->emit('openInvoiceTypeModal');
    }

    
    public function editInvoiceType($invoicetypeID){
        $this->invoicetypeID = $invoicetypeID;
        $this->emit('invoicetypeID',$this->invoicetypeID);
        $this->emit('openInvoiceTypeModal');
    }

    public function deleteConfirmInvoiceType($invoicetypeID){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmInvoiceTypeDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $invoicetypeID
        ]);
    }

    public function deleteInvoiceType($invoicetypeID){
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        InvoiceTypes::destroy($invoicetypeID);
        $this->resetPage();
    }
}
