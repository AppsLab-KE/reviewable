<?php


namespace Reviewable;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Reviewable\Events\MonitorReview;
use Reviewable\Listeners\ReviewCreated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MonitorReview::class => [
            ReviewCreated::class
        ]
    ];

     /**
      * Register any events for your application.
      *
      * @return void
      */
    public function boot()
    {
        parent::boot();
    }
}
