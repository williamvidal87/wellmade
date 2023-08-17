<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $fillable = ['name', 'client_types_id', 'address', 'contact_no', 'image', 'csa_type_id', 'status_id'];

    public function getClientType()
    {
        return $this->belongsTo(ClientType::class, 'client_types_id');
    }

    public function getCsaType()
    {
        return $this->belongsTo(CsaType::class, 'csa_type_id');
    }

    public function getStatus()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

}
