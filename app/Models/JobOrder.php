<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrder extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $casts = [
        'item_image' => 'array',
    ];
    
    protected $guarded = [];

    protected $dates = ['date','po_date','date_receive','date_commited'];

    protected $fillable = [
        'reference_no', 'date', 'jo_no',
        'customer_id','po_no','po_date','csa','contact_person',
        'engine_model','makelist_id','category','serial_no','date_receive',
        'date_commited','terms_of_payment','remarks','edit_reason',
        'status','payment_status_id','item_image','work_date_start','work_date_end',
        'term', 'discount','encoder', 'er_total', 'mf_total', 'calib_total', 'overall_total',
        'part_total', 'token_scan',
    ];
    
    public function getName(){
        $name = ClientProfile::whereid('customer_id')->get();
        return $name;
    }

    public function getJobOrderTransaction()
    {
        return $this->hasOne(TransactionSummary::class, 'jo_no', 'id');
    }

    public function clientProfile(){
        return $this->belongsTo(ClientProfile::class, 'customer_id');
    }
    public function statusess(){
        return $this->belongsTo(Status::class, 'status');
    }
    public function paymentStatus(){
        return $this->belongsTo(Status::class, 'status');
    }
    public function engineModel(){
        return $this->belongsTo(EngineModel::class, 'engine_model');
    }
    public function typesofPayment(){
        return $this->belongsTo(TypeOfPayment::class, 'terms_of_payment');
    }
    public function engineCategories(){
        return $this->belongsTo(EngineCategory::class, 'category');
    }

    public function getClientProfile()
    {
        return $this->hasOne(ClientProfile::class, 'id', 'customer_id');
    }
    
    public function getStatus()
    {
        return $this->hasOne(Status::class, 'id', 'status');
    }
    public function getMakeList(){
        return $this->belongsTo(MakeList::class, 'makelist_id')->withTrashed();
    }

    public function getCSA(){
        return $this->belongsTo(CsaType::class, 'csa');
    }
    public function WorkOrders(){
        return $this->hasMany(WorkOrder::class, 'jo_no_id');
    }

    public function getContact()
    {
        return $this->belongsTo(Contact::class, 'contact_person');
        
    }

    public function getJobOrder(){
        return $this->belongsTo(ClientProfile::class, 'customer_id');
    }

    //for reconciliation
    public function getClient()
    {
        return $this->belongsTo(ClientProfile::class, 'customer_id');
    }

   
    public function getEncoder(){

        return $this->belongsTo(User::class, 'encoder');
    }

    public function getTransactionSummary()
    {
        return $this->hasOne(TransactionSummary::class, 'jo_no', 'id')->whereIn('transaction_status_id', [1,2])->whereIn('status_id', [12,13]);
    }
    public function getWorkOrder()
    {
        return $this->hasMany(WorkOrder::class, 'jo_no_id');;
    }
}
