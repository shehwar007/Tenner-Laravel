<!DOCTYPE html>
<html>
<head>
  <title>Reset Password - One-Time Passcode (Pin)</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7;">
  <div class="container" style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; border: 1px solid #ccc; border-radius: 5px;">
    <div class="text-center" style="text-align: center;">
      
    </div>
    <h1 class="main-heading" style="text-align: center; color: #ff0000;">Reset Your Password - Pin</h1>
    <p style="color: #333; line-height: 1.6;">Dear {{$username}},</p>
    <p style="color: #333; line-height: 1.6;">We hope this email finds you well. You requested a password reset. Here's your One-Time Passcode (PIN):</p>   
    <div class="otp" style="background:#ff0000; color: #fff; font-size: 28px; padding: 10px; border-radius: 5px; text-align: center; margin: 20px 0; font-weight: 600;">{{$otp_code}}</div>
    <p style="color: #333; line-height: 1.6;">Remember, keep this PIN safe—don't share it, not even with us.</p>
    <p style="color: #333; line-height: 1.6;">Need help? Contact us immediately if you face issues or suspect any security risks</p>
    <p class="tips" style="line-height: 1.6; color: #ff0000; font-weight: bold; margin-top: 20px;">Here are some essential tips to protect your account:</p>
    <ul>
      <li>Use a strong and unique password, a combination of letters, numbers, and special characters.</li>
      <li>Avoid easy-to-guess details like your name or birthdate.</li>
    </ul>
    <p style="color: #333; line-height: 1.6;">Thanks for choosing us! Your security matters.</p>
    <p style="color: #333; line-height: 1.6;">Reach out for any questions.</p>
    <p class="support-info" style="line-height: 1.6; color: #777;">Best regards,<br><a style="color:#777; text-decoration:none;">Tenner</a></p>
  </div>
</body>
</html>