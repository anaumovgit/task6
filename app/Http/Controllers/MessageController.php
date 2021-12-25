<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function message(Request $request)
    {
        if (Auth::user()->id == $request->id) return redirect()->route('homepage');
        else {
            if (User::find($request->id) == null) return redirect()->route('homepage');
            return view('message.message', ['id' => $request->id]);
        }
    }

    public function send_message(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);
        $message = Message::create([
            'user_id' => $request->id,
            'message' => $request->message,
            'by_user' => Auth::user()->id,
            'author_name' => Auth::user()->name,
        ]);
        session()->flash('success', 'Successful! Your message was sent.');
        return redirect()->route('homepage');

    }
}
