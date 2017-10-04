<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cryptany: Transaction confirmed</title>
</head>
<body style="margin: 10px 0 0 0; padding: 0; background-color: #f4f4f4;">

<div style="text-align: center; margin-bottom: 20px;">
	<span style="font-family: Sans-serif; font-size: 12px;">Cannot view this email? Open your transaction <a href="https://mobile.cryptany.io/transit/{{ $txId }}">here</a> in your favorite browser</span>
</div>
<div style="margin: auto; width: 920px; background-color: #fff;"><!-- Main container -->
<h3>Transaction was confirmed by the blockchain</h3>
<p>Hi! This is <strong>Cryptany</strong> notification system. We want to inform you that your 
transaction was confirmed by blockchain and we are currently processing it.</p>
<p>Please find more details about transaction below:</p>
<ul>
<li>Transaction ID: {{ $txId }}</li>
<li>Wallet address: {{ $address }}</li>
<li>Received sum: {{ $srcAmount }} ETH</li>
<li>Transaction sum to receive: {{ $dstAmount }} ETH</li>
<li>Transaction date: {{ $txDate }} UTC</li>
<li>Card number: {{ $card }}</li>
</ul>
<p>Please, send money to the card and update transaction status at <a href="https://mobile.cryptany.io/updateStatus18640?txid={{ $txId }}">Status update page</a></p>

</div> <!-- Main container -->

</body>
</html>