<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ghl_opportunity_id',
        'location_id',
        'assigned_to',
        'contact_id',
        'monetary_value',
        'name',
        'pipeline_id',
        'pipeline_stage_id',
        'source',
        'status',
        'date_added',
    ];
}
