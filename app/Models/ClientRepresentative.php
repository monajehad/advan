<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientRepresentative extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'mobile',
        'client_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',

    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
