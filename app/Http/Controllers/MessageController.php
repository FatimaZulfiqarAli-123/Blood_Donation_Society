<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreMessageRequest;
use App\Models\Message;
use App\Notifications\Message as Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->id());
        $user->unreadNotifications->markAsRead();

        $messages = Message::where('receiver_id', auth()->id())->get();

        return view('messages.index', compact('messages'));
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
        $adminId = User::where('role', 'admin')->first()->id;
        Message::create([
            'sender_id' => $adminId,
            'receiver_id' => $request->id,
            'message_text' => $request->message,
            'send_date_time' => now()
        ]);
        $user = User::where('id', $request->id)->first();
        if($user)
        {
            $user->notify(new Notification($request->message));
            return response()->json([
                'status' => 200,
                'message' => 'Message sended successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'User not found.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return back()->with([
            'status' => 'success',
            'message' => 'Message deleted successfully.'
        ]);
    }

    public function allNotifications()
    {
        $user = User::find(auth()->id());
        $user->unreadNotifications->markAsRead();

        return view('notifications', compact('user'));
    }

    public function deleteNotification($id)
    {
        $notification = DB::table('notifications')->where('id', $id);

        $notification->delete();

        return back()->with([
            'status' => 'success',
            'message' => 'Notification deleted successfully.'
        ]);
    }
}
