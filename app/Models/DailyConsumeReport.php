<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyConsumeReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_management_id',
        'user_id',
        'work_area_id',
        'department_id',
        'quantity',
        'total'
    ];

    public function getStockManagement()
    {
        return $this->belongsTo(StockManagement::class, 'stock_management_id');
    }

    public function getWorkArea()
    {
        return $this->belongsTo(WorkArea::class, 'work_area_id');
    }

    public function getDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
