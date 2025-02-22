<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public $table = 'chats';

    protected $fillable=[
        'sender_id',
        'sender_name',
        'message'
    ];
}
