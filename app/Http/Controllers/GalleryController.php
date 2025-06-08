<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Get all gallery images for display
     */
    public function index()
    {
        $galleries = Gallery::where('user_id', Auth::id())->latest()->get();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $galleries
            ]);
        }

        return view('dashboard.gallery', compact('galleries'));
    }

    /**
     * Add new gallery image
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'nullable|string|max:255'
        ]);

        try {
            $gallery = new Gallery();
            $gallery->user_id = Auth::id();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('gallery', $filename, 'public');
                $gallery->image_path = $path;
                $gallery->alt_text = $request->alt_text ?? 'Gallery Image';
            }

            $gallery->save();

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil ditambahkan',
                'data' => [
                    'id' => $gallery->id,
                    'image_url' => $gallery->image_url,
                    'alt_text' => $gallery->alt_text
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Gallery upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunggah foto'
            ], 500);
        }
    }

    /**
     * Remove gallery image
     */
    public function destroy($id)
    {
        try {
            $gallery = Gallery::where('user_id', Auth::id())->findOrFail($id);

            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $gallery->delete();

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            \Log::error('Gallery delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus foto'
            ], 500);
        }
    }
}
