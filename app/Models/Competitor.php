<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competitor extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'phone',
        'address',
        'user_id',
        'status',
        'color'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',

    ];
}
