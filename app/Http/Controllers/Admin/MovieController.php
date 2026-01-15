<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Danh sách phim
    public function index(Request $request)
{
    $query = Movie::query();

    // 🔍 Tìm theo tên phim
    if ($request->filled('keyword')) {
        $query->where('title', 'like', '%' . $request->keyword . '%');
    }

    // 🎯 Lọc theo trạng thái
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $movies = $query
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString();

    return view('admin.movies.index', compact('movies'));
}



    // Form thêm phim
    public function create()
    {
        return view('admin.movies.create');
    }

    // Lưu phim mới
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'duration'     => 'required|integer',
            'genre'        => 'required|string|max:255',
            'release_date' => 'required|date',
            'status'       => 'required|in:showing,coming_soon,stopped',
            'description'  => 'nullable|string',
            'poster'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'title',
            'duration',
            'genre',
            'release_date',
            'status',
            'description'
        ]);

        // 📸 Upload poster
        if ($request->hasFile('poster')) {
            $data['poster_url'] = $request->file('poster')
                                        ->store('posters', 'public');
        }

        Movie::create($data);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Thêm phim thành công');
    }

    // Xem chi tiết phim
    public function show($id)
    {
        $movie = Movie::with('showtimes.room')->findOrFail($id);
        return view('admin.movies.show', compact('movie'));
    }

    // Form sửa phim
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    // Cập nhật phim
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:255',
            'duration'     => 'required|integer',
            'genre'        => 'required|string|max:255',
            'release_date' => 'required|date',
            'status'       => 'required|in:showing,coming_soon,stopped',
            'description'  => 'nullable|string',
            'poster'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'title',
            'duration',
            'genre',
            'release_date',
            'status',
            'description'
        ]);

        // 📸 Nếu upload poster mới
        if ($request->hasFile('poster')) {

            // Xóa ảnh cũ (nếu có)
            if ($movie->poster_url && \Storage::disk('public')->exists($movie->poster_url)) {
                \Storage::disk('public')->delete($movie->poster_url);
            }

            $data['poster_url'] = $request->file('poster')
                                        ->store('posters', 'public');
        }

        $movie->update($data);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Cập nhật phim thành công');
    }

    // Xóa phim
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        // Có lịch chiếu thì không cho xóa
        if ($movie->showtimes()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Không thể xóa phim đang có lịch chiếu');
        }

        $movie->delete();

        return redirect()->route('admin.movies.index')
            ->with('success', 'Xóa phim thành công');
    }
}
