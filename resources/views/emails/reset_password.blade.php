<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            /* background-color: #ffffff; */
            background-color: #f5f5f5;
            padding: 30px 20px 20px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }
        .header img {
            max-width: 180px;
            height: auto;
        }
        .content {
            padding: 30px;
        }
        h1 {
            color: #2d3748;
            font-size: 24px;
            margin-top: 0;
        }
        p {
            margin-bottom: 20px;
            color: #4a5568;
        }
        .reset-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #38a169; /* Green */
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
            transition: background-color 0.3s;
        }
        .reset-button:hover {
            background-color: #2f855a; /* Darker green */
            color: white;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #718096;
            background-color: #f8f9fa;
            border-top: 1px solid #e2e8f0;
        }
        .link {
            color: #38a169; /* Green */
            text-decoration: none;
        }
        .code {
            font-family: monospace;
            background-color: #f0f0f0;
            padding: 8px 12px;
            border-radius: 4px;
            word-break: break-all;
            display: inline-block;
            max-width: 100%;
        }
        .divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 25px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ config('logo') }}" alt="{{ config('site_title') }}">
        </div>
        
        <div class="content">
            <h1>Password Reset Request</h1>
            <p>Hello {{ $user->name }},</p>
            
            <p>We received a request to reset your password for your <b>{{ config('site_title') }}</b> account. If you didn't make this request, you can safely ignore this email.</p>
            
            <div class="divider"></div>
            
            <p>To reset your password, click the button below:</p>
            
            <p style="text-align: center;">
                <a href="{{ url('/reset-password?token=' . $token) }}" class="reset-button">
                    Reset Password
                </a>
            </p>
            
            <p>This link will expire in 24 hours. If the button doesn't work, copy and paste the following link into your browser:</p>
            
            <p><span class="code">{{ url('/reset-password?token=' . $token) }}</span></p>
            
            <div class="divider"></div>
            
            <p>If you have any questions, please contact our support team at <a href="mailto:{{ $site['email'] }}">{{ $site['email'] }}</a>.</p>
            
            <p>Thanks,<br>The <strong>{{ $site['title'] }}</strong> Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; <script>document.write(new Date().getFullYear())</script> {{ $site['title'] }}. All rights reserved.</p>
            <p>
                {{ $site['address'] }}<br>
                <a href="{{ url('/') }}" class="link">Our Website</a> | 
                <a href="{{ url('/terms-conditions') }}" class="link">Terms Conditions</a>
            </p>
        </div>
    </div>
</body>
</html>