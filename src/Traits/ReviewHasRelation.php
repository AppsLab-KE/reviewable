<?php


namespace Reviewable\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Reviewable\Events\MonitorReview;
use Reviewable\Models\Occurrence;

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

    public function occurrences()
    {
        return $this->morphMany(Occurrence::class, 'occurrable');
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