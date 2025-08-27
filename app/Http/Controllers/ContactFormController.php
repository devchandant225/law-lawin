<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use App\Models\Contact;

class ContactFormController extends Controller
{
    /**
     * Handle contact form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:500',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $contactData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
                'submitted_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ];

            // Store contact form data in database
            $contact = Contact::create($contactData);

            // Send email to admin
            Mail::to(config('mail.admin_email', 'chandant142@gmail.com'))
                ->send(new ContactFormMail($contactData));

            // Optionally send confirmation email to user
            if (config('mail.send_confirmation', false)) {
                Mail::to($contactData['email'])
                    ->send(new ContactFormMail($contactData, true));
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for your message! We will get back to you soon.'
                ]);
            }

            return redirect()->back()
                ->with('success', 'Thank you for your message! We will get back to you soon.');

        } catch (\Exception $e) {
            \Log::error('Contact form submission failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'error' => $e
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try again later.'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Sorry, there was an error sending your message. Please try again later.')
                ->withInput();
        }
    }

    /**
     * Show contact form (for dedicated contact pages)
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Get contact form data for API endpoints
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFormData(Request $request)
    {
        return response()->json([
            'csrf_token' => csrf_token(),
            'form_action' => route('contact.submit'),
            'success_message' => 'Thank you for your message! We will get back to you soon.',
            'validation_rules' => [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'subject' => 'required|string|max:500',
                'message' => 'required|string|max:2000',
            ]
        ]);
    }
}
