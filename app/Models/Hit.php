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
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_id',
        'date',
        'time',
        'area_1',
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
        'category',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

   public function getDateAttribute($value)
   {
       return  Carbon::parse( $value)->format('Y-m-d');
   }

   public function setDateAttribute($value)
   {
       $this->attributes['date'] = $value ? Carbon::createFromFormat('Y-m-d',$value)->format('Y-m-d') : null;
   }

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

    public function names()
    {
        return $this->belongsToMany(Client::class);
    }

//    protected function serializeDate(DateTimeInterface $date)
//    {
//        return $date->format('Y-m-d');
//    }
}
