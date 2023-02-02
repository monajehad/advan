<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetitorsItems extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'item_id',
        'item_price',
        'tender_id',
        'user_id',
        'competitor_id',
        'currency_id',
        'note',
        'awarded',


        

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
