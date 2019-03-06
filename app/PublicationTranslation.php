<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['prefix','heading','lead','imagealt','text','title', 'title_extra','keywords','description'];
    protected $table = 'publication_letters';
}
