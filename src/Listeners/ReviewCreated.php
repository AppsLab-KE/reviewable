<?php

namespace Reviewable\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Reviewable\Events\MonitorReview;
use Reviewable\Models\Occurrence;

class ReviewCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

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
                $found = preg_match_all("/\b".$monitor->name."\b/i", $event->review->review, $matches,PREG_PATTERN_ORDER);
                $occ = new Occurrence();
                if ($found){
                    $event->review->occurrences()->save($occ->fill(array_merge([
                        'count' => $found,
                        'type' => $monitor->type
                    ], [
                        'occurrable_id' => $event->review->id,
                        'occurrable_type' => get_class($event->review)
                    ])));
                }
            }
            dd($event->review->review,'d');
        }
    }
}
