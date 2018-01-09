<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDetails extends Model
{
    public function master()
    {
        return $this->belongsTo('\App\Packages');
    }

    public function destination()
    {
        return $this->belongsTo('\App\Destination');
    }
}
