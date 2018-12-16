<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'description', 'image_url', 'release_year', 'gross_profit', 'director'];

    public function actors()
    {
        return $this->hasMany('App\Actor');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }


}
