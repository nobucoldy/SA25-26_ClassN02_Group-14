@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="mb-4">➕ Thêm phim mới</h3>

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
        <label class="form-label">Genre</label>
        <input type="text"
               name="genre"
               class="form-control"
               value="{{ old('genre') }}"
               required>
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
            <option value="showing">Showing</option>
            <option value="coming_soon">Coming Soon</option>
            <option value="stopped">Stopped</option>
        </select>
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
