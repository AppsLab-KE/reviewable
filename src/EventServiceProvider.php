<?php


namespace Reviewable;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listener = [
        'Reviewable\Events\MonitorReview' => [
            'Reviewable\Listeners\ReviewCreated'
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

        //
    }
}
