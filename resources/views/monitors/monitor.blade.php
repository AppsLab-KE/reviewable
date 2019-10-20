@extends('reviewable::layouts.app')

@section('content')
    <div class="container">
        <div class="col-12 justify-content-center">
            <div class="card">
                <div class="card-header">Monitors <a href="{{ route('monitors.create') }}" class="btn btn-sm btn-primary float-right">Add Monitor</a></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Monitors</th>
                                <th>Type</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($monitors as $monitor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ ucwords($monitor->name) }} <br>
                                        {{ ucfirst($monitor->description) }}
                                    </td>
                                    <td>{{ ucwords($monitor->type) }}</td>
                                    <td class="text-right">
                                        <form action="{{ route('monitors.delete', $monitor->id) }}" method="post">
                                            {{csrf_field()}}
                                            {{method_field('delete')}}
                                            <a href="{{ route('occurrences.index',['monitor'=>$monitor->type]) }}" class="btn btn-default">Occurrences</a>
                                            <a href="{{ route('monitors.edit', $monitor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this.form)">delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $monitors->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
