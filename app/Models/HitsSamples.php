<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HitsSamples extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'hits_samples';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'hit_id',
        'sample_id',
        'quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function hits()
    {
        return $this->belongsTo(Hit::class, 'hit_id');
    }


    public function samples()
    {
        return $this->hasOne(Sample::class , 'id' , 'sample_id');
    }
}
