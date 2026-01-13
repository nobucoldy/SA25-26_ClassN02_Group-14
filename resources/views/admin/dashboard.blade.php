@extends('layouts.admin')

@section('content')
<h3>Dashboard</h3>

<div class="row">
    <div class="col-md-3">
        <div class="card p-3">Movies: {{ $movies }}</div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">Showtimes: {{ $showtimes }}</div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">Bookings: {{ $bookings }}</div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">Users: {{ $users }}</div>
    </div>
</div>
@endsection
