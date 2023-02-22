<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Client extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;
    protected $connection = 'mysql';
    public const STATUS_SELECT = [
        '0' => 'غير فعال',
        '1' => 'فعال',
    ];

    public $table = 'clients';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'qualification',
        'specialty_id',
        'category',
        'item',
        'mobile',
        'home_address',
        'whatsapp_phone',
        'facebook',
        'instagram',
        'website',
        'email',
        'phone',
        'area_1',
        'area_2',
        'area_3',
        'address_1',
        'address_2',
        'address_3',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'times_work',
        'latitude',
        'longitude',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function clientHits()
    {
        return $this->hasMany(Hit::class, 'client_id', 'id');
    }
    // public function hits()
    // {
    //     return $this->hasMany(Hit::class);
    // }
    public function representatives()
    {
        return $this->hasMany(ClientRepresentative::class);
    }
    public function specialty()
    {
        return $this->belongsTo(ClientsSpecialty::class, 'specialty_id');
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query
                ->where('name', 'LIKE' , '%'.$value.'%')
                ->orWhere('doctor_name', 'LIKE' , '%'.$value.'%');
        });
    }

}
