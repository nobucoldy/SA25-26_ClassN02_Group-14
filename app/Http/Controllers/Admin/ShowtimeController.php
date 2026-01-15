<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowtimeController extends Controller
{
   public function index(Request $request)
{
    $query = Showtime::with(['movie', 'room']);

    // 🔍 Tìm theo tên phim
    if ($request->filled('movie')) {
        $query->whereHas('movie', function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->movie . '%');
        });
    }

    // 📅 Lọc theo ngày
    if ($request->filled('date')) {
        $query->where('show_date', $request->date);
    }

    // ❌ TUYỆT ĐỐI KHÔNG groupBy movie_id
    $showtimes = $query
        ->orderBy('show_date')
        ->orderBy('start_time')
        ->paginate(10);

    return view('admin.showtimes.index', compact('showtimes'));
}

    public function destroy($id)
    {
        $showtime = Showtime::findOrFail($id);

        // Không cho xóa nếu đã có booking
        if ($showtime->bookings()->count() > 0) {
            return back()->with(
                'error',
                'Không thể xóa lịch chiếu đã có vé được đặt'
            );
        }

        $showtime->delete();

        return back()->with(
            'success',
            'Xóa lịch chiếu thành công'
        );
    }
    public function edit($id)
    {
        $showtime = Showtime::findOrFail($id);

        return view('admin.showtimes.edit', [
            'showtime' => $showtime,
            'movies'   => Movie::all(),
            'rooms'    => Room::all(),
        ]);
    }
    public function create()
    {
        return view('admin.showtimes.create', [
            'movies' => \App\Models\Movie::orderBy('title')->get(),
            'rooms'  => \App\Models\Room::orderBy('name')->get(),
        ]);
    }
    public function update(Request $request, $id)
    {
        $showtime = Showtime::findOrFail($id);

        $request->validate([
            'show_date'  => 'required|date',
            'start_time' => 'required',
            'end_time'   => 'nullable',
            'price'      => 'required|numeric|min:0',
        ]);

        $showtime->update($request->only(
            'show_date',
            'start_time',
            'end_time',
            'price'
        ));

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Showtime updated successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'movie_id'   => 'required|exists:movies,id',
            'room_id'    => 'required|exists:rooms,id',
            'show_date'  => 'required|date',
            'start_time' => 'required',
            'end_time'   => 'nullable',
            'price'      => 'required|numeric|min:0',
        ]);

        // Lấy phim để lấy duration
        $movie = Movie::findOrFail($request->movie_id);

        // Tính end_time nếu không nhập
        $start = \Carbon\Carbon::createFromFormat('H:i', $request->start_time);

        if ($request->filled('end_time')) {
            $end = \Carbon\Carbon::createFromFormat('H:i', $request->end_time);
        } else {
            $end = (clone $start)->addMinutes($movie->duration);
        }

        // ❌ Kiểm tra trùng suất chiếu (cùng phòng – cùng ngày)
        $conflict = Showtime::where('room_id', $request->room_id)
            ->where('show_date', $request->show_date)
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_time', [$start, $end])
                ->orWhereBetween('end_time', [$start, $end])
                ->orWhere(function ($q2) use ($start, $end) {
                    $q2->where('start_time', '<=', $start)
                        ->where('end_time', '>=', $end);
                });
            })
            ->exists();

        if ($conflict) {
            return back()
                ->withInput()
                ->with('error', 'Suất chiếu bị trùng thời gian trong cùng phòng');
        }

        // ✅ Lưu DB
        Showtime::create([
            'movie_id'   => $request->movie_id,
            'room_id'    => $request->room_id,
            'show_date'  => $request->show_date,
            'start_time' => $start->format('H:i'),
            'end_time'   => $end->format('H:i'),
            'price'      => $request->price,
        ]);

        return redirect()
            ->route('admin.showtimes.index')
            ->with('success', 'Thêm suất chiếu thành công');
    }

}
