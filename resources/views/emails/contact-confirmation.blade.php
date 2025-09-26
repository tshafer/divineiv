<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank you for contacting Divine IV & Wellness</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1e293b 0%, #2563eb 50%, #0891b2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .cta {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.05) 0%, rgba(13, 148, 136, 0.05) 100%);
            border-left: 4px solid #0891b2;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .contact-info {
            background: #f8fafc;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            border-left: 4px solid #0891b2;
        }
        .footer {
            background: #f8fafc;
            padding: 20px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank You for Contacting Us!</h1>
            <p>Divine IV & Wellness - Chandler, AZ</p>
        </div>
        
        <div class="content">
            <p>Dear {{ $name }},</p>
            
            <p>Thank you for reaching out to Divine IV & Wellness! We have received your message and truly appreciate you taking the time to contact us.</p>
            
            <div class="cta">
                <h3 style="color: #1e293b; margin-top: 0;">What Happens Next?</h3>
                <ul style="color: #64748b;">
                    <li>Our team will review your message within 24 hours</li>
                    <li>We'll prepare personalized information for your needs</li>
                    <li>A member of our staff will contact you directly</li>
                </ul>
            </div>
            
            <p>In the meantime, feel free to explore our services and educate yourself on how we can help you achieve your wellness goals.</p>
            
            <div class="contact-info">
                <h3 style="color: #1e293b; margin-top: 0;">Looking for Immediate Assistance?</h3>
                <p><strong>Phone:</strong> <a href="tel:480-488-9858" style="color: #0891b2; text-decoration: none;">(480) 488-9858</a></p>
                <p><strong>Email:</strong> <a href="mailto:info@divineiv.com" style="color: #0891b2; text-decoration: none;">info@divineiv.com</a></p>
                <p><strong>Address:</strong> 3930 S Alma School Rd Suite 10, Chandler, AZ 85248</p>
                <p><strong>Hours:</strong> Monday, Wednesday - Friday: 9:00 AM - 5:00 PM<br>
                <small style="color: #94a3b8;">Closed daily for lunch 12:00 PM - 1:30 PM (except Tuesday)</small></p>
            </div>
            
            <p>We look forward to helping you on your wellness journey!</p>
            
            <p>Warm Regards,<br>
            <strong>Amy Berkhout & The Divine IV & Wellness Team</strong></p>
        </div>
        
        <div class="footer">
            <p><strong>Divine IV & Wellness</strong><br>
            Your Expression of Natural Beauty</p>
            <p>This email was sent because you contacted us through our website.</p>
        </div>
    </div>
</body>
</html>
