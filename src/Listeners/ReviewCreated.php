<?php

namespace Reviewable\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Reveiwable\Events\MonitorReview;

class ReviewCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RiderRequest  $event
     * @return void
     */
    public function handle(MonitorReview $event)
    {
        if(config('reviewable.monitor')){
            $getMonitors = app(config('reviewable.models.monitor'))->all();
            foreach ($getMonitors as $monitor){

            }
            dd($event->review);
        }
    }
}
