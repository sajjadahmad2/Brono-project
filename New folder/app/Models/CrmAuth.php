<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmAuth extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'access_token', 'refresh_token', 'user_type', 'location_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
