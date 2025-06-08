<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use App\Models\Story;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $guests = Guest::where('user_id', Auth::id())->get();
        $guestStats = Guest::getGuestStatistics();
        $recentGuests = Guest::latest()->take(5)->get();

        // Get user's stories ordered by date
        $story = Story::where('user_id', Auth::id())->get();

        // Get user's gallery images
        $galleries = Gallery::where('user_id', Auth::id())->latest()->get();

        return view('dashboard', compact('guests', 'guestStats', 'recentGuests', 'story', 'galleries'));
    }
}
