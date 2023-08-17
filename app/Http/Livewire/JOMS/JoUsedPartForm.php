<?php

namespace App\Http\Livewire\JOMS;

use App\Models\JobOrder;
use App\Models\RequestTool;
use Livewire\Component;

class JoUsedPartForm extends Component
{

    public $jo_no_id, $jo_no;
    public $jo_used_parts = [];

    protected $listeners = [
        'setJoUsedPartView'
    ];

    public function setJoUsedPartView($id)
    {
        $this->jo_no_id = $id;

        $jo = JobOrder::where('id', $id)->pluck('jo_no')->first();
        $this->jo_no = $jo;

        $this->jo_used_parts = RequestTool::with('getJobOrder', 'getRequestBy', 'requestToolsData.getStockManagment.getDepartment')
        ->where('jo_no_id', $id)
        ->get();
    }

    public function render()
    {
        return view('livewire.j-o-m-s.jo-used-part-form');
    }
}
