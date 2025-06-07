<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $guests=Guest::where('user_id',Auth::id())->get();
        return view('dashboard', compact('guests'));

    }
}
