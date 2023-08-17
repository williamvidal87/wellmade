<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockManagement extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'unit_type_id',
        'inventory_type_id',
        'brand',
        'item_code',
        'supplier',
        'name',
        'description',
        'serial',
        'unit_price',
        'qty',
        'REP',
        'conversion_rate',
        'loan_consume_ids',
        'department_id',
        'item_image',
        'acquisition_cost',
    ];

    public function suppliers()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier');
    }

    public function unitTypes()
    {
        return $this->hasOne(UnitType::class, 'id', 'unit_type_id');
    }
    public function getInventoryType()
    {
        return $this->hasOne(InventoryType::class, 'id', 'inventory_type_id');
    }

    public function getDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    
}

