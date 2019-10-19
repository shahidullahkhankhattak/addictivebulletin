<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = "source";
    protected $fillable = ['source', 'slug', 'website', 'lang', 'color', 'default'];
}
