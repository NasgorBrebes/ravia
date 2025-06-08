<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    // Menampilkan semua story
    public function index()
    {
        return response()->json(Story::with('user')->latest()->get());
    }

    // Menyimpan story baru
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // maksimal 2MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stories', 'public');
        }

        $story = Story::create([
            'user_id' => Auth::id(), // atau $request->user_id jika tidak pakai Auth
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->back();
    }

    // Menampilkan detail story
    public function show($id)
    {
        $story = Story::with('user')->findOrFail($id);
        return response()->json($story);
    }

    // Mengupdate story
    public function update(Request $request, $id)
    {
        $story = Story::findOrFail($id);

        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($story->image) {
                Storage::disk('public')->delete($story->image);
            }
            $story->image = $request->file('image')->store('stories', 'public');
        }

        $story->update([
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($story);
    }

    // Menghapus story
    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        if ($story->image) {
            Storage::disk('public')->delete($story->image);
        }
        $story->delete();

        return response()->json(['message' => 'Story deleted successfully.']);
    }


}
