<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegator extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'ar_name',
        'en_name',
        'mobile',
        'email',
        'phone',
        'address',
        'user_id',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',

    ];
}
