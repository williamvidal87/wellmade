<?php

namespace App\Http\Livewire\Billing;

use App\Models\CheckVoucher;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class CheckVoucherTable extends Component
{

    use WithPagination;

    public $checkVoucherId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteCheckVoucher',
    ];

    public function createCheckVoucher(){
        $this->emit('resetInputFields');
        $this->emit('openCheckVoucherModal');
        $this->emit('select2');
        $this->emit('checkVoucherDate', Carbon::today());
    }

    
    public function editCheckVoucher($checkVoucherId){
        $this->checkVoucherId = $checkVoucherId;
        $this->emit('checkVoucherId',$this->checkVoucherId);
        $this->emit('openCheckVoucherModal');
    }

    public function viewCheckVoucher($checkVoucherId)
    {
        $this->emit('resetInputFields');
        $this->emit('viewCheckVoucherId', $checkVoucherId);
        $this->emit('openCheckVoucherModal');
    }

    public function deleteConfirmCheckVoucher($checkVoucherId){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmVoucherTypeDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $checkVoucherId
        ]);
    }

    public function deleteCheckVoucher($checkVoucherId){
        
        CheckVoucher::destroy($checkVoucherId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.billing.check-voucher-table', [
            'checkVoucher' => CheckVoucher::with('getSupplierId', 'getTransactionStatus')->get(),
        ]);
    }
}
