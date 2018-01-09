<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'link', 'long', 'lat',
    ];
}
