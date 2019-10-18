<?php


namespace Reviewable\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Event;
use Reviewable\Events\MonitorReview;

trait ReviewHasRelation
{
    protected $dispatchesEvents = [
        'created' => MonitorReview::class,
        'saved' => MonitorReview::class
    ];

    public function reviewable() : MorphTo
    {
        return $this->morphTo('reviewable');
    }

    public function reviewer() : MorphTo
    {
        return $this->morphTo('reviewer');
    }

    public function boot()
    {
        parent::boot();
        static::saved(function ($item){
            Event::fire('item.saved', $item);
        });
        static::created(function ($item){
            Event::fire('item.saved', $item);
        });
    }
}