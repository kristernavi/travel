<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'link', 'long', 'lat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packages()
    {
        return $this->hasMany(PackageDetails::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
