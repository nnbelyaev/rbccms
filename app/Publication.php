<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Publication extends Model
{
    use \Dimsav\Translatable\Translatable;

    const LIST_TOP_PORTAL = 1000000;
    const TOP_DAILY_PORTAL = 1000002;
    const TOP_LITE_PORTAL = 1000003;
    const TOP_STYLER_PORTAL = 1000004;
    const TOP_VIDEO_PORTAL = 1000005;
    const TOP_NEWS_OBZOR = 1000006;

    const FEED_NEWS = 1000000;
    const FEED_LITE = 1000001;
    const FEED_STYLER = 1000002;

    public $translatedAttributes = ['prefix','heading','lead','imagealt','text','title', 'title_extra','keywords','description'];
    protected $fillable = ['type','office','status','dtpub','dtend','rubric_id','region_id','story_id','ukrnet_id','bold',
                           'color','exclusive','has_photo','has_video','maindomain','webpush','webpush_sended','image',
                           'extra','tags','readalso','authors','editor_id','corrector_id','locked'];

    public static function boot() {
        parent::boot();

        static::creating(function ($publication) {
            $publication->slug = Str::slug($publication->heading).'-'.time().'.html';
        });
        static::created(function ($publication) {
            Cache::tags('publications')->flush();
        });
        static::updated(function ($publication) {
            Cache::tags('publications')->flush();
        });
        static::deleted(function ($publication) {
            Cache::tags('publications')->flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
