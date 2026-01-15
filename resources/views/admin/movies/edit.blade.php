@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="mb-4">✏️ Edit Movie</h3>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.movies.update', $movie->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title', $movie->title) }}"
                   required>
        </div>

        {{-- Duration --}}
        <div class="mb-3">
            <label class="form-label">Duration (minutes)</label>
            <input type="number"
                   name="duration"
                   class="form-control"
                   value="{{ old('duration', $movie->duration) }}"
                   required>
        </div>

        {{-- Genre --}}
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text"
                   name="genre"
                   class="form-control"
                   value="{{ old('genre', $movie->genre) }}"
                   required>
        </div>

        {{-- Release Date --}}
        <div class="mb-3">
            <label class="form-label">Release Date</label>
            <input type="date"
                   name="release_date"
                   class="form-control"
                   value="{{ old('release_date', $movie->release_date) }}"
                   required>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="showing" {{ $movie->status=='showing'?'selected':'' }}>
                    Showing
                </option>
                <option value="coming_soon" {{ $movie->status=='coming_soon'?'selected':'' }}>
                    Coming Soon
                </option>
                <option value="stopped" {{ $movie->status=='stopped'?'selected':'' }}>
                    Stopped
                </option>
            </select>
        </div>

        {{-- Current Poster --}}
        @if($movie->poster_url)
        <div class="mb-3">
            <label class="form-label">Current Poster</label><br>
            <img src="{{ asset('storage/' . $movie->poster_url) }}"
                 alt="Poster"
                 class="img-thumbnail"
                 style="max-height: 200px">
        </div>
        @endif

        {{-- Upload New Poster --}}
        <div class="mb-3">
            <label class="form-label">Change Poster (optional)</label>
            <input type="file"
                   name="poster"
                   class="form-control"
                   accept="image/*">
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $movie->description) }}</textarea>
        </div>

        {{-- Actions --}}
        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                Update
            </button>
            <a href="{{ route('admin.movies.index') }}"
               class="btn btn-secondary">
                Back
            </a>
        </div>

    </form>
</div>
@endsection
