<?php

namespace App\Models;

use App\Http\Livewire\Inventory\StockForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestToolData extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'request_tool_id',
        'item_id',
        'qty',
        'update_request_tool_data',
        'request_tool_arrangement',
        'selling_price',
    ];

    public function getStockManagment()
    {
        return $this->hasOne(StockManagement::class, 'id', 'item_id')->withTrashed();
    }

    public function getDepartment()
    {
        return $this->belongsTo(StockManagement::class, 'item_id')->withDefault();
    }

    public function getRequestTool()
    {
        return $this->belongsTo(RequestTool::class, 'request_tool_id');
    }
  
    
  
}
