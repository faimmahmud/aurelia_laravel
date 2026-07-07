<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'title', 'country', 'price', 'rating', 'days',
        'image', 'description', 'category',
    ];

    public function features()
    {
        return $this->hasMany(PackageFeature::class)->orderBy('sort_order');
    }
}
