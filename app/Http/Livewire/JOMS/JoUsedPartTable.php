<?php

namespace App\Http\Livewire\JOMS;

use App\Models\JobOrder;
use App\Models\RequestTool;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;

class JoUsedPartTable extends Component
{

    public function viewJoUsedPart($id)
    {
        $this->emit('setJoUsedPartView', $id);
        $this->emit('openJoUsedPartsModal');
    }

    public function printJoUsedPart($id)
    {
        $jo_used_parts = RequestTool::with('getJobOrder', 'getRequestBy', 'requestToolsData.getStockManagment.getDepartment')
                ->where('jo_no_id', $id)
                ->get();

        $job_order = JobOrder::where('id', $id)->pluck('jo_no')->first();

        $pdf  = PDF::loadView('livewire.prints.jo-used-parts', ['jo_used_parts' => $jo_used_parts, 'jo_no' => $job_order])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"jo-used-parts.pdf"
        );     
    }

    public function render()
    {
        return view('livewire.j-o-m-s.jo-used-part-table',[
            'jo_used_parts' =>RequestTool::with('getJobOrder', 'getRequestBy')
                                ->whereNotNull('jo_no_id')
                                ->get()
                                ->groupBy('getJobOrder.jo_no'),
        ]);
    }
}
