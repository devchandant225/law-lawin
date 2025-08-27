NEW CONTACT FORM SUBMISSION

Hello,

You have received a new contact form submission from your website.

CONTACT DETAILS:
================
Name: {{ $contactData['name'] }}
Email: {{ $contactData['email'] }}
@if($contactData['phone'])
Phone: {{ $contactData['phone'] }}
@endif
Subject: {{ $contactData['subject'] }}
Submitted: {{ $contactData['submitted_at']->format('M j, Y g:i A') }}

MESSAGE:
========
{{ $contactData['message'] }}

TECHNICAL INFO:
===============
IP Address: {{ $contactData['ip_address'] ?? 'Unknown' }}
User Agent: {{ $contactData['user_agent'] ?? 'Unknown' }}

To reply to this message, send an email to: {{ $contactData['email'] }}

---
{{ config('app.name') }}
This email was sent from your website's contact form.
