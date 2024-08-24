<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ghl_contact_id',
        'location_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'company',
        'website',
        'source',
        'type',
        'assigned_to',
        'tags',
        'followers',
        'additional_emails',
        'attributions',
        'custom_fields',
        'dnd',
        'dnd_settings_email',
        'dnd_settings_sms',
        'dnd_settings_call',
        'date_added',
        'date_updated',
        'date_of_birth',
        'deleted_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'followers' => 'array',
        'additional_emails' => 'array',
        'attributions' => 'array',
        'custom_fields' => 'array',
    ];





}
