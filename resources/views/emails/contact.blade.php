<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Form Submission - Divine IV & Wellness</title>
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
        .field {
            margin-bottom: 20px;
        }
        .label {
            font-weight: 600;
            color: #1e293b;
            display: block;
            margin-bottom: 5px;
        }
        .value {
            color: #64748b;
            padding: 10px;
            background: #f8fafc;
            border-radius: 4px;
            border-left: 4px solid #0891b2;
        }
        .message-box {
            background: #f0f7ff;
            border: 1px solid #0891b2;
            border-radius: 6px;
            padding: 15px;
            margin-top: 10px;
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
            <h1>New Contact Form Submission</h1>
            <p>Divine IV & Wellness - Chandler, AZ</p>
        </div>
        
        <div class="content">
            <div class="field">
                <span class="label">Name:</span>
                <div class="value">{{ $name }}</div>
            </div>
            
            <div class="field">
                <span class="label">Email:</span>
                <div class="value">
                    <a href="mailto:{{ $email }}" style="color: #0891b2; text-decoration: none;">{{ $email }}</a>
                </div>
            </div>
            
            @if($phone)
            <div class="field">
                <span class="label">Phone:</span>
                <div class="value">
                    <a href="tel:{{ $phone }}" style="color: #0891b2; text-decoration: none;">{{ $phone }}</a>
                </div>
            </div>
            @endif
            
            @if($subject)
            <div class="field">
                <span class="label">Subject:</span>
                <div class="value">{{ $subject }}</div>
            </div>
            @endif
            
            @if($patient_status)
            <div class="field">
                <span class="label">Patient Status:</span>
                <div class="value">{{ ucfirst($patient_status) }} Patient</div>
            </div>
            @endif
            
            <div class="field">
                <span class="label">Message:</span>
                <div class="message-box">{{ $message }}</div>
            </div>
            
            <div class="field">
                <span class="label">Submitted:</span>
                <div class="value">{{ $submitted_at }}</div>
            </div>
        </div>
        
        <div class="footer">
            <p>This message was sent from your Divine IV & Wellness contact form.</p>
            <p>Contact Info: 3930 S Alma School Rd Suite 10, Chandler, AZ 85248 | (480) 488-9858</p>
        </div>
    </div>
</body>
</html>
