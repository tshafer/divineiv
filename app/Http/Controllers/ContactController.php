<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        // Validate the form
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
            'patient_status' => 'nullable|string|in:new,existing,other',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        }

        try {
            // Prepare email data
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'patient_status' => $request->patient_status,
                'submitted_at' => now()->format('F j, Y \a\t g:i A'),
            ];

            // Send to the business
            Mail::send('emails.contact', $data, function ($mail) use ($data) {
                $mail->from('hello@divineiv.com', 'Divine IV & Wellness Contact Form')
                    ->to('info@divineiv.com', 'Divine IV & Wellness')
                    ->subject('New Contact Form Submission - '.($data['subject'] ?: 'General Inquiry'));
            });

            // Send acknowledgment to the customer
            Mail::send('emails.contact-confirmation', $data, function ($mail) use ($data) {
                $mail->from('noreply@divineiv.com', 'Divine IV & Wellness')
                    ->to($data['email'], $data['name'])
                    ->subject('Thank you for contacting Divine IV & Wellness');
            });

            return redirect()
                ->route('contact')
                ->with('success', 'Thank you for your message! We will get back to you soon.');

        } catch (\Exception $e) {
            Log::error('Contact form error: '.$e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Sorry, there was an error sending your message. Please try again or call us directly at (480) 488-9858.');
        }
    }
}
