<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Booking;

class BookingController extends Controller
{
    public function create($showtimeId)
    {
        // Load thêm quan hệ 'movie' để hiển thị ảnh và tên phim ở trang chọn ghế
        $showtime = Showtime::with(['room.seats', 'movie'])->findOrFail($showtimeId);
        return view('booking.create', compact('showtime'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required',
            'seat_ids' => 'required|array|min:1',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'showtime_id' => $request->showtime_id,
            'total_amount' => count($request->seat_ids) * 50000,
            'status' => 'confirmed',
        ]);

        return redirect('/')->with('success', 'Booking thành công!');
    }

    public function combo()
    {
        // Logic lấy danh sách combo bắp nước từ database (nếu có)
        // $combos = Combo::all(); 
        
        // Trả về file view combo của bạn 
        // Đảm bảo file nằm tại resources/views/booking/combo.blade.php
        return view('booking.combo'); 
    }
}