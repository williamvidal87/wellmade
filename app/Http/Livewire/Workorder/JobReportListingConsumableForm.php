<?php

namespace App\Http\Livewire\Workorder;

use App\Models\Contact;
use App\Models\DailyConsumeReport;
use App\Models\Department;
use App\Models\JobTypes;
use App\Models\StockManagement;
use App\Models\User;
use App\Models\WorkArea;
use App\Models\WorkLoadUsedTools;
use Livewire\Component;

class JobReportListingConsumableForm extends Component
{
    public $stock_management_id ,$user_id, $work_area_id, $department_id, $quantity, $total, $date_of_use;
    
    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function closeModalConsumable()
    {
        $this->resetInputFields();      
    }

    public function render()
    {
        return view('livewire.workorder.job-report-listing-consumable-form',[
            'stocks' => StockManagement::all(),
            'user_auth' => User::all(),
            'workArea' => WorkArea::all(),    
            'operator'  => User::role('Operator')->get(),
            'departments' => Department::all()     
        ]);
    }

    public function store()
    { 
      
        $data = $this->validate([
            'stock_management_id' => '',
            'user_id'     => '',
            'work_area_id' => '',
            'department_id' => '',
            'quantity' =>'',
            'total' =>''
        ]);

        try {
          
            if($this->stock_management_id){
                $stock_price = StockManagement::where('id',$this->stock_management_id)->get();
              
                foreach($stock_price as $price) {
                    
                    $total_price = 0;                  
                    $for_total = DailyConsumeReport::create($data);
                    $total_price+=$price->unit_price*$for_total->quantity;   //add total unit price
                    $price->decrement('qty', $for_total->quantity);          //deduct quantity stock management
                  
                }
                $for_total->update([
                    'total' => $total_price
                ]);                          
            }   
           
        } catch (\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action,);
        }

        // if ($this->clientContactId) {
        //     $action = 'edit';
        //     $message = 'Client Contact Successfully Updated';
        //     // dd($action);
        //     $this->emit('flashAction', $action, $message);
        // } else {
            $action = 'store';
            $message = 'Daily Consume Successfully Saved';          
            $this->emit('flashAction', $action, $message);
        // }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeConsumableModal');

    }
}
