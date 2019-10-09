

<?php
$language =1;
    var_dump(extension_loaded('curl'));

$randomno = substr(number_format(time() * rand(),0,'',''),0,6);

    $curl = curl_init();

   curl_setopt_array($curl, array(
     CURLOPT_URL => "https://api.smsglobal.com/http-api.php?action=sendsms&user=rlm2it40&password=wNLkOwao&from=GIFTI&to=".$_GET['phone']."&text=Hello,%20you%20are%20one%20step%20closer%20to%20enjoy%20Gifti%20benefits.%20Your%20verification%20code%20is%20".$randomno,
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
$err = curl_error($curl);

curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } 
    else {

        if(strpos($response, 'OK: 0') !== false){
            if($language == "1"){
                echo json_encode( array(
                    'status' => 1,
                    'msg' => 'Your One-Time Password is sent!',
                    'otp' => $randomno
                            
                ) ); 
            }
            else{
                echo json_encode( array(
                    'status' => 1,
                    'msg' => 'تم  ارسال كلمة مرور لمرة واحدة',
                    'otp' => $randomno
                            
                ) ); 
            }
        }
        else{
            if($language == "1"){
                echo json_encode( array(
                    'status' => 0,                                    
                    'msg' => 'Phone number entered is invalid. Please try with another number',
                    'otp' => $randomno
                ) );    

            }
            else{
                echo json_encode( array(
                    'status' => 0,                                    
                    'msg' => 'رقم الهاتف الذي تم إدخاله غير صالح. يرجى المحاولة برقم آخر',
                    'otp' => $randomno
                ) );    

            }
 
        }

	}


?>