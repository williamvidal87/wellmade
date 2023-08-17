<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestPart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["request_tools_id", "jo_no_id"];

    public function getRequestTool()
    {
        return $this->belongsTo(RequestTool::class, 'request_tools_id');
    }

}
