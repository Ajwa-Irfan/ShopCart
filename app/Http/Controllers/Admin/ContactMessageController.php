<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $contacts = ContactMessage::with('user')->latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required|string|min:5',
        ]);

        $contact = ContactMessage::findOrFail($id);

        $contact->update([
            'admin_reply' => $request->admin_reply,
            'replied'     => true,
        ]);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Reply sent successfully!');
    }
}
