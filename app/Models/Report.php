<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $connection = 'mysql';
    public const STATUS_SELECT = [
        '1' => 'تقرير',
        '2' => 'ارشيف',
    ];

    public $table = 'reports';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'type_id',
        'name',
        'client_id',
        'date',
        'time',
        'client_name',
        'title',
        'description',
        'note',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'hits_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hit()
    {
        return $this->belongsTo(Hit::class, 'hits_id');
    }

    public function type()
    {
        return $this->belongsTo(ReportType::class, 'type_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function getDateAttribute($value)
    {
        return  Carbon::parse($value)->format('Y-m-d') ;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
