<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccounts extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = ["account_code", "account_desc", "account_type_id", "statement"];
    
    public function getAccountTypes()
    {
        return $this->belongsTo(AccountTypes::class,'account_type_id')->withTrashed();
    }
}
