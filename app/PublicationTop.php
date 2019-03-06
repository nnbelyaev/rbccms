<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicationTop extends Model
{
    public $timestamps = false;
    public $guarded = [];
    protected $table = 'publications_top';
}
