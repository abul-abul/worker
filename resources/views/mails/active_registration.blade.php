
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Registration</title>
    <style>
        p {font-family: Tahoma, Geneva, sans-serif; font-size: 14px; line-height: 20px; margin: 0 0 20px 0;}
    </style>
</head>
<body style="margin: 40px;">
    <img src="{{asset('assets/img/logo.png')}}">
    <h1 style="font-family: Tahoma, Geneva, sans-serif; font-size: 22px; font-weight: normal; color: #532994; margin: 0 0 20px 0;">Welcome to Mr. ShaSha !</h1>
    <br><br>
    <p>Please click <a href="{{ action('UsersController@activeProfile' , $token  )}}" target="_blank">here</a> to confirm your registration!</p>
    <p>You access details are as follows:</p>
    <p><span style="font-weight: bold">Username : {{ $email }}</span></p>
    <p><span style="font-weight: bold">Password : {{ $password }}</span></p>
    <br>
    <p><span style="font-weight: bold">Our Tip for you : </span>Manage your service requests through your account. Log in, click on 'My Tasks' and receive an overview of your requests.</p>
    <br>
    <p>Sincerely,</p>
    <p style="font-weight: bold">Your Mr.ShaSha Team</p>
    <p>Email: <a href="mailto:support@MrShaSha.com">support@MrShaSha.com</a></p>

</body>
</html>