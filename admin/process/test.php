<?php

$gsm = $_GET['gsm'];


if($_GET['language'] == "1")
			{
$msg = urlencode("Thank you for purchasing (".$cardname.") . For queries, please send an email to support.gifti@meritincentives.com or send WhatsApp message on +968 99372653.");
}
else{
$msg = urlencode("شكرًا لك لشراء بطاقة الهدايا الإلكترونية (".$cardnamearabic.").للاستفسارات ، يرجى إرسال رسالة الكترونية إلى support.gifti@meritincentives.com أو إرسال رسالة WhatsApp على +968 99372653.");

}			










            $curl = curl_init();

            curl_setopt_array($curl, array(
             CURLOPT_URL => "https://api.smsglobal.com/http-api.php?action=sendsms&user=rlm2it40&password=wNLkOwao&from=GIFTI&to=968".$gsm."&text=$msg",

              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 40,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_POSTFIELDS => "",
              CURLOPT_HTTPHEADER => array(
                "Postman-Token: abc7314c-847b-450c-8e96-3b8cef6ed72b",
                "cache-control: no-cache"
              ),
            ));
			
			

 $response = curl_exec($curl);
print_r($response);



?>