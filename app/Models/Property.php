<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref', 'price', 'currency', 'price_freq', 'new_build',
        'type', 'town', 'province', 'location_detail', 'beds',
        'baths', 'pool', 'status',
    ];
    protected $with = ['location', 'energyRating', 'surfaceArea','features', 'images','descriptionEn','urlEn'];

    // Relationships
    public function location()
    {
        return $this->hasOne(PropertyLocation::class);
    }
    public function descriptionEn()
    {
        return $this->hasOne(PropertyDescription::class)->where('language', 'en');
    }
    public function urlEn()
    {
        return $this->hasOne(PropertyUrl::class)->where('language', 'en');
    }
    public function energyRating()
    {
        return $this->hasOne(PropertyEnergyRating::class);
    }

    public function surfaceArea()
    {
        return $this->hasOne(PropertySurfaceArea::class);
    }

    public function urls()
    {
        return $this->hasMany(PropertyUrl::class);
    }

    public function descriptions()
    {
        return $this->hasMany(PropertyDescription::class);
    }

    public function features()
    {
        return $this->hasMany(PropertyFeature::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
    public function locationWithSpecificColumns()
    {
        return $this->hasOne(PropertyLocation::class)
                    ->select(['longitude','latitude']);
    }

    public function descriptionEnWithSpecificColumns()
    {
        return $this->hasOne(PropertyDescription::class)
                    ->select(['description'])
                    ->where('language', 'en');
    }

    public function urlEnWithSpecificColumns()
    {
        return $this->hasOne(PropertyUrl::class)
                    ->select(['url'])
                    ->where('language', 'en');
    }

    public function energyRatingWithSpecificColumns()
    {
        return $this->hasOne(PropertyEnergyRating::class)
                    ->select(['emissions','consumption']);
    }

    public function surfaceAreaWithSpecificColumns()
    {
        return $this->hasOne(PropertySurfaceArea::class)
                    ->select(['built','plot']);
    }

    public function featuresWithSpecificColumns()
    {
        return $this->hasMany(PropertyFeature::class)
                    ->select(['feature']);
    }

    public function imagesWithSpecificColumns()
    {
        return $this->hasMany(PropertyImage::class)
                    ->select(['url']);
    }
    public function scopeSearchByType($query, $type)
    {
        $trimmedType = trim(strtolower($type));
        return $query->whereRaw('TRIM(LOWER(`type`)) LIKE ?', ["%{$trimmedType}%"]);
    }
}
