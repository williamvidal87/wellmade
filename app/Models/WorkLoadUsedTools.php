<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class WorkLoadUsedTools extends Model
{
    use HasFactory;
    
    protected $fillable = ['work_order_id','item_names','quantity','total'];

   public function getStockManagement()
   {
       return $this->hasOne(StockManagement::class,'id','item_names');    
   }

}
