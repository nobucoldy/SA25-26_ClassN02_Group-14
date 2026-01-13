@extends('layouts.admin')

@section('content')
<h3>Add Movie</h3>

<form method="POST" action="{{ route('admin.movies.store') }}">
    @csrf

    <input class="form-control mb-2" name="title" placeholder="Title">
    <input class="form-control mb-2" name="duration" placeholder="Duration">
    <input class="form-control mb-2" name="genre" placeholder="Genre">

    <button class="btn btn-success">Save</button>
</form>
@endsection
