<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'item_no','name','unit',
        'status','user_id','pharmaceutical_form'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',

    ];
    public function trade_names()
    {
        return $this->hasMany(ItemTradeNames::class);
    }
    public function sample_stocks(){
        return $this->hasMany(\App\Models\SampleStock::class);
    }
}
