<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','regalia','dossie'];
    protected $table = 'author_names';
}
