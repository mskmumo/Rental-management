<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()
            ->withCount(['repliedBy'])
            ->paginate(10);

        $unreadCount = ContactMessage::where('status', 'unread')->count();

        return view('admin.contact-messages.index', compact('messages', 'unreadCount'));
    }

    public function show(ContactMessage $message)
    {
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.contact-messages.show', compact('message'));
    }

    public function reply(Request $request, ContactMessage $message)
    {
        $request->validate([
            'reply' => 'required|string'
        ]);

        try {
            // Send email reply
            \Mail::to($message->email)->send(new \App\Mail\ContactMessageReply($message, $request->reply));

            // Update message status
            $message->update([
                'status' => 'replied',
                'replied_by' => Auth::id(),
                'replied_at' => now()
            ]);

            return redirect()->route('admin.contact-messages.show', $message)
                ->with('success', 'Reply sent successfully.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Failed to send reply. Please try again.')
                ->withInput();
        }
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
} 