<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineDescription extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'machine_description_number_id',
        'description'
    ];
    
    public function getmachinedescriptionnumberid(){
        return $this->belongsTo(MachineIdNumber::class, 'machine_description_number_id');
    }
}
