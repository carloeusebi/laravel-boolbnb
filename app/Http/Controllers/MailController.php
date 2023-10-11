<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailReplyRequest;
use App\Mail\MessageMail;
use App\Models\Message;
use DateTime;
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
    public function reply(Request $request)
    {

        // Collect use remail and user message id 
        $user_email = $request->user_email;
        $user_message_id = $request->user_message_id;

        // Find message with the user id collected
        $message = Message::where('id', $user_message_id)->first();

        // Add red_at for notification
        $read_at = new DateTime();
        $message->read_at = $read_at;

        // Add replied_at for notification
        $replied_at = new DateTime();
        $message->replied_at = $replied_at;
        $message->update();

        // Create the mail and send it
        $sender = $request->admin_email;
        $subject = $request->subject;
        $content = $request->content;
        $guest = $message->name;
        $mail = new MessageMail($sender, $subject, $content, $guest);
        Mail::to($user_email)->send($mail);

        return view('admin.apartments.messages.show', compact('message'));
    }
}
