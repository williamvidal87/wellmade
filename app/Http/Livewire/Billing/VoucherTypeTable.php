<?php

namespace App\Http\Livewire\Billing;

use App\Models\VoucherType;
use Livewire\Component;
use Livewire\WithPagination;

class VoucherTypeTable extends Component
{
    use WithPagination;

    public $voucherTypeId ;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteVoucherType',
    ];

    public function createVoucherType(){
        $this->emit('resetInputFields');
        $this->emit('openVoucherTypeModal');
    }

    
    public function editVoucherType($voucherTypeId){
        $this->voucherTypeId = $voucherTypeId;
        $this->emit('voucherTypeId',$this->voucherTypeId);
        $this->emit('openVoucherTypeModal');
    }

    public function deleteConfirmVoucherType($voucherTypeId){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmVoucherTypeDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $voucherTypeId
        ]);
    }

    public function deleteVoucherType($voucherTypeId){
        
        VoucherType::destroy($voucherTypeId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.billing.voucher-type-table', [
            'voucher_type' => VoucherType::all(),
        ]);
    }
}
