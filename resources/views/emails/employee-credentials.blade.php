<!DOCTYPE html>
<html>
<head>
    <title>Your Employee Account Credentials</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2>Welcome to {{ $seller }}</h2>
        
        <p>Dear {{ $name }},</p>
        
        <p>Your employee account has been created. Here are your login credentials:</p>
        
        <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>
        
        <p>For security reasons, please change your password after your first login.</p>
        
        <p>You can login at the employee portal using these credentials.</p>
        
        <p>If you have any questions or issues, please contact your administrator.</p>
        
        <p>Best regards,<br>{{ $seller }} Team</p>
    </div>
</body>
</html> 