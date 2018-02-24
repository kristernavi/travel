<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function package()
    {
        return $this->belongsTo(Packages::class);
    }

    public function service()
    {
        return $this->belongsTo(PackageDetails::class,'service_id');
    }

    public function transactions()
    {
        return $this->hasMany(CardTranscation::class);
    }
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
