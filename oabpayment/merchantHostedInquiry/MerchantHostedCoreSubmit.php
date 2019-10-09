
	<?php 
	
	
	   include ("../libfiles/iPayOabPipe.php");
		try {

			$currency	= "512";
 			$language	= "ENG";
 			$receiptURL	= "http://localhost/oabPhpDemoApp/merchantHostedInquiry/MerchantHostedPaymentResult.php";
 			$errorURL	= "http://localhost/oabPhpDemoApp/merchantHostedInquiry/MerchantHostedPaymentResult.php";
			$resourcePath = "C:\\xampp\\htdocs\\oabPhpDemoApp\\cgnFiles\\24\\";
			$aliasName = "nonoabcardprofile02";
			// use "oabcardprofile01" as alias name for oab cards


			$myObj = new iPayOabPipe();
			$myObj->setresourcePath(trim($resourcePath));
			$myObj->setkeystorePath(trim($resourcePath));
			$myObj->setalias(trim($aliasName));
			$myObj->setresponseURL(trim($receiptURL));
			$myObj->seterrorURL(trim($errorURL));
			$myObj->setcurrency(trim($currency));
			$myObj->setLanguage(trim($language));
			$myObj->setaction(trim($_POST['action']));
			$myObj->setamt($_POST['amount']);
			$myObj->settransId($_POST['transId']);
			$myObj->settrackId($_POST['trackId']);
			$myObj->setUdf1($_POST['udf1']);
			$myObj->setUdf2($_POST['udf2']);
			$myObj->setUdf3($_POST['udf3']);
			$myObj->setUdf4($_POST['udf4']);
			$myObj->setUdf5($_POST['udf5']);
			$result = $myObj->performTransactionHTTP();
			if(trim($result) == 0) {
				$url=$myObj->getWebAddress();
			} else {
				$url = $myObj->getErrorURL()."?ErrorText=".$myObj->getError();
			}
			header( 'Location:'.$url ) ;
		} catch(Exception $e) {
			echo 'Message: ' .$e->getFile();
	  		echo 'Message1 : ' .$e->getCode();
		}
		
	?>
	
