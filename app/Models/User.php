<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;
    use HasApiTokens;


    protected $table = 'users';

    public const STATUS_SELECT = [
        '0' => 'غير فغال',
        '1' => 'فعال',
    ];

    // public $table = 'users';
    public const DIR_UPLOAD = 'users';

    protected $appends = [
        'image_url',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'qualification',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'mobile',
        'jobId',
        'area_1',
        'home_address',
        'whatsapp_phone',
        'facebook',
        'instagram',
        'website',
        'category_id',
        'item_id',
        'remember_token',
        'user_type',
        'fcm_token',
        'code',
        'status',
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function userHits()
    {
        return $this->hasMany(Hit::class, 'user_id', 'id');
    }

    public function userNotifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }
    protected function user_type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["1", "2"][$value],
        );
    }
    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
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

    public function getImageUrlAttribute($value)
    {
        return is_null($this->image) ? "" : assetUpload(self::DIR_UPLOAD . '/' . $this->image);
    }
}
