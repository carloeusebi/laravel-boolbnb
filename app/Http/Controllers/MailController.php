<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MailController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create(Message $message)
    {

        return view('admin.apartments.messages.mails.create', compact('message'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function reply(Request $request)
    {
    }
}
