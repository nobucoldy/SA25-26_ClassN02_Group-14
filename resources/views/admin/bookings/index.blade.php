@extends('layouts.admin')

@section('content')
<h3>Bookings</h3>

<table class="table table-bordered">
    <tr>
        <th>User</th>
        <th>Movie</th>
        <th>Total</th>
        <th>Status</th>
    </tr>

    @foreach($bookings as $b)
    <tr>
        <td>{{ $b->user->name }}</td>
        <td>{{ $b->showtime->movie->title }}</td>
        <td>{{ $b->total_amount }}</td>
        <td>{{ $b->status }}</td>
    </tr>
    @endforeach
</table>
@endsection
