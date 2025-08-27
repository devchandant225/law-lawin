THANK YOU FOR CONTACTING US!

Hello {{ $contactData['name'] }},

Thank you for reaching out to us! We have successfully received your message and will get back to you as soon as possible.

YOUR SUBMISSION SUMMARY:
========================
Subject: {{ $contactData['subject'] }}
Email: {{ $contactData['email'] }}
@if($contactData['phone'])
Phone: {{ $contactData['phone'] }}
@endif
Submitted: {{ $contactData['submitted_at']->format('M j, Y g:i A') }}

YOUR MESSAGE:
=============
{{ $contactData['message'] }}

WHAT HAPPENS NEXT:
==================
- Our team will review your message within 24 hours
- We'll respond to your inquiry via email or phone
- For urgent matters, please call us directly

---
{{ config('app.name') }}

This is an automated confirmation email. Please do not reply to this message.
If you need immediate assistance, please contact us directly.
