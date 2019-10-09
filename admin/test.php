<?php

//// 7.0 Connection //
/////////////mysql_query/////////
	function Run($qst)
	{
	$dbh = new PDO('mysql:host=giftiproductiondatabase.c83lu4ctkfw7.ap-south-1.rds.amazonaws.com;dbname=Gifti_Data', 'giftiproduction', 'GsKXN~T$^Pv?V?Kw');
	$qst=$dbh->query($qst) or die(print_r($dbh->errorInfo()));
	return $qst;
	}	

///////////mysql_num_rows//////////
	function rcount($qst)
	{
	$qst = $qst->rowCount();
	return $qst;
    }



//////////mysql_fetch_array////////////
function myfetch($var)
{
	$var = $var->fetch();
	return $var;
	
}

$firstname = "Asad";
$cardnamearabic = "بطاقة هدايا فيرجن ميغاستور";
$email = "asad.ali@meritincentives.com";
$name = "Asad Ali";
//// 5.6 version connection////

  $msg="";
                $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;" width="600" border="0" cellspacing="0" cellpadding="5">';
                $msg.= '<tbody>';
                $msg.= '<tr>';
                $msg.= '<td colspan="2">';
                $msg.= '<hr>';
                $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;margin:auto;" width="580" border="0" cellspacing="0" cellpadding="5">';
                $msg.= '<tbody>';
                $msg.= '<tr>'; 
                $msg.= '<td colspan="2">';
                $msg.= '<p style="text-align:right;">مرحبا'. $firstname .'</p>';
                $msg.= "<p style='text-align:right;'>   
				يسعدنا أنك قمت بشراء بطاقة هدايا إلكترونية (".$cardnamearabic."). نأمل أن تستمتع باستخدام تطبيق Gifti بسهولة وراحة.

				</p>";
                $msg.= "<p style='text-align:right;'>
				يمكنك أيضًا التحقق من القيام بعملية الشراء من قسم الهدايا المشتراة على تطبيق Gifti الخاص بك.

				</p>";
                $msg.= "<p style='text-align:right;'>
				إذا كانت لديك أي أسئلة بخصوص بطاقة الهدايا الإلكترونية أو تطبيق Gifti ، فلا تتردد في إرسال بريد إلكتروني إلى support.gifti@meritincentives.com. يمكنك أيضًا التواصل معنا عبر WhatsApp على +968 99372653.

				
				</p>";
	
	$msg.="<p style='text-align:right;'>نود ان نشكرك مرة اخرى على القيام بعملية الشراء.
</p>";
	
	$msg.="<p style='text-align:right;'> تحيات</p>";
               // $msg.= '<p>+968 99372653<br><a href="mailto:support.gifti@meritincentives.com">support.gifti@meritincentives.com</a></p>';
                $msg.= '<p></p>';
                $msg.= '<p style="text-align:right;"> Gifti فريق</p>';
                $msg.= '</td></tr>';
         
                $msg.= '</tbody>';
                $msg.= '</table>';
                $msg.= '</td>';
                $msg.= '</tr>';
                
                $msg.= '</tbody>';
                $msg.= '</table>';
				                $headers = "From: support.gifti@meritincentives.com \r\n";
                // $headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
                $headers .= "Reply-To: support.gifti@meritincentives.com \r\n";
                // $headers .= "CC: susan@example.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1\r\n'; 
                // $msg = "Dear".$full_name.", \n\n Your Password = ".$password;
$a = mail($email,$name."عملية الشراء ناجحة وتمتع بقسائم مثيرة من خلال تطبيق Gifti الخاص بك.!",$msg,$headers);
if($a)
{
	echo "Sent";
}