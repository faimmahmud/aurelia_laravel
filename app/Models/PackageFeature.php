<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageFeature extends Model
{
    protected $fillable = ['package_id', 'feature', 'sort_order'];
    public $timestamps = false;

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
