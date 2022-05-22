<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\ThemesCategory');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Packages');
    }

    public function image()
    {
        return $this->hasMany('App\Models\ThemesImage', 'theme_id');
    }
}
