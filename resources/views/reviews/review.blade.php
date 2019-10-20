@extends('reviewable::layouts.app')
@section('content')
    <div class="container">
        <div class="col-12 justify-content-center">
            <div class="card">
                <div class="card-header">Reviews</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>
                                        <div class="card">
                                            @if(isset($review->title))
                                                <div class="card-header">{{ ucwords($review->title) }} <span> {{ $review->reviewer instanceof \App\User ? '| User:'.$review->reviewer->first_name : ''}}</span></div>
                                            @endif
                                            <div class="card-body">
                                                {{ ucfirst($review->review) }}
                                            </div>
                                            <div class="card-footer">
                                                <form action="{{ route('reviews.delete', $review->id) }}" method="post">
                                                    {{csrf_field()}}
                                                    {{method_field('delete')}}
                                                    <button class="btn btn-danger btn-xs" onclick="confirmDelete(this.form)">delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $reviews->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
