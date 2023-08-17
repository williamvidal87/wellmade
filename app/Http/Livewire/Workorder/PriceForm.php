<?php

namespace App\Http\Livewire\Workorder;

use App\Models\RequestToolData;
use Livewire\Component;

class PriceForm extends Component
{
    public $selling_price, $request_tools_id, $jo_no_id;

    protected $listeners = [
        'resetInputFields',
        'setAttribPrice',
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function setAttribPrice($request_tools_id, $jo_no_id)
    {
        $this->request_tools_id = $request_tools_id;
        $this->jo_no_id = $jo_no_id;
    }

    public function store()
    {
        $data = $this->validate([
            'selling_price' => 'required',
        ]);

        try {

            if($this->request_tools_id != null && $this->jo_no_id != null){
                RequestToolData::where('id', $this->request_tools_id)->update($data);
            }

        } catch (\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        $this->emit('closePriceModal');
        $this->emit('refreshAddWorkTable');
        $this->resetInputFields();
    }

    public function render()
    {
        return view('livewire.workorder.price-form');
    }
}
