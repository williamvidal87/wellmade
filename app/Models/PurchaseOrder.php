<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'date',
        'pr_no',
        'supplier_id',
        'all_total_price',
        'status_id',
        'remarks',
        'user_id',
    ];

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function stockManagements()
    {
        return $this->belongsToMany(StockManagement::class, 'procurement_items', 'pr_id', 'stock_id');
    }

    // public function procurementItems()
    // {
    //     return $this->belongsToMany(ProcurementItems::class, 'procurement_items', 'id', 'pr_id');
    // }

    public function suppliers()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function statuses()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function getStatus()
    {
        return $this->hasOne(Status::class,'id','status_id');
    }

    public function getProcurementItems()
    {
        return $this->hasMany(ProcurementItems::class, 'pr_id', 'id')->orderBy('product_arrangement');
    }

}
