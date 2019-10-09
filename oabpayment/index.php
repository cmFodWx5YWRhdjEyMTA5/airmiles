<!DOCTYPE html>
<html lang="en">
<head>
  <title>Oman Arab Bank Merchant Sample Application</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./css/jquery.min.js"></script>
  <script src="./css/bootstrap.min.js"></script>
  		<?php
			function crypto_rand_secure($min, $max) {
				$range = $max - $min;
				if ($range < 1) return $min; // not so random...
				$log = ceil(log($range, 2));
				$bytes = (int) ($log / 8) + 1; // length in bytes
				$bits = (int) $log + 1; // length in bits
				$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
				do {
					$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
					$rnd = $rnd & $filter; // discard irrelevant bits
				} while ($rnd > $range);
				return $min + $rnd;
			}

			function getToken($length) {
				$token = "";
				$codeAlphabet = "";
				$codeAlphabet.= "";
				$codeAlphabet.= "0123456789";
				$max = strlen($codeAlphabet); // edited
				for ($i=0; $i < $length; $i++) {
					$token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
				}
				return $token;
			}

		?>

</head>
<body>

<div class="container">
	
  <h2>Transaction Types</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#bankHosted">Bank Hosted Transaction</a></li>
	<li><a href="#merchantHostedInquiry">Merchant Hosted Inquiry Transaction</a></li>
  </ul>

  <div class="tab-content">
    <div id="bankHosted" class="tab-pane fade in active">
      <h3></h3>
	  <br />
		<?php require('bankHosted/HostedPaymentdetailsHttp.php'); ?>
    </div>
   
  </div>
</div>

<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>

</body>
</html>