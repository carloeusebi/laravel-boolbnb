<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Message;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAll()
    {
        $userApartmentIds = Apartment::where('user_id', Auth::user()->id)->pluck('id')->toArray();
        $allMessages = Message::all();

        $messages = $allMessages->filter(function ($m) use ($userApartmentIds) {
            if (in_array($m['apartment_id'], $userApartmentIds)) return $m;
        });

        return view('admin.apartments.messages.index', compact('messages'));
    }


    /**
     * Display a listing of the resource based on a apartment.
     */
    public function index(Apartment $apartment)
    {
        $messages = Message::where('apartment_id', $apartment->id)->get();
        return view('admin.apartments.messages.index', compact('messages'));
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
    public function show(Message $message)
    {

        $read_at = new DateTime();

        $message->read_at = $read_at;

        $message->update();
        return view('admin.apartments.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
