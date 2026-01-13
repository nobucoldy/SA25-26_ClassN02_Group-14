@extends('layouts.admin')

@section('content')
<h3>Movies</h3>

<a href="{{ route('admin.movies.create') }}" class="btn btn-primary mb-3">
    Add Movie
</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Duration</th>
        <th>Status</th>
    </tr>

    @foreach($movies as $movie)
    <tr>
        <td>{{ $movie->id }}</td>
        <td>{{ $movie->title }}</td>
        <td>{{ $movie->duration }} min</td>
        <td>{{ $movie->status }}</td>
    </tr>
    @endforeach
</table>
@endsection
