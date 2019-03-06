<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Author extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','regalia','dossie'];
    protected $fillable = ['office','image'];

    public static function boot() {
        parent::boot();

        static::created(function ($rubric) {
            Cache::tags('authors')->flush();
        });
        static::updated(function ($rubric) {
            Cache::tags('authors')->flush();
        });
        static::deleted(function ($rubric) {
            Cache::tags('authors')->flush();
        });
    }
}
