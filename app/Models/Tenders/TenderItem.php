<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenderItem extends Model
{
    use HasFactory,SoftDeletes;

    protected $table="tender_items";
    protected $connection = 'mysql_second';

    protected $fillable = [
        'item_id','unit','expired_date',
        'item_quantity','trade_name',
        'item_price','supplied_quantity',
        'type','duration','notes',
        'tender_id','has_priority',
        'user_id',
        'supplier_id',
        // 'price_accepted',
        'accepted_item'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }
}
