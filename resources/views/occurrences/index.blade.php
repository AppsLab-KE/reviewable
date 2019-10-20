@extends('reviewable::layouts.app')

@section('content')
    <div class="container">
        <div class="col-12 justify-content-center">
            <div class="card">
                <div class="card-header">Occurrences</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Count</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($occurrences as $occurrence)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($occurrence->type) }}</td>
                                    <td>{{ ucwords($occurrence->count) }}</td>
                                    <td>{{ ucwords($occurrence->status) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('reviews.show', $occurrence->occurrable->id) }}" class="btn btn-sm btn-primary">Show Review</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $occurrences->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
