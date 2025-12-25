@extends('layouts.app')

@section('content')
<h3>Chọn ghế</h3>

<form method="POST" action="/booking">
    @csrf
    <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">

    @foreach($showtime->room->seats as $seat)
        <label class="me-2">
            <input type="checkbox" name="seat_ids[]" value="{{ $seat->id }}">
            {{ $seat->seat_number }}
        </label>
    @endforeach

    <br><br>
    <button class="btn btn-success">Đặt vé</button>
</form>
@endsection
