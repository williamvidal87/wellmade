<?php

namespace App\Http\Livewire\Billing;

use App\Models\Bank;
use App\Models\ChartOfAccounts;
use Livewire\Component;

class BankForm extends Component
{

    public $abbrv_bank, $bank_name, $gl_account_id, $bankId;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'bankId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    //edit
    public function bankId($bankId)
    {
        $this->bankId = $bankId;
        $bank = Bank::find($bankId);
        $this->abbrv_bank = $bank->abbrv_bank;
        $this->bank_name = $bank->bank_name;
        $this->gl_account_id = $bank->gl_account_id;
    }

    public function store()
    {

        $data = $this->validate([
            'abbrv_bank' => 'nullable',
            'bank_name' => 'nullable',
            'gl_account_id' => 'nullable',
        ]);

        try {
            if ($this->bankId) {
                Bank::find($this->bankId)->update($data);
            } else {
                Bank::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->bankId) {
            $action = 'edit';
            $message = 'Bank Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Bank Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParentBank');
        $this->emit('closeBankModal');
    }

    public function render()
    {
        return view('livewire.billing.bank-form', [
            // 'gl_accounts' => ChartOfAccounts::with('getAccountTypes')->get(),
            'gl_accounts' => ChartOfAccounts::all(),
        ]);
    }
}
