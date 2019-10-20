@extends('reviewable::layouts.app')
@section('content')
    <div class="container">
        <div class="col-12 justify-content-center">
            @if(isset($monitor))
                <form action="{{ route('monitors.update', $monitor->id) }}" method="post">
                    @else
                        <form action="{{ route('monitors.store') }}" method="post">
                            @endif
                            <div class="card">
                                <div class="card-header"><a href="{{ route('monitors.monitors') }}" class="btn btn-primary btn-sm">Back </a> {{ isset($monitor) ? 'Edit' : 'Add' }} Monitor</div>
                                @csrf
                                @if(isset($monitor))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    @include('reviewable::partials._monitor-form')
                                </div>
                                <div class="card-footer">
                                    <div class="col-md-12">
                                        <button class="btn btn-success float-right">{{ isset($monitor) ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
        </div>
    </div>
@endsection
