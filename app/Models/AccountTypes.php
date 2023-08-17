<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountTypes extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;
    
    protected $fillable = ["account_code", "account_type"];
    
    public function getAccountTypes()
    {
        return $this->hasMany(ChartOfAccounts::class);
    }
}
