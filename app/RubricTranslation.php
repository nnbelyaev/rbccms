<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RubricTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','h1','title','keywords','description'];

}
