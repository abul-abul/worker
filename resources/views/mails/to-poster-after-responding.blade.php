
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Thank you for responding</title>
    <style>
        p {font-family: Tahoma, Geneva, sans-serif; font-size: 14px; line-height: 20px; margin: 0 0 20px 0;}
    </style>
</head>
<body style="margin: 40px;">
    <img src="{{asset('assets/img/logo.png')}}">
    <p>Hi {{ $seeker }}</p>
    <p>{{ $provider }} has responded to your request.</p>
    <p>To view {{ $provider }}'s profile click <a href="{{ $link }}">here</a></p>
    <p style="font-weight: bold">What's next?</p>
    <p>Qualified and available service providers will continue responding to you with their introductions & quotes. You may get up to 5 responses in total.</p>
    <br>
    <p>Need help? Email us at <a href="mailto:info@MrShaSha.com">info@MrShaSha.com</a></p>

</body>
</html>