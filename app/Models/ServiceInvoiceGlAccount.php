<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInvoiceGlAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_invoice_id',
        'account_number',
        'account_title',
        'debits',
        'credits',
    ];

}
