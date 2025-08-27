<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #1a365d;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            margin: -30px -30px 30px -30px;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .contact-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-row {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #495057;
            display: inline-block;
            width: 100px;
        }
        .info-value {
            color: #212529;
        }
        .message-content {
            background-color: #e7f3ff;
            padding: 20px;
            border-left: 4px solid #007bff;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .footer {
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🔔 New Contact Form Submission</h1>
        </div>

        <p>Hello,</p>
        <p>You have received a new contact form submission from your website. Here are the details:</p>

        <div class="contact-info">
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ $contactData['name'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">
                    <a href="mailto:{{ $contactData['email'] }}">{{ $contactData['email'] }}</a>
                </span>
            </div>
            @if($contactData['phone'])
            <div class="info-row">
                <span class="info-label">Phone:</span>
                <span class="info-value">
                    <a href="tel:{{ $contactData['phone'] }}">{{ $contactData['phone'] }}</a>
                </span>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Subject:</span>
                <span class="info-value">{{ $contactData['subject'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Submitted:</span>
                <span class="info-value">{{ $contactData['submitted_at']->format('M j, Y g:i A') }}</span>
            </div>
        </div>

        <div class="message-content">
            <h3>📝 Message:</h3>
            <p>{{ nl2br(e($contactData['message'])) }}</p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="mailto:{{ $contactData['email'] }}?subject=Re: {{ $contactData['subject'] }}" 
               style="background-color: #007bff; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;">
                📧 Reply to {{ $contactData['name'] }}
            </a>
        </div>

        <div class="footer">
            <p><strong>{{ config('app.name') }}</strong></p>
            <p>This email was sent from your website's contact form.</p>
            <p>IP Address: {{ $contactData['ip_address'] ?? 'Unknown' }}</p>
        </div>
    </div>
</body>
</html>
