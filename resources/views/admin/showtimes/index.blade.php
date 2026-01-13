@extends('layouts.admin')

@section('content')
<h3>Showtimes</h3>

<table class="table table-bordered">
    <tr>
        <th>Movie</th>
        <th>Room</th>
        <th>Date</th>
        <th>Time</th>
        <th>Price</th>
    </tr>

    @foreach($showtimes as $s)
    <tr>
        <td>{{ $s->movie->title }}</td>
        <td>{{ $s->room->name }}</td>
        <td>{{ $s->show_date }}</td>
        <td>{{ $s->start_time }}</td>
        <td>{{ $s->price }}</td>
    </tr>
    @endforeach
</table>
@endsection
