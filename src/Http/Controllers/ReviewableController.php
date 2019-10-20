<?php

namespace Reviewable\Http\Controllers;


use Illuminate\Routing\Controller;
use Reviewable\Http\Rules\MonitorRule;
use Reviewable\Models\Monitor;
use Reviewable\Models\Occurrence;

class ReviewableController extends Controller
{
    public function createMonitor()
    {
        return view('reviewable::monitors.monitor-form-body');
    }

    public function editMonitor($monitor)
    {
        return view('reviewable::monitors.monitor-form-body')
            ->withMonitor(Monitor::find($monitor));
    }

    public function storeMonitor()
    {
        $this->monitorValidation(request());
        Monitor::create(request()->all());

        return redirect()->route('monitors.monitors');
    }

    public function updateMonitor($monitor)
    {
        $monitor = Monitor::find($monitor);
        $this->monitorValidation(request());
        $monitor->update(request()->all());

        return redirect()->route('monitors.monitors');
    }

    public function reviews()
    {
        $review = config('reviewable.models.review');
        $review = new $review();
        $user = app('App\User')->find(1);

        $hotel = app('App\Models\Hotel')->create([
            'name' => 'demo guy',
            'slogan' => 'this is it',
            'email' => 'marv@d'.time().'d.com',
            'phone_no' => '0704407117',
            'street' => 'langata',
            'photo' => '/dejje',
            'slug' => 'dmeo-dmeo',
            'user_id' => $user->id,
            'activated' => true
        ]);

        $result = $review->fill(array_merge([
            'title' => 'demo',
            'review' => 'demo fuck review demo guy this it demro marvin',
            'approved' => 1,
            'hotel_id' => 1,
            'rating' => 7,
        ],[
            'reviewer_id' => $user->id,
            'reviewer_type' => get_class($user)
        ]));

        $hotel->reviews()->save($result);
        $review = config('reviewable.models.review');
        $review = new $review();
        return view('reviewable::reviews.review')
            ->withReviews($review->paginate(config('reviewable.perPage')));
    }

    public function monitors()
    {
        return view('reviewable::monitors.monitor')
            ->withMonitors(Monitor::paginate(config('reviewable.perPage')));
    }

    protected function monitorValidation()
    {
        request()->validate([
            'name' => ['required', 'string', new MonitorRule(new Monitor())],
            'type' => ['required']
        ]);
    }

    public function deleteReview($review)
    {
        $review = app(config('reviewable.models.review'))->find($review);
        $review->occurrences()->delete();
        $review->delete();

        return redirect()->route('reviews.index');
    }

    public function deleteMonitor($monitor)
    {
        $monitor = Monitor::find($monitor);
        $monitor->delete();
        return back();
    }

    public function showReview($review)
    {
        $review = app(config('reviewable.models.review'))->find($review);
        return view('reviewable::reviews.show')
            ->withReview($review);
    }

    public function occurrences()
    {
        $occurrence = new Occurrence();
        $occurrences = request()->has('monitor') ?
            $occurrence->newQuery()->where('type', request()->monitor)->paginate(config('reviewable.perPage')) :
            $occurrence->paginate(config('reviewable.perPage'));

        return view('reviewable::occurrences.index')
            ->withOccurrences($occurrences);
    }
}
