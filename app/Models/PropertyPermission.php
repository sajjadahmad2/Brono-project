<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPermission extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'property_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'column_name',
        'editable',
        'company_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    /**
     * Get the company that owns the property permission.
     */
    public function company()
    {
        return $this->belongsTo(User::class);
    }
}
