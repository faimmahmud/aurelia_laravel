<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'country',
        'thumbnail',
        'short_description',
        'description',
        'featured',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
    ];
}
