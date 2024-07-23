<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contactus;

class ContactusController extends Controller
{
    public function show()
    {
        return view('contactus');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Create a new contact message record
        Contactus::create($validated);

        // Sanitize the validated input
        $sanitizedData = [
            'name' => htmlspecialchars($validated['name'], ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars($validated['email'], ENT_QUOTES, 'UTF-8'),
            'message' => htmlspecialchars($validated['message'], ENT_QUOTES, 'UTF-8')
        ];

        // Send an email
        Mail::to('nisrinechkah12@gmail.com')->send(new ContactFormMail($sanitizedData));

        // Redirect or return a response
        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
