<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'tender_no','tender_type',
        'guarantee_type','guarantee_rate',
        'guarantee_no','guarantee_value',
        'guarantee_file','guarantee_status',
        'transfer_price','suppliers_prices_file',
        'currency','bid_status',
        'tax','complete_status',
        'tender_file',
        'referral_file',
        'client_id',
        'user_id',
        'representation_date',
        'notification_receipt_date',
        'manager','comany_branch','users',
        'notification_file','sector'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function items()
    {
        return $this->hasMany(TenderItem::class);

    }
}
