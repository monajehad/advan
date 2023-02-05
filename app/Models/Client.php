<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Client extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'ar_name',
        'en_name',
        'email',
        'mobile',
        'phone',
        'address',
        'user_id',
        'status',
        'licensed_operating_no'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',

    ];
    public function representatives()
    {
        return $this->hasMany(ClientRepresentative::class);
    }
}
