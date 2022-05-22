<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    public function themes()
    {
        return $this->hasMany('App\Models\Themes', 'package_id', 'id');
    }
}
