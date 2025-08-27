<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for contacting us</title>
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
            background-color: #28a745;
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
        .confirmation-message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .contact-summary {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-row {
            margin: 8px 0;
            padding: 5px 0;
        }
        .info-label {
            font-weight: bold;
            color: #495057;
            display: inline-block;
            width: 80px;
        }
        .info-value {
            color: #212529;
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
        .cta-button {
            background-color: #1a365d;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>✅ Message Received!</h1>
        </div>

        <p>Hello {{ $contactData['name'] }},</p>
        
        <div class="confirmation-message">
            <h2>Thank you for reaching out to us!</h2>
            <p>We have successfully received your message and will get back to you as soon as possible.</p>
        </div>

        <p>Here's a summary of what you submitted:</p>

        <div class="contact-summary">
            <div class="info-row">
                <span class="info-label">Subject:</span>
                <span class="info-value">{{ $contactData['subject'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $contactData['email'] }}</span>
            </div>
            @if($contactData['phone'])
            <div class="info-row">
                <span class="info-label">Phone:</span>
                <span class="info-value">{{ $contactData['phone'] }}</span>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Submitted:</span>
                <span class="info-value">{{ $contactData['submitted_at']->format('M j, Y g:i A') }}</span>
            </div>
        </div>

        <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <h4>📝 Your Message:</h4>
            <p style="margin: 10px 0;">{{ nl2br(e($contactData['message'])) }}</p>
        </div>

        <div style="text-align: center;">
            <h3>What happens next?</h3>
            <ul style="text-align: left; max-width: 400px; margin: 0 auto;">
                <li>Our team will review your message within 24 hours</li>
                <li>We'll respond to your inquiry via email or phone</li>
                <li>For urgent matters, please call us directly</li>
            </ul>
        </div>

        <div class="footer">
            <p><strong>{{ config('app.name') }}</strong></p>
            <p>This is an automated confirmation email. Please do not reply to this message.</p>
            <p>If you need immediate assistance, please contact us directly.</p>
        </div>
    </div>
</body>
</html>
