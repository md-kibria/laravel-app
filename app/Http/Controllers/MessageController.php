<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        $messages = Message::orderBy('id', 'desc')->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        $data = $request->all();

        Message::create($data);

        return redirect()->back()->with('success', 'Message send successfully');
    }

    public function show(Message $message) {
        $message->update(['is_read' => true]);

        return view('admin.messages.message', compact('message'));
    }

    public function destroy(Message $message) {
        $message->delete();

        return redirect('/admin/messages')->with('success', 'Message deleted successfully');
    }
}
