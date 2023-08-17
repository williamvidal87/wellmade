<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'pr_id',
        'qty',
        'unit',
        'update_product',
        'product_arrangement',
        'price',
        'total_price',
        // 'status',
    ];

    protected $cast = [
        'stock_id' => 'integer',
        'qty' => 'integer',
        'price' => 'integer',
        'total_price' => 'integer',
        'status' => 'integer',
    ];

    public function stockManagement()
    {
        return $this->hasMany(StockManagement::class, 'id', 'stock_id')->withTrashed();
    }

    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class, 'id', 'pr_id');
    }

}
