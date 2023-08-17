<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessGroup extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'process_groups';
    protected $fillable = ['process_group_name'];
    public $timestamps = false;
}
