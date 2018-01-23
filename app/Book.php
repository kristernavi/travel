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

    public function transactions()
    {
        return $this->hasMany(CardTranscation::class);
    }
}
