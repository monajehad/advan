<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class System_logs extends Model
{

    protected $table = 'system_logs';

    public function Details()
    {
        return $this->hasMany(Log_details::class,'log_id');
    }
}
