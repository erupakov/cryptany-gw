<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cryptany: Transaction created</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

</head>
<body style="margin: 10px 0 0 0; padding: 0; background-color: #f4f4f4;">

<div style="text-align: center; margin-bottom: 20px;">
	<span style="font-family: Sans-serif; font-size: 12px;">Cannot view this email? Open your transaction <a href="https://mobile.cryptany.io/trans/111">here</a> in your favorite browser</span>
</div>
<div style="margin: auto; width: 920px; background-color: #fff;"><!-- Main container -->
<h3>Your transaction was successfully created</h3>
<p>Hi {{ $message->first_name }} {{ $message->family_name}}! This is <a href="http://cryptany.io/" >Cryptany</a> notification system. We want to inform you that your 
Ethereum to USD transfer transaction was successfully created and is currently waiting for confirmation.</p>
<p>Please, find more details about transaction below:</p>
<ul>
<li>Transaction ID:</li>
<li>Transaction sum:</li>
<li>Transaction date:</li>
<li>QR code:</li>
</ul>
<p>You can track your transaction status by using <a href="#">this link</a> via Cryptany.io mobile application</p>
</div> <!-- Main container -->

</body>
</html>