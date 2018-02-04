<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    public function details()
    {
        return $this->hasMany('\App\PackageDetails', 'package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
