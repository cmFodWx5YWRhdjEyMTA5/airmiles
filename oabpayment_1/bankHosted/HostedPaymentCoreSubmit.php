<?php 
	include ("../libFiles/iPayOabPipe.php");
    $price = !empty($_GET['price']) ? $_GET['price'] : false;
    $isoab = !empty($_GET['isoab']) ? $_GET['isoab'] : false;
    $trackid = !empty($_GET['trackid']) ? $_GET['trackid'] : false;
      $currencycode = !empty($_GET['currencycode']) ? $_GET['currencycode'] : false;
   
    echo "";
  
	try {

			$currency	= $currencycode;
 			$language	= "ENG";
 			
 			$errorURL	= "https://oab.doodledigital.com/oabpayment/bankHosted/HostedPaymentError.php";
			$resourcePath = "/home1/phutwamy/public_html/oab.doodledigital.com/oabpayment/cgnFiles/24/";
			if($isoab == "1"){
			$aliasName = "oabcardprofile01";	
			$receiptURL	= "https://oab.doodledigital.com/oabpayment/bankHosted/HostedPaymentResult.php";
			}
			else{
					$aliasName = "nonoabcardprofile02";
					$receiptURL	= "https://oab.doodledigital.com/oabpayment/bankHosted/HostedPaymentResultnonoab.php";
			}
			
			// use "oabcardprofile01" as alias name for oab cards

			$myObj = new iPayOabPipe();
			$myObj->setResourcePath(trim($resourcePath));
			$myObj->setKeystorePath(trim($resourcePath));
			$myObj->setAlias(trim($aliasName));
			$myObj->setCurrency(trim($currency));
			$myObj->setLanguage(trim($language));
			$myObj->setResponseURL(trim($receiptURL));
			$myObj->setErrorURL(trim($errorURL));

			$myObj->setAction(trim(1));
			$myObj->setAmt($price);
			$myObj->setTrackId($trackid);
		
		
			
			$result = $myObj->performPaymentInitializationHTTP();
			
			if(trim($result) == 0) {
			
				$url=$myObj->getWebAddress();
			} else {
			
				$url = $myObj->getErrorURL()."?ErrorText=".$myObj->getError();
			}
			
			echo "<script>window.location.href='$url'</script>";


			
		} catch(Exception $e) {
			
			echo 'Message: ' .$e->getFile();
	  		echo 'Message1 : ' .$e->getCode();
		}
 
    

	   //insert table
	
		
	?>