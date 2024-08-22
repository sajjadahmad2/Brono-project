<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ghl_appointment_id',
        'location_id',
        'address',
        'title',
        'calendar_id',
        'contact_id',
        'group_id',
        'appointment_status',
        'assigned_user_id',
        'users',
        'notes',
        'source',
        'start_time',
        'end_time',
        'date_added',
        'date_updated',
    ];
}
