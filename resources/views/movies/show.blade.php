@extends('layouts.app')

@section('content')
<h2>{{ $movie->title }}</h2>
<p>{{ $movie->description }}</p>

<h4>Lịch chiếu</h4>
@foreach($movie->showtimes as $showtime)
    <a href="/booking/{{ $showtime->id }}" class="btn btn-outline-primary mb-2">
        {{ $showtime->start_time }}
    </a>
@endforeach
@endsection
