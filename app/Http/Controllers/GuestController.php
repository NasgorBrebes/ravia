<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::where('user_id', Auth::id())->get(); // Filter berdasarkan user yang login
        return view('dashboard.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'guestName' => 'required|string|max:255',
            'guestAddress' => 'nullable|string|max:255',
            'guestStatus' => 'required|in:hadir,tidak_hadir,belum_konfirmasi',
        ]);

        // Data yang akan disimpan ke database
        $guestData = [
            'user_id' => Auth::id(),
            'guestName' => $validatedData['guestName'],
            'guestAddress' => $validatedData['guestAddress'] ?? '',  // Default empty string jika null
            'guestStatus' => $validatedData['guestStatus'],
        ];

        $guest = Guest::create($guestData);

        // Check if request expects JSON (AJAX)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tamu berhasil ditambahkan!',
                'guest' => $guest
            ]);
        }

        // Traditional form submission (fallback)
        return redirect()->route('dashboard')
            ->with('success', 'Tamu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        // Pastikan user hanya bisa update tamu miliknya sendiri
        if ($guest->user_id !== Auth::id()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
            }
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'guestName' => 'required|string|max:255',
            'guestAddress' => 'nullable|string|max:255',
            'guestStatus' => 'required|in:hadir,tidak_hadir,belum_konfirmasi',
        ]);

        // Data sudah sesuai dengan nama kolom di database
        $updateData = $validated;

        $guest->update($updateData);

        // Check if request expects JSON (AJAX)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Tamu berhasil diperbarui!',
                'guest' => $guest
            ]);
        }

        // Traditional form submission (fallback)
        return redirect()->route('dashboard')
            ->with('success', 'Data Tamu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        // Pastikan user hanya bisa hapus tamu miliknya sendiri
        if ($guest->user_id !== Auth::id()) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
            }
            abort(403, 'Unauthorized action.');
        }

        $guest->delete();

        // Check if request expects JSON (AJAX)
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tamu berhasil dihapus!'
            ]);
        }

        // Traditional form submission (fallback)
        return redirect()->route('dashboard')
            ->with('success', 'Tamu berhasil dihapus!');
    }
}
