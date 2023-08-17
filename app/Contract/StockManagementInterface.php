<?php

namespace App\Contract;

interface StockManagementInterface{

    public function addItem($id, $qty);
    public function deductItem($id, $qty);
    public function fetchItem($id);
    public function getCount();
    public function updateStock($id, array $item);
    public function removeStock($id);

}