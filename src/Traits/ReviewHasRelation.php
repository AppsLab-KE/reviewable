<?php


namespace Reviewable\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Event;
use Reviewable\Events\MonitorReview;

trait ReviewHasRelation
{

    public function reviewable() : MorphTo
    {
        return $this->morphTo('reviewable');
    }

    public function reviewer() : MorphTo
    {
        return $this->morphTo('reviewer');
    }

    public static function boot()
    {
        parent::boot();
        static::saved(function ($item){
            event(new MonitorReview($item));
        });
        static::created(function ($item){
            event(new MonitorReview($item));
        });
    }
}