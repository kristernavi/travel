<?php

namespace App;

use Ghanem\Rating\Traits\Ratingable as Rating;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use Rating;

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
