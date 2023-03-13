<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sample extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $connection = 'mysql';
    public const STATUS_SELECT = [
        '0' => 'قيد الانتظار',
        '1' => 'تاكيد الطلب',
        '2' => 'تم الاستلام',
    ];

    public $table = 'samples';
    protected $filters = [
        UserFilter::class,
    ];
    protected $dates = [
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sample_id',
        'user_id',
        'quantity_request',
        'date',
        'unit',
        'type',
        'category_id',
        'item_id',
        // 'end_date',
        'stock_available_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'received_date',
    ];

    public function sample()
    {
        return $this->belongsTo(SampleStock::class, 'sample_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m') ;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(('Y-m'), $value)->format('Y-m') : null;
    }

    public function stock_available()
    {
        return $this->belongsTo(SampleStock::class, 'stock_available_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
