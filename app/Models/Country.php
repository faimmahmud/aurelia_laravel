<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'iso2',
        'iso3',
        'phone_code',
        'currency',
        'flag',
        'hero_image',
        'description',
        'status',
        'sort_order',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($country) {

            if (empty($country->slug)) {
                $country->slug = Str::slug($country->name);
            }
        });

        static::updating(function ($country) {

            if (empty($country->slug)) {
                $country->slug = Str::slug($country->name);
            }
        });
    }
}
