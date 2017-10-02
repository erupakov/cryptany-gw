<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cryptany: Funds sent</title>
</head>
<body style="margin: 10px 0 0 0; padding: 0; background-color: #f4f4f4;">

<div style="text-align: center; margin-bottom: 20px;">
	<span style="font-family: Sans-serif; font-size: 12px;">Cannot view this email? Open your transaction <a href="https://mobile.cryptany.io/transit/{{ $txId }}">here</a> in your favorite browser</span>
</div>
<div style="margin: auto; width: 920px; background-color: #fff;"><!-- Main container -->
<h3>Your funds was successfully sent to your card account.</h3>
<p>Hi! This is <strong>Cryptany</strong> notification system. We want to inform you that your 
transaction was processed and funds was successfully sent to your bank account. You should get bank notification soon.</p>
<p>Please find more details about transaction below:</p>
<ul>
<li>Transaction ID: {{ $txId }}</li>
<li>Card number: {{ $card_number }}</li>
<li>Wallet address: {{ $address }}</li>
<li>Transaction sum: {{ $srcAmount }} ETH</li>
<li>Transaction date: {{ $txDate }} UTC</li>
<li>Status: funds was successfully sent to bank account</li>
</ul>
<p>You can track your transaction status by using <a href="https://mobile.cryptany.io/transit/{{ $txId }}">this link</a> via Cryptany.io mobile application</p>
<p>All transactions are subject to KYC / AML procedures. If you fail on KYC / AML procedures or Cryptany is not able to process the transaction, you will get full refund in 
cryptocurrency to your cryptowallet.
</p>
</div> <!-- Main container -->

</body>
</html>