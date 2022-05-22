<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemesCategory extends Model
{
    use HasFactory;

    protected $table = 'themes_category';
    protected $fillable = [
        'name',
    ];

    public function themes()
    {
        return $this->hasMany('App\Models\Themes', 'category_id', 'id');
    }
}
