<?php

namespace App\Http\Livewire\JOMS;

use App\Models\JobOrder;
use Livewire\Component;

class ScanIncentive extends Component
{

    public $incentiveScannedID, $job_orders, $dupScanId;
    public $isValid = false;

    public function updatedIncentiveScannedId($id)
    {
        $this->incentiveScannedID = $id;
        $this->dupScanId = $id;
        // Verifies if its legitimate
        $scannedId = JobOrder::with('getContact')->where('token_scan', $id)->first();
        if($scannedId != null){
            $this->job_orders = $scannedId;
            $this->isValid = true;
        }else{
            $this->isValid = false;
        }

        $this->incentiveScannedID = "";
    }

    public function render()
    {
        return view('livewire.j-o-m-s.scan-incentive');
    }
}