<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class ClientProfile extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'name',
        'client_type',
        'csa_id',
        'branch_id',
        'address',
        'contact_no',
        'contact_person',
        'email',
        'tin_no',
        'invoice_issued_id',
        'discount_er',
        'discount_mf',
        'discount_spareparts',
        'discount_calib',
        'payment_type_id',
        'status_id',
    ];

    public function clientTypes(){
        return $this->belongsTo(ClientType::class, 'client_type');
    }
    public function forCSA(){
        return $this->belongsTo(CsaType::class, 'csa_id');
    }
    public function forBranch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function contacts()
    {
        return $this->belongsTo(Contact::class, 'contact_person');
    }
    // public function clientTypes()
    // {
    //     return $this->hasOne(ClientType::class, 'id', 'job_type_id');
    // }
    public function jobOrder(){
        
        return $this->hasOne(JobOrder::class, 'customer_id');
    }

    public function getPaymentType()
    {
        return $this->belongsTo(CsaType::class, 'csa_id');
    }

    public function getStatus()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
