<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ghanem\Rating\Traits\Ratingable as Rating;

class PackageDetails extends Model
{
    use Rating;

    public function master()
    {
        return $this->belongsTo('\App\Packages', 'package_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destination()
    {
        return $this->belongsTo('\App\Destination');
    }

    public function scopeUniquePackage($query)
    {
        return $query->groupBy('package_id');
    }
}
