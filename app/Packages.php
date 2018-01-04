<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    public function details(){
    	return $this->hasMany('\App\PackageDetails', 'package_id');
    }
}
