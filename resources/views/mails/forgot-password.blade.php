<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Reset Password</title>
</head>
<body style="margin: 40px;">
    <h1 style="font-family: Tahoma, Geneva, sans-serif; font-size: 22px; text-transform: uppercase; font-weight: normal; color: #532994; margin: 0 0 20px 0;">Mr Shasha</h1>


	<p>Reset your password</p>


	<p>Click <a href="{{ action('UsersController@getSetNewPassword',$hash) }}" style="color: #532994;">here</a> to reset your password.</p>

	<p>Sincerely,</p>

	<p>Your Mr.ShaSha Team</p>

	<p>Email: support@MrShaSha.com</p>

{{--     <p style="font-family: Tahoma, Geneva, sans-serif; font-size: 14px; line-height: 20px; margin: 0 0 20px 0;"></p> --}}
</body>
</html>