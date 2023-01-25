<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KindsOfOccasion extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $connection = 'mysql';
    
    public const STATUS_SELECT = [
        '0' => 'غير فعالة',
        '1' => 'فعالة',
    ];

    public $table = 'kinds_of_occasions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
