<?php

namespace App\Service;

use App\Contract\StockManagementInterface;
use App\Models\StockManagement;
use Illuminate\Support\Facades\Session;

class StockManagementService implements StockManagementInterface{

    public function addItem($id, $qty)
    {
        //Current item 
        $current = StockManagement::find($id);
        // Adding
        $current->qty += (int) $qty;
        $current->save();

        return $current;
    }

    public function deductItem($id, $qty)
    {
        // Current item
        $current = StockManagement::find($id);
        // Deduction
        $total_item = $current->qty - (int) $qty;

        if($total_item < 0){
            return Session::flash('messageDeductionError', 'The qty is too large!');
        }else{
            return StockManagement::where('id', $id)->update(['qty' => $total_item]);
        }
    }

    public function fetchItem($id)
    {
        return StockManagement::find($id);
    }

    public function getCount()
    {
        return StockManagement::count();
    }

    public function updateStock($id, array $item)
    {
        return StockManagement::find($id)->update($item);
    }

    public function removeStock($id)
    {
        return StockManagement::destroy($id);
    }

}