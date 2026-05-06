<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a new contact message.
     */
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Increment messages notification for all admin users
        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            \App\Models\Notification::incrementCount($admin->id, 'messages');
        }

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    /**
     * Store a new equipment rental request.
     */
    public function rentRequest(Request $request)
    {
        $request->validate([
            'equipment_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
        ]);

        $message = "Equipment Rental Request\n\n";
        $message .= "Equipment: " . $request->equipment_name . "\n";
        $message .= "Name: " . $request->name . "\n";
        $message .= "Email: " . $request->email . "\n";
        $message .= "Mobile: " . $request->mobile . "\n\n";
        $message .= "This person wants to rent the above equipment.";

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => 'Equipment Rental Request: ' . $request->equipment_name,
            'message' => $message,
        ]);

        // Increment messages notification for all admin users
        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            \App\Models\Notification::incrementCount($admin->id, 'messages');
        }

        return redirect()->back()->with('success', 'Your rental request has been submitted! We will contact you soon.');
    }

    /**
     * Display all contact messages for admin.
     */
    public function adminIndex()
    {
        // Clear messages notification for the admin
        \App\Models\Notification::clearCount(auth()->id(), 'messages');

        $messages = ContactMessage::orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * Mark a message as read and show it.
     */
    public function adminShow($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return view('admin.contact-messages.show', compact('message'));
    }

    /**
     * Delete a contact message.
     */
    public function adminDestroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
