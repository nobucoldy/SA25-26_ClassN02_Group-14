@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="mb-4">➕ Add New Movie</h3>

    {{-- Error --}}
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
      action="{{ route('admin.movies.store') }}"
      enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text"
               name="title"
               class="form-control"
               value="{{ old('title') }}"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Duration (minutes)</label>
        <input type="number"
               name="duration"
               class="form-control"
               value="{{ old('duration') }}"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Director</label>
        <select name="director_id" class="form-control" required>
            <option value="">-- Select Director --</option>
            @foreach ($directors as $director)
                <option value="{{ $director->id }}" {{ old('director_id') == $director->id ? 'selected' : '' }}>
                    {{ $director->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Genres (Select at least one)</label>
        <select name="genres[]" class="form-control" multiple required>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>
        <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Actors</label>
        <select name="actors[]" class="form-control" multiple>
            @foreach ($actors as $actor)
                <option value="{{ $actor->id }}" {{ in_array($actor->id, old('actors', [])) ? 'selected' : '' }}>
                    {{ $actor->name }}
                </option>
            @endforeach
        </select>
        <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Release Date</label>
        <input type="date"
               name="release_date"
               class="form-control"
               value="{{ old('release_date') }}"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            <option value="">-- Select Status --</option>
            <option value="showing" {{ old('status') == 'showing' ? 'selected' : '' }}>Showing</option>
            <option value="coming_soon" {{ old('status') == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
            <option value="stopped" {{ old('status') == 'stopped' ? 'selected' : '' }}>Stopped</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Trailer URL</label>
        <input type="url"
               name="trailer_url"
               class="form-control"
               value="{{ old('trailer_url') }}"
               placeholder="https://youtube.com/watch?v=...">
    </div>

    <div class="mb-3">
        <label class="form-label">Poster Image</label>
        <input type="file"
               name="poster"
               class="form-control"
               accept="image/*">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description"
                  class="form-control"
                  rows="4">{{ old('description') }}</textarea>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </div>
</form>

</div>
@endsection
