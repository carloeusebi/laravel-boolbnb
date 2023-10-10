<?php

namespace App\Http\Controllers;

use App\Mail\MessageMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    public function reply(Request $request,)
    {
        $user_email = $request->user_email;
        $user_message_id = $request->user_message_id;
        $message = Message::where('id', $user_message_id)->first();
        $sender = $request->admin_email;
        $subject = $request->subject;
        $content = $request->content;
        $guest = $message->name;
        $mail = new MessageMail($sender, $subject, $content, $guest);
        Mail::to($user_email)->send($mail);

        return view('admin.apartments.messages.show', compact('message'));
    }
}
