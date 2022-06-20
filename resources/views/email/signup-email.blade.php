Hello {{ $email_data['username'] }}
<br><br>
Welcome to R14!
<br><br>
Please click the below link to verify your email anh activate your account!
<br><br>
<a href="http://127.0.0.1:8000/verify?code={{$email_data['verification_code']}}">Click here !</a>
<br><br>
Thank you!
