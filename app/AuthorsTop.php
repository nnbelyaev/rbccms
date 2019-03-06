<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorsTop extends Model
{
    public $timestamps = false;
    public $guarded = [];
    protected $table = 'authors_top';
}
