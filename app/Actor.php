<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function movies()
    {
        return $this->belongsTo('App\Movie');
    }
}
