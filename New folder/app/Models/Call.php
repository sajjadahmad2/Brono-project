<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Call extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'type',
        'location_id',
        'attachments',
        'contact_id',
        'conversation_id',
        'date_added',
        'direction',
        'message_type',
        'message_id',
        'status',
    ];
}
