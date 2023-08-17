<?php

namespace App\Http\Livewire\Billing;

use App\Models\AccountTypes;
use Livewire\Component;
use App\Models\ChartOfAccounts;

class ChartAccountsForm extends Component
{
    public  $chartAccountsId, $account_code, $account_desc, $account_type_id, $statement;

    protected $listeners = [
        'chartAccountsId',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function chartAccountsId($chartAccountsId){
        $this->chartAccountsId = $chartAccountsId;
        // dd($this->chartAccountsId);
        $accountTypes = ChartOfAccounts::find($chartAccountsId);
        $this->account_code = $accountTypes->account_code;
        $this->account_desc = $accountTypes->account_desc;
        $this->account_type_id = $accountTypes->account_type_id;
        $this->statement = $accountTypes->statement;
    }

    public function render()
    {
    
        return view('livewire.billing.chart-accounts-form',[
            'AccountTypes' => AccountTypes::all()
        ]);
    }

    
    public function store(){

        $data = $this->validate([
            'account_code' => 'required',
            'account_desc' => 'required',
            'account_type_id' => 'nullable',
            'statement' => 'nullable',
        ]);

        try
		{
            if($this->chartAccountsId){
                ChartOfAccounts::find($this->chartAccountsId)->update($data);
            }else{
                ChartOfAccounts::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->chartAccountsId){
            $action = 'edit';
            $message = 'Chart Of Accounts Successfully Updated';
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Chart Of Accounts Successfully Saved';
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeChartAccountsModal');
    }
}
