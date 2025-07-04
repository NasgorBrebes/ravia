<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, Event $event)
     {
         $validated = $request->validate([
             'eventDate' => 'sometimes|required|date',
             'eventTime' => 'sometimes|required',
             'eventLocation' => 'sometimes|required|string|max:255',
             'mapEmbedUrl' => 'sometimes|required|string|max:90000|regex:/^<iframe.*src="https:\/\/www\.google\.com\/maps\/embed.*<\/iframe>$/s',
             'groomName' => 'sometimes|required|string|max:50',
             'groomAddress' => 'sometimes|required|string|max:255',
             'brideName' => 'sometimes|required|string|max:50',
             'brideAddress' => 'sometimes|required|string|max:255',
             'groomFather' => 'sometimes|required|string|max:255',
             'groomMother' => 'sometimes|required|string|max:255',
             'brideFather' => 'sometimes|required|string|max:255',
             'brideMother' => 'sometimes|required|string|max:255',
             'bankName1' => 'sometimes|required|string|max:255',
             'accountNumber1' => 'sometimes|required|string|max:255',
             'accountName1' => 'sometimes|required|string|max:255',
             'bankLogo1' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
             'bankName2' => 'sometimes|required|string|max:255',
             'accountNumber2' => 'sometimes|required|string|max:255',
             'accountName2' => 'sometimes|required|string|max:255',
             'bankLogo2' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
             'musicBackground' => 'sometimes|required|mimes:mp3,wav,mpeg|max:25000',
             'homeImage' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
             'groomPhoto' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
             'bridePhoto' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
             'homeQuote' => 'sometimes|required|string|max:1000',
             'homeSource' => 'sometimes|required|string|max:255',
             'homeQuoteSource' => 'sometimes|required|string|max:255',
             'openingGreeting' => 'sometimes|required|string|max:1000',
             'welcomeMessage' => 'sometimes|required|string|max:1000',
             'closingGreeting' => 'sometimes|required|string|max:1000',
         ]);

         // Handle file uploads with proper field names
         if ($request->hasFile('bankLogo1')) {
             $bankLogo1Name = $request->file('bankLogo1')->getClientOriginalName();
             $validated['bankLogo1'] = $request->file('bankLogo1')->storeAs('images/bank', $bankLogo1Name, 'public');
         }

         if ($request->hasFile('bankLogo2')) {
             $bankLogo2Name = $request->file('bankLogo2')->getClientOriginalName();
             $validated['bankLogo2'] = $request->file('bankLogo2')->storeAs('images/bank', $bankLogo2Name, 'public');
         }

         if ($request->hasFile('bannerImage')) {
             $bannerName = $request->file('bannerImage')->getClientOriginalName();
             $validated['bannerImage'] = $request->file('bannerImage')->storeAs('images', $bannerName, 'public');
         }

         if ($request->hasFile('musicBackground')) {
             $musikName = $request->file('musicBackground')->getClientOriginalName();
             $validated['musicBackground'] = $request->file('musicBackground')->storeAs('music', $musikName, 'public');
         }

         if ($request->hasFile('homeImage')) {
             $homeImageName = $request->file('homeImage')->getClientOriginalName();
             $validated['homeImage'] = $request->file('homeImage')->storeAs('images', $homeImageName, 'public');
         }

         // Handler untuk groomPhoto
        if ($request->hasFile('groomPhoto')) {
            $groomPhotoName = $request->file('groomPhoto')->getClientOriginalName();
            $validated['groomPhoto'] = $request->file('groomPhoto')->storeAs('images', $groomPhotoName, 'public');
        }

        // Handler untuk bridoPhoto  
        if ($request->hasFile('bridePhoto')) {
            $bridePhotoName = $request->file('bridePhoto')->getClientOriginalName();
            $validated['bridePhoto'] = $request->file('bridePhoto')->storeAs('images', $bridePhotoName, 'public');
}

         Event::updateOrCreate(['user_id' => Auth::id()], $validated);

         return redirect()->back()->with('success', 'Event updated successfully');
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
