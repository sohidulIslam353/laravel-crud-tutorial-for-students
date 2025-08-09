<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = ['user_id', 'title', 'slug', 'image', 'description'];

    // set title always  ucfirst by mutator
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);  //this is kachamorich
    }
}
