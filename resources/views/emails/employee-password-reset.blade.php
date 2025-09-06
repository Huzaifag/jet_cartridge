<!DOCTYPE html>
<html>
<head>
    <title>Your Password Has Been Reset</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2>Password Reset Notification</h2>
        
        <p>Dear {{ $name }},</p>
        
        <p>Your password has been reset by your administrator. Here are your new login credentials:</p>
        
        <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>New Password:</strong> {{ $password }}</p>
        </div>
        
        <p>For security reasons, please change your password after logging in.</p>
        
        <p>You can login at: <a href="{{ route('employee.login') }}">{{ route('employee.login') }}</a></p>
        
        <p>If you did not request this password reset, please contact your administrator immediately.</p>
        
        <p>Best regards,<br>{{ $seller }} Team</p>
    </div>
</body>
</html> 