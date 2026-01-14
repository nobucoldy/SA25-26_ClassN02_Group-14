@extends('layouts.admin')

@section('content')
<h3 class="mb-3">Bookings Management</h3>

{{-- FILTER --}}
<form method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
        <input type="text"
               name="keyword"
               class="form-control"
               placeholder="Search user / movie"
               value="{{ request('keyword') }}">
    </div>

    <div class="col-md-3">
        <select name="status" class="form-control">
            <option value="">-- All Status --</option>
            <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Confirmed</option>
            <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Cancelled</option>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary">Filter</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

{{-- TABLE --}}
<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Movie</th>
            <th>Showtime</th>
            <th>Total</th>
            <th>Status</th>
            <th width="160">Action</th>
        </tr>
    </thead>

    <tbody>
    @forelse($bookings as $b)
        <tr>
            <td>{{ $b->id }}</td>
            <td>{{ $b->user->name }}</td>
            <td>{{ $b->showtime->movie->title }}</td>
            <td>
                {{ $b->showtime->show_date }}
                {{ $b->showtime->start_time }}
            </td>
            <td>{{ number_format($b->total_amount) }} đ</td>

            <td>
                <span class="badge bg-{{ $b->status == 'confirmed' ? 'success' : 'danger' }}">
                    {{ ucfirst($b->status) }}
                </span>
            </td>

            <td>
                <a href="{{ route('admin.bookings.show', $b->id) }}"
                   class="btn btn-sm btn-info">View</a>

                @if($b->status == 'confirmed')
                <form action="{{ route('admin.bookings.cancel', $b->id) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Cancel this booking?')">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-sm btn-danger">Cancel</button>
                </form>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">No bookings found</td>
        </tr>
    @endforelse
    </tbody>
</table>

{{-- PAGINATION --}}
<div class="d-flex justify-content-center">
    {{ $bookings->links('pagination::bootstrap-5') }}
</div>
@endsection
