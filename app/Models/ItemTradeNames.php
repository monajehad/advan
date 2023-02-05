<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemTradeNames extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'trade_name','item_id',
        'user_id'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',

    ];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
