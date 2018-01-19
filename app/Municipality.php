<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
