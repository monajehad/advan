<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hit extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $connection = 'mysql';
    public const STATUS_SELECT = [
        '0' => 'حفظ',
        '1' => 'اعتماد نهائي',
    ];

    public const TYPE_SELECT = [
        '1' => 'زيارة عيادة',
        '2' => 'زيارة مستشفيات',
    ];


    public $table = 'hits';

    protected $dates = [
        'date_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'clinic_id',
        'date_time',
        'visit_type_id',
        'duration_visit',
        'number_samples',
        'address',
        'report_type',
        'report_status',
        'user_id',
        'note',
        'sms_id',
        'sms_message',
        'type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

//    public function getDateTimeAttribute($value)
//    {
//        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
//    }

//    public function setDateTimeAttribute($value)
//    {
//        $this->attributes['date_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
//    }

    public function visit_type()
    {
        return $this->belongsTo(HitsType::class, 'visit_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sms()
    {
        return $this->belongsTo(KindsOfOccasion::class, 'sms_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function samples()
    {
        return $this->hasMany(HitsSamples::class , 'hit_id' , 'id');
    }

    public function doctors()
    {
        return $this->belongsToMany(Clinic::class);
    }

//    protected function serializeDate(DateTimeInterface $date)
//    {
//        return $date->format('Y-m-d');
//    }
}
