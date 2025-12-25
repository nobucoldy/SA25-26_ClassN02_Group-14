@extends('layouts.app')

@section('content')
<h3>Phim đang chiếu</h3>

<div class="row">
@foreach($movies as $movie)
    <div class="col-md-3">
        <div class="card mb-3">
            <img src="{{ $movie->poster }}" class="card-img-top">
            <div class="card-body">
                <h6>{{ $movie->title }}</h6>
                <a href="/movies/{{ $movie->id }}" class="btn btn-primary btn-sm">
                    Chi tiết
                </a>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
