<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SampleStock extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $connection = 'mysql';
    public const STATUS_SELECT = [
        '0' => 'غير فعال',
        '1' => 'فعال',
    ];

    public $table = 'sample_stocks';

    protected $dates = [
        // 'received_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'quantity',
        'received_quantity',
        // 'received_date',
        'end_date',
        'category_id',
        'item_id',
        'unit',
        'date',
        'available',
        'patch_number',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function getReceivedDateAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    // }

    // public function setReceivedDateAttribute($value)
    // {
    //     $this->attributes['received_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(('Y-m-d')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(('Y-m-d'), $value)->format('Y-m-d'): null;
    }
    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(('Y-m-d'), $value)->format('Y-m-d'): null;
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
