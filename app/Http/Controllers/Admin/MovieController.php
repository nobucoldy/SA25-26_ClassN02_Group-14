<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    // Movie list
    public function index(Request $request)
{
    $query = Movie::query();

    // 🔍 Search by movie title
    if ($request->filled('keyword')) {
        $query->where('title', 'like', '%' . $request->keyword . '%');
    }

    // 🎯 Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $movies = $query
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString();

    return view('admin.movies.index', compact('movies'));
}



    // Add movie form
    public function create()
    {
        return view('admin.movies.create');
    }

    // Save new movie
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
            ->with('success', 'Movie added successfully');
    }

    // View movie details
    public function show($id)
    {
        $movie = Movie::with('showtimes.room')->findOrFail($id);
        return view('admin.movies.show', compact('movie'));
    }

    // Edit movie form
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    // Update movie
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

        // 📸 If uploading new poster
        if ($request->hasFile('poster')) {

            // Delete old image (if exists)
            if ($movie->poster_url && Storage::disk('public')->exists($movie->poster_url)) {
                \Storage::disk('public')->delete($movie->poster_url);
            }

            $data['poster_url'] = $request->file('poster')
                                        ->store('posters', 'public');
        }

        $movie->update($data);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie updated successfully');
    }

    // Delete movie
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        // Cannot delete if movie has showtimes
        if ($movie->showtimes()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete a movie that has showtimes scheduled');
        }

        $movie->delete();

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie deleted successfully');
    }
}
