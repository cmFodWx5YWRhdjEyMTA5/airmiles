<?php
require_once 'classDatabase.php';
class User {
    private $db;
    private $table_name = "usermaster";
    public $id;
    public $emailid;
    public $firstname;
    public $lastname;
    public $password;
    public $displayname;
    public $country;
    public $mobileno;
    public $notificationtoken;
    public $devicename;
    public $isfacebook;
    public $istwitter;
    public $isgoogle;
    public $isactive;
    public $systemversion;
    public $userrole;
    public $createddate;
    public $issocial;
    public $temp;
    public $dbtb_query;


    function __construct($db) {
        # code...
        $this->db = $db;
    }

    function __destruct() {
        $this->db->close();
    }

 public function selectAll() {

        $sql = "select * from " . $this->table_name;

        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);

 }
 public function create(){
   
        $sql = "update " . $this->table_name . " set socialtoken='".$this->socialtoken."'  where emailid='".$this->emailid."'";
        $query = $this->db->query( $sql );

        $sql = "select * from " . $this->table_name . "  where gsm= '" . $this->gsm . "'";
        $query = $this->db->query( $sql );
        $reg_result = mysqli_fetch_assoc($query);
        if (!empty($reg_result)) {
            if($this->issocial == 1){
        
                $data["username"] = $reg_result["username"];
                $data["userid"] = $reg_result["userid"];
                $data["emailid"] = $reg_result["emailid"];
                $data["firstname"] = $reg_result["firstname"];
                $data["lastname"] = $reg_result["lastname"];
                $data["dateofbirth"] = $reg_result["dateofbirth"];
                $data["phonenumber"] = $reg_result["phonenumber"];
                $data["gender"] = $reg_result["gender"];
                $data["notificationtoken"] = $reg_result["notificationtoken"];  
                $data["gsm"] = $reg_result["gsm"];
                $data["nationality"] = $reg_result["nationality"];
                $data["devicename"] = $reg_result["devicename"];
                $data["isfacebook"] = $reg_result["isfacebook"];
                $data["istwitter"] = $reg_result["istwitter"];
                $data["isgoogle"] = $reg_result["isgoogle"];
                $data["allowpush"] = $reg_result["allowpush"];
                $data["receiveemail"] = $reg_result["receiveemail"];
                $data["allowlocation"] = $reg_result["allowlocation"];
                $data["socialtoken"] = $reg_result["socialtoken"];
                $data["language"] = $reg_result["language"];
                $data["nationality"] = $reg_result["nationality"];
                $data["myrefcode"] = $reg_result["myrefcode"];
                                 
                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 1,
                        'msg' => "You're in!",
                        'userdetails' => $data
                    ) );

                }
                else{
                    echo json_encode( array(
                        'status' => 1,
                        'msg' => "اهلا بك!",
                        'userdetails' => $data
                    ) );

                }

            }
            else{
                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'Sorry, this mobile number is already registered , Please try with other mobile number',
                    ) );
                }
                else{
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'عذرا، هذا الرقم مسجل مسبقا، الرجاء إستخدام رقم  آخر',
                    ) );
                }
           
            }
           
        } else {
            //email
if($this->language == "1"){
                $msg="";
                     //$password="password";
                $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;" width="600" border="0" cellspacing="0" cellpadding="5">';
                $msg.= '<tbody>';
                $msg.= '<tr>';
                $msg.= '<td colspan="2">';
                $msg.= '<hr>';
                $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;margin:auto;" width="580" border="0" cellspacing="0" cellpadding="5">';
                $msg.= '<tbody>';
                $msg.= '<tr>'; 
                $msg.= '<td colspan="2">';
                $msg.= '<p>Marhaba '. $this->firstname .' '.$this->lastname.',</p>';
                $msg.= "<p>Welcome to Gifti Oman's first gift cards & discounts app powered by Oman Arab Bank. </p>";
                $msg.= "<p>We've made it so convenient to bring you closer to the categories you love - Food, Fashion & Retail, Hotel & Travel, Attractions & Leisure, Beauty and Services.</p>";
                $msg.= "<p>Get ready for a great shopping experience from our many partners in Oman and the United Arab Emirates.</p>";
                $msg.= "<p>You will enjoy even more special deals when having an Oman Arab Bank credit card. So, don't wait any longer, apply for an OAB card today.</p>";
                $msg.= "<p>Show us some love by choosing from our wide range of gift cards & discounts now! Click this link to know more details. For any queries, please contact Gifti Member Services Centre. Alternatively, you can reach us at:</p>";
                $msg.= '<p>+968 99372653<br>
                        <a href="mailto:support.gifti@meritincentives.com">support.gifti@meritincentives.com</a></p>';
                $msg.= '<p></p>';
                $msg.= '<p>The Gifti Team </p>';
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
                // $msg = "Dear".$full_name.", \n\n Your Password = ".$password;
                $a = mail($this->emailid,$this->firstname."  your registration is successful, enjoy exciting vouchers with your Gifti app.!",$msg,$headers);

	
}
			
			else{
				       $msg="";
                     //$password="password";
                $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;" width="600" border="0" cellspacing="0" cellpadding="5">';
                $msg.= '<tbody>';
                $msg.= '<tr>';
                $msg.= '<td colspan="2">';
                $msg.= '<hr>';
                $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;margin:auto;" width="580" border="0" cellspacing="0" cellpadding="5">';
                $msg.= '<tbody>';
                $msg.= '<tr>'; 
                $msg.= '<td colspan="2">';
                $msg.= '<p style="text-align:right;">مرحبا'. $this->firstname .' '.$this->lastname.',</p>';
                $msg.= "<p style='text-align:right;'>.مرحبًا بكم في جيفتي Gifti أول تطبيق لبطاقات الهدايا والخصومات في عمان بدعم من بنك عُمان العربي</p>";
                $msg.= "<p style='text-align:right;'>لقد جعلناها سهله للغاية لنجعلك أقرب إلى الفئات التي تحبها - الطعام ، الأزياء والتجزئة ، الفنادق والسفر ، مناطق الجذب السياحي والترفيه ، الجمال والخدمات</p>";
                $msg.= "<p style='text-align:right;'>استعد لتجربة تسوق رائعة من العديد من شركائنا في سلطنة عمان والإمارات العربية المتحدة</p>";
                $msg.= "<p style='text-align:right;'>سوف تستمتع بمزيد من العروض الخاصة عند الحصول على بطاقة ائتمان من بنك عمان العربي. لذلك، لا تنتظر أكثر، تقدم بطلب للحصول على بطاقة OAB اليوم
</p>";
                $msg.= "<p style='text-align:right;'>أظهر لنا بعض الحب من خلال الاختيار من بين مجموعة واسعة من بطاقات الهدايا والخصومات الآن! انقر على هذا الرابط لمعرفة المزيد من التفاصيل. لأية استفسارات ، يرجى الاتصال بمركز خدمات Gifti للأعضاء. بدلاً من ذلك ، يمكنك التواصل معنا على: +968 99372653 <a href='mailto:support.gifti@meritincentives.com'>support.gifti@meritincentives.com
</p>";
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
                // $msg = "Dear".$full_name.", \n\n Your Password = ".$password;
                $a = mail($this->emailid,$this->firstname." !تسجيلك ناجح ، استمتع بقسائم مثيرة مع تطبيق Gifti الخاص بك",$msg,$headers);

			}
			
			
                
                if($a){

                $randomno = $this->myref($this->firstname);


                $sql = "insert into " . $this->table_name. "(emailid,firstname,lastname,password,gsm,nationality,notificationtoken,devicename,isfacebook,istwitter,isgoogle,isactive,socialtoken,username,dateofbirth,referralcode,language,gender,rememberme,myrefcode)VALUES('" . $this->emailid . "','" . $this->firstname . "','" . $this->lastname . "','" . md5($this->password) . "','" . $this->gsm . "','" . $this->nationality . "','" . $this->notificationtoken . "','" . $this->devicename . "','" . $this->isfacebook . "','" . $this->istwitter . "','" . $this->isgoogle . "','1','".$this->socialtoken."','".$this->username."','".$this->dateofbirth."','".$this->referralcode."','".$this->language."','".$this->gender."','".$this->rememberme."','".$randomno."')";
                $query = $this->db->query( $sql );
               

                    if( $this->db->affected_rows > 0 ) {
                        $sql = "select * from " . $this->table_name . "  where userid= '" . $this->db->insert_id . "'";
                        $query = $this->db->query( $sql );
                        $reg_result = mysqli_fetch_assoc($query);
                        if (!empty($reg_result)) {
                            $data["username"] = $reg_result["username"];
                            $data["userid"] = $reg_result["userid"];
                            $data["emailid"] = $reg_result["emailid"];
                            $data["firstname"] = $reg_result["firstname"];
                            $data["lastname"] = $reg_result["lastname"];
                            $data["dateofbirth"] = $reg_result["dateofbirth"];
                            $data["phonenumber"] = $reg_result["phonenumber"];
                            $data["gender"] = $reg_result["gender"];
                            $data["notificationtoken"] = $reg_result["notificationtoken"];  
                            $data["gsm"] = $reg_result["gsm"];
                            $data["nationality"] = $reg_result["nationality"];
                            $data["devicename"] = $reg_result["devicename"];
                            $data["isfacebook"] = $reg_result["isfacebook"];
                            $data["istwitter"] = $reg_result["istwitter"];
                            $data["isgoogle"] = $reg_result["isgoogle"];
                            $data["allowpush"] = $reg_result["allowpush"];
                            $data["receiveemail"] = $reg_result["receiveemail"];
                            $data["allowlocation"] = $reg_result["allowlocation"];
                            $data["socialtoken"] = $reg_result["socialtoken"];
                            $data["language"] = $reg_result["language"];
                            $data["userid"] = $reg_result["userid"];
                            $data["myrefcode"] = $reg_result["myrefcode"];
                            $data["nationality"] = $reg_result["nationality"];
                            $sql = "insert into pwdhistory (pwd,userid)VALUES('" . md5($this->password) . "','" . $data["userid"] . "')";

                            $query = $this->db->query( $sql );

                            if($this->language == "1"){
                                echo json_encode( array(
                                    'status' => 1,
                                    'msg' => 'Yay! Your account is registered!',
                                    'userdetails' => $data
                                ) );
                            }
                            else{
                                echo json_encode( array(
                                    'status' => 1,
                                    'msg' => ' مبروك! تم تسجيل حسابك!',
                                    'userdetails' => $data
                                ) );
                            }
                               
                        }

                    } else {
                        if($this->language == "1"){
                            echo json_encode( array(
                                'status' => 0,                                    
                                'msg' => 'Whoops, something went wrong :(',
                                ) ); 
                        }
                        else{
                            echo json_encode( array(
                                'status' => 0,                                    
                                'msg' => 'عفوًا، حدث خطأ ما :(',
                                 ) ); 
                        }
                    
                    }
                    //end
                }
                else{
					if($this->language == "1"){
					
                        echo json_encode( array(
                        'status' => 0,
                        'msg' => 'Error Sending Email Occured',
                        ) );
                }
			
					
					
					if($this->language != "1"){
					
                        echo json_encode( array(
                        'status' => 0,
                        'msg' => 'عفوا  ، تعذر ارسال هذا البريد الإلكتروني',
                        ) );
                }	
					
				}
			
        }


}
public function myref($name)
{
    
    $randomno = substr(number_format(time() * rand(),0,'',''),0,5);
    $randomno1 = substr($name,0,3);
    $randomno1 = $randomno1.$randomno;
    $sql = "select * from " . $this->table_name . "  where myrefcode= '" . $randomno1 . "'";
    $query = $this->db->query( $sql );
    if( $this->db->affected_rows > 0 ) {
        $this->myref($name);
    }
    else{
         return $randomno1;
    }  
}

 public function login(){
  

    $sql = "select * from " . $this->table_name . "  where gsm= '" . $this->username . "' and password= '" . md5($this->password) . "'";
    $query = $this->db->query( $sql );
    $reg_result = mysqli_fetch_assoc($query);
    $data  = array();

    if (!empty($reg_result)) {
        $data["username"] = $reg_result["username"];
        $data["userid"] = $reg_result["userid"];
        $data["emailid"] = $reg_result["emailid"];
        $data["firstname"] = $reg_result["firstname"];
        $data["lastname"] = $reg_result["lastname"];
        $data["dateofbirth"] = $reg_result["dateofbirth"];
        $data["phonenumber"] = $reg_result["phonenumber"];
        $data["gender"] = $reg_result["gender"];
        $data["notificationtoken"] = $reg_result["notificationtoken"];  
        $data["gsm"] = $reg_result["gsm"];
        $data["devicename"] = $reg_result["devicename"];
        $data["isfacebook"] = $reg_result["isfacebook"];
        $data["istwitter"] = $reg_result["istwitter"];
        $data["isgoogle"] = $reg_result["isgoogle"];
        $data["allowpush"] = $reg_result["allowpush"];
        $data["receiveemail"] = $reg_result["receiveemail"];
        $data["allowlocation"] = $reg_result["allowlocation"];
        $data["socialtoken"] = $reg_result["socialtoken"];
        $data["language"] = $reg_result["language"];
        $data["myrefcode"] = $reg_result["myrefcode"];
        $data["nationality"] = $reg_result["nationality"];
      
        $sql = "UPDATE " . $this->table_name . " set `notificationtoken`='" . $this->notificationtoken . "' where userid=" . $data["userid"];
        $query = $this->db->query( $sql );

        $data["notificationtoken"] = $this->notificationtoken;   
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 1,
                    'msg' => "You're in!",
                    'userdetails' => $data
                ) );

            }
            else{
                echo json_encode( array(
                    'status' => 1,
                    'msg' => "اهلا بك!",
                    'userdetails' => $data
                ) );

            }
           
             
           
    } 
    else {
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 0,
                'msg' => 'Please verify mobile number / password and try again.'
                
            ) );
        }
        else{
            echo json_encode( array(
                'status' => 0,
                'msg' => 'يرجى التحقق من رقم الهاتف النقال / كلمة المرور والمحاولة مرة أخرى.'
                
            ) );
        }
            

    }
}
 public function socialtoken(){
            
    if($this->socialtoken != ''){
        $sql = "select * from " . $this->table_name . "  where socialtoken like '%".$this->socialtoken."%' order by userid desc";
    }
    if($this->emailid != ''){
        $sql = "select * from " . $this->table_name . "  where emailid='".$this->emailid."' order by userid desc";
    }
          
            
    $query = $this->db->query( $sql );
    $reg_result = mysqli_fetch_assoc($query);
    $data  = array();

    if (!empty($reg_result)) {
        $data["username"] = $reg_result["username"];
        $data["userid"] = $reg_result["userid"];
        $data["emailid"] = $reg_result["emailid"];
        $data["firstname"] = $reg_result["firstname"];
        $data["lastname"] = $reg_result["lastname"];
        $data["dateofbirth"] = $reg_result["dateofbirth"];
        $data["phonenumber"] = $reg_result["phonenumber"];
        $data["gender"] = $reg_result["gender"];
        $data["notificationtoken"] = $reg_result["notificationtoken"];  
        $data["gsm"] = $reg_result["gsm"];
        $data["devicename"] = $reg_result["devicename"];
        $data["isfacebook"] = $reg_result["isfacebook"];
        $data["istwitter"] = $reg_result["istwitter"];
        $data["isgoogle"] = $reg_result["isgoogle"];
        $data["allowpush"] = $reg_result["allowpush"];
        $data["receiveemail"] = $reg_result["receiveemail"];
        $data["allowlocation"] = $reg_result["allowlocation"];
        $data["socialtoken"] = $reg_result["socialtoken"];
        $data["language"] = $reg_result["language"];
        $data["myrefcode"] = $reg_result["myrefcode"];
        $data["nationality"] = $reg_result["nationality"];

        echo json_encode( array(
            'status' => 1,
            'msg' => 'User Found',
            'userdetails' => $data
        ) );
           
    } 
    else {
            echo json_encode( array(
             'status' => 0,
             'msg' => 'Not Found'
                        
            ) );

    }
 }

 public function checkusername(){
            
        
    $sql = "select * from " . $this->table_name . " where emailid='".$this->emailid."' order by userid desc";
    $query = $this->db->query( $sql );
    $reg_result = mysqli_fetch_assoc($query);
    if (!empty($reg_result)) {
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 1,
                'msg' => 'Your email has already been registered'
          
            ) );

        }
        else{
            echo json_encode( array(
                'status' => 1,
                'msg' => 'لقد تم  تسجيل بريدك الإلكتروني مسبقا'
                                  
            ) );

        }

    } 
    else {

        $sql = "select * from " . $this->table_name . " where gsm='".$this->phone."' order by userid desc";
        $query = $this->db->query( $sql );
        $reg_result = mysqli_fetch_assoc($query);
        if (!empty($reg_result)) {

            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 1,
                    'msg' => 'Sorry, mobile number already taken.'
      
                ) );

            }
            else{
                echo json_encode( array(
                    'status' => 1,
                    'msg' => 'عذرا، تم استخدام هذا الرقم مسبقا'
                                  
                ) );

            }
                       
        }
        else {
            //refcode
            if($this->refcode != ''){
        $sql = "select * from " . $this->table_name . " where myrefcode='".$this->refcode."' order by userid desc";
        $query = $this->db->query( $sql );
        $reg_result = mysqli_fetch_assoc($query);
if (!empty($reg_result)) {
     if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'Valid Referralcode'
      
                ) );

            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'رمز المرجع صحيح'
                                  
                ) );

            }
}else{
     if($this->language == "1"){
                echo json_encode( array(
                    'status' => 1,
                       'msg' => 'Invalid Referral Code'
      
                ) );

            }
            else{
                echo json_encode( array(
                    'status' => 1,
             'msg' => 'رمز المرجع غير صحيح'
                                  
                ) );

            }
          
}
            }else{
                  if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'Valid Referralcode'
      
                ) );

            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'رمز المرجع صحيح'
                                  
                ) );

            }
            }

     

        }
                       

    }

}


public function forgetpassword(){
    $randomno = substr(number_format(time() * rand(),0,'',''),0,6);
        
    if($this->type == "1" ){
           //  $sql = "select * from " . $this->table_name . "  where emailid= '" . $this->emailid . "'";
        $sql = "select * from " . $this->table_name . "  where emailid= '" . $this->emailid . "' ";
        $query = $this->db->query( $sql );
        $reg_result = mysqli_fetch_assoc($query);
        if (!empty($reg_result)) {
            $userid = $reg_result["userid"];
            $firstname = $reg_result["firstname"];
            $gsm = $reg_result["gsm"];
if($this->language == "1"){
            //mail send here
            $msg="";
            $password="password";
            $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;" width="600" border="0" cellspacing="0" cellpadding="5">';
            $msg.= '<tbody>';
            $msg.= '<tr>';
            $msg.= '<td colspan="2">';
            $msg.= '<hr>';
            $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;margin:auto;" width="580" border="0" cellspacing="0" cellpadding="5">';
            $msg.= '<tbody>';
            $msg.= '<tr>';
            $msg.= '<td colspan="2">';
            $msg.= '<p>Hello '. $firstname .',</p>';
            $msg.= '<p></p>';
            $msg.= "<p>Don't worry about forgetting passwords. It happens.</p>";
            $msg.= '<p>Click on this <a target="_blank" href="http://doodle.meritincentives.com/forgot_password.php?user='.openssl_encrypt($userid,"AES-128-ECB",$password).'">link</a> to reset your password.</p>';
            $msg.= "<p>If you haven't initiated this request, please ignore this message.</p>";
            $msg.= '<p></p>';
            $msg.= '<p>The Gifti Team </p>';
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
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            // $msg = "Dear".$full_name.", \n\n Your Password = ".$password;
            $a = mail($this->emailid,"Forget Password Request Received",$msg,$headers);
}
			else{
				 $msg="";
            $password="password";
            $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;" width="600" border="0" cellspacing="0" cellpadding="5">';
            $msg.= '<tbody>';
            $msg.= '<tr>';
            $msg.= '<td colspan="2">';
            $msg.= '<hr>';
            $msg.= '<table style="font-family:Calibri,Arial,Helvetica,sans-serif;font-size:14px;margin:auto;" width="580" border="0" cellspacing="0" cellpadding="5">';
            $msg.= '<tbody>';
            $msg.= '<tr>';
            $msg.= '<td colspan="2">';
            $msg.= '<p style="text-align:right;">'. $firstname .' مرحبا  </p>';
            $msg.= '<p style="text-align:right;"></p>';
            $msg.= "<p style='text-align:right;'>لا تقلق بشأن نسيان كلمات المرور. هذا يحدث</p>";
            $msg.= '<p style="text-align:right;">
			
 .لإعادة تعيين كلمة المرور الخاصة بك <a target="_blank" href="http://doodle.meritincentives.com/forgot_password_arabic.php?user='.openssl_encrypt($userid,"AES-128-ECB",$password).'">link</a> انقر على هذا الرابط</p>';
            $msg.= "<p style='text-align:right;'>.إذا لم تكن أنت من تقدم بهذا الطلب، فيرجى تجاهل هذه الرسالة</p>";
            $msg.= '<p style="text-align:right;"></p>';
            $msg.= '<p style="text-align:right;"> Gifti فريق جيفتي</p>';
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
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            // $msg = "Dear".$full_name.", \n\n Your Password = ".$password;
            $a = mail($this->emailid,"تم استلام طلب نسيان كلمة المرور",$msg,$headers);
				
			}
           //  $a = mail("sagarss191@gmail.com","Forget Password Request Received",$msg,$headers);

            if($a){  
                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 1,
                        'msg' => 'Email successfully sent. Please check your email now & reset your password',
                        'userid' => $userid,
                        'code' => $randomno

                    ) );

                }
                else{
                    echo json_encode( array(
                        'status' => 1,
						'msg' => ' تم ارسال البريد الإلكتروني بنجاح. يرجى التحقق من بريدك الإلكتروني الآن وإعادة تعيين كلمة المرور الخاصة بك',
                        'userid' => $userid,
                        'code' => $randomno

                    ) );

                }                 
            }  
        } 
        else {

           if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'Oops, Email ID entered is not registered with Gifti',
                ) );

            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'عفوًا، عنوان البريد الإلكتروني الذي تم إدخاله غير مسجل لدى Gifti',
                ) );
                 
            }
        }
    }else{
        //$sql = "select * from " . $this->table_name . "  where gsm= '" . $this->emailid . "'";
        $sql = "select * from " . $this->table_name . "  where gsm= '" . $this->emailid . "' ";
        $query = $this->db->query( $sql );
        $reg_result = mysqli_fetch_assoc($query);
        if (!empty($reg_result)) {
         

			
			$language = $this->language;
			
			
			
			if($language == "1")
{
$msg = urlencode("Hello, your verification code to reset your password is  ".$randomno.". Yalla!");
}
if($language != "1")
{
$msg = urlencode("مرحبًا ، رمز التحقق لإعادة تعيين كلمة المرور هو ".$randomno.".  يالا !");

}			

			
			
			
			
			
			
			
			
			
            $curl = curl_init();

			
			
			
            curl_setopt_array($curl, array(
             CURLOPT_URL => "https://api.smsglobal.com/http-api.php?action=sendsms&user=rlm2it40&password=wNLkOwao&maxsplit=8&from=GIFTI&to=968".$this->emailid."&text=$msg",

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
                      if($this->language == "1"){
              echo json_encode( array(
                        'status' => 0,
                        'msg' => 'Something happened while sending  , please try again!'
                                                        
                    ) );

            }
            else{
                echo json_encode( array(
                        'status' => 0,
                        'msg' => 'حدث خطأ ما أثناء الارسال، من فضلك حاول مرة أخرى'
                                                        
                    ) );
                 
            }
                        
                } 
                else {

                    if(strpos($response, 'OK: 0') !== false){
                    $date = date('m/d/Y h:i:s a', time());

                    $sql2= "update usermaster set OTP='".$randomno."', OTPtime='".$date."' where gsm='".$this->emailid."' ";
    
                     //echo $sql2;
                    $result2 = $this->db->query($sql2);

                        if( $this->db->affected_rows > 0 ) {
                            if($this->language == "1"){
                                echo json_encode( array(
                                    'status' => 1,
                                    'msg' => 'Please enter the verification code sent to your registered mobile number'
                                        
                                ) ); 
                                         
                            }
                            else{
                                echo json_encode( array(
                                    'status' => 1,
                                    'msg' => 'الرجاء إدخال رمز التحقق الذي تم إرساله إلى رقم هاتفك النقال'
                                                                            
                                ) ); 
                                         
                            }
                        }
                        else
                        {
                            if($this->language == "1"){
                                echo json_encode( array(
                                    'status' => 0,
                                    'msg' => "Yikes! This isn't working"
                                        
                                ) );    
     
                            }
                            else{
                                echo json_encode( array(
                                    'status' => 0,
                                    'msg' => 'ياللهول! هذا لا يعمل'
                                                                        
                                ) );    
                                     
                            }
                        }
                    }
                    else{
                        if($this->language == "1"){
                            echo json_encode( array(
                                'status' => 0,                                    
                                'msg' => 'Whoops, something went wrong :(',
                            ) ); 
                        }
                        else{
                            echo json_encode( array(
                                'status' => 0,                                    
                                'msg' => 'عفوًا، حدث خطأ ما :(',
                            ) ); 
                        }    

                    }

                }
        }
        else{
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,                                    
                    'msg' => "What's the mobile number registered?",
             ) );

            }
            else{
                echo json_encode( array(
                    'status' => 0,                                    
                    'msg' => 'ما هو رقم الهاتف النقال المسجل؟',
               ) );

            }
 
        }

//as
    }               
                     
 }


public function forgetpasswordcheck(){
        $json = array();
        $sql = "select * from usermaster where OTP='".$this->OTP."'";
        //echo $sql;

        $query = $this->db->query( $sql);
        $result= mysqli_fetch_assoc($query);

        $otptime= $result['OTPtime'];
        $date = date('m/d/Y h:i:s a', time());

        if( $result > 0 ) {

            $to_time = strtotime($date);
            $from_time = strtotime($otptime);
            $timeresult=  round(abs($to_time - $from_time) / 60,2);


            if($timeresult < 20.00) {
                $sql2="update usermaster set OTP='', OTPtime='' where userid= '".$result['userid']."'";
                $result2 = $this->db->query($sql2);
                    echo json_encode( array(
                        'status' => 1,                                    
                        'msg' => 'Record Found',
                        'userid'=>$result['userid']
                    ) );
              
            }
            else{

                //$sql2="update usermaster set OTP='', OTPtime='' where userid= '".$result['userid']."'";
                //$result2 = $this->db->query($sql2);
                if($this->language == "1"){
                    echo json_encode( array(
                    'status' => 0,                                    
                    'msg' => "You've timed out, please try again ",
                    'userid'=>''
                    ) );

                }
                else{
                    echo json_encode( array(
                    'status' => 0,                                    
                    'msg' => "لقد نفذ الوقت، يرجى المحاولة مرة أخرى",
                    'userid'=>''
                    ) );

                }
 
                $sql2="update usermaster set OTP='', OTPtime='' where userid= '".$result['userid']."'";
                $result2 = $this->db->query($sql2);

            }
                    
        } 
        else {
              if($this->language == "1"){
                   echo json_encode( array(
                'status' => 0,                                    
                'msg' => 'Please try again; that OTP does not match',
                'userid'=>''
                ) );

                }
                else{
                    echo json_encode( array(
                'status' => 0,                                    
                'msg' => 'يرجى المحاولة مرة أخرى. رمز التحقق غير مطابق',
                'userid'=>''
                ) );

                }
           
        }
          
 }


 public function changepassword(){
       
        $sql = "select * from pwdhistory where userid='".$this->id."' and pwd='".md5($this->password)."' limit 0,12";
     
        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'msg' => "Try a password you haven't used before",
               ) );
 
            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'msg' => "حاول بكلمة مرور لم تستخدمها من قبل",
               ) );
                 
            }
        }
        else{
            $sql = "UPDATE " . $this->table_name . " set `password`='" . md5($this->password) . "' where userid= '".$this->id."' and password='".md5($this->oldpassword)."'";
      
            $query = $this->db->query( $sql );
            if( $this->db->affected_rows > 0 ) {
               $sql = "insert into pwdhistory (pwd,userid)VALUES('" . md5($this->password) . "','" . $this->id . "')";
   
            $query = $this->db->query( $sql );

                if( $this->db->affected_rows > 0 ) {
                    if($this->language == "1"){
                        echo json_encode( array(
                            'status' => 1,
                            'msg' => 'It worked! Password changed succesfully',
                        ) ); 
                     
                    }
                    else{
                        echo json_encode( array(
                            'status' => 1,
                            'msg' => 'مبروك ! تم تغيير كلمة المرور بنجاح',
                        ) ); 
                     
                    }
                }
                else{
                    if($this->language == "1"){
                        echo json_encode( array(
                            'status' => 0,
                            'msg' => 'Whoops, something happened, try again !',
                        ) );
 
                    }
                    else{
                        echo json_encode( array(
                            'status' => 0,
                            'msg' => 'عفوًا ، حدث شيء ما، حاول مرة أخرى!',
                        ) );
 
                    }
                }

            }
            else{
                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => "The old password doesn't match",
                   ) ); 
                }
                else{
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'كلمة المرور القديمة غير متطابقة',
                    ) ); 
                }
                  
            }      

        }
       
  }


 public function update_password(){
        $password="password";
        $userid = openssl_decrypt($this->user,"AES-128-ECB",$password);
    
        $sql = "select * from pwdhistory where userid='".$userid."' and pwd='".md5($this->myPassword)."' limit 0,12";
    
        $query = $this->db->query( $sql );

            if( $this->db->affected_rows > 0 ) {
				 if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'msg' => "Try a password you haven't used before",
              ) );
				 }
				else{
					 echo json_encode( array(
                    'status' => 0,
                    'msg' => "جرب كلمة مرور لم تستخدمها من قبل",
              ) );
				}
            }
            else{
                $sql = "UPDATE " . $this->table_name . " set `password`='" . md5($this->myPassword) . "' where userid= '".$userid."'";
          
                $query = $this->db->query( $sql );

                $sql = "insert into pwdhistory (pwd,userid)VALUES('" . md5($this->myPassword) . "','" . $userid . "')";
   
                $query = $this->db->query( $sql );

                    if( $this->db->affected_rows > 0 ) {
                        if($this->language == "1"){
                            echo json_encode( array(
                                'status' => 1,
                                'msg' => 'It worked! Password changed succesfully',
                            ) ); 
                         
                        }
                        else{
                            echo json_encode( array(
                                'status' => 1,
                                'msg' => 'مبروك ! تم تغيير كلمة المرور بنجاح',
                            ) ); 
                         
                        }
                    }
                    else{
                        if($this->language == "1"){
                            echo json_encode( array(
                                'status' => 0,
                                'msg' => 'Whoops, something happened, try again !',
                            ) );
 
                        }
                        else{
                            echo json_encode( array(
                                'status' => 0,
                                'msg' => 'عفوًا ، حدث شيء ما، حاول مرة أخرى!',
                            ) );
 
                        }
                    }

            }
       
 }

 public function forgetchangepassword(){
      
        $sql = "select * from pwdhistory where userid='".$this->id."' and pwd='".md5($this->password)."' limit 0,12";
     
        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            if($this->language == "1"){
echo json_encode( array(
              'status' => 0,
              'msg' => "Try a password you haven't used before",
            ) );

            }else{
                echo json_encode( array(
              'status' => 0,
              'msg' => "حاول بكلمة مرور لم تستخدمها من قبل",
            ) );
            }
            
        }
        else{
            $sql = "UPDATE usermaster set `password`='" . md5($this->password) . "' where userid= '".$this->id."'";
          
            $query = $this->db->query( $sql );

            $sql = "insert into pwdhistory (pwd,userid)VALUES('" . md5($this->password) . "','" . $this->id . "')";
   
            $query = $this->db->query( $sql );

            if( $this->db->affected_rows > 0 ) {
                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 1,
                        'msg' => 'It worked! Password changed succesfully',
                    ) ); 
                     
                }
                else{
                    echo json_encode( array(
                        'status' => 1,
                        'msg' => 'مبروك ! تم تغيير كلمة المرور بنجاح',
                    ) ); 
                     
                }
            }
            else{
                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'Whoops, something happened, try again !',
                    ) );

                }
                else{
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'عفوًا ، حدث شيء ما، حاول مرة أخرى!',
                    ) );

                }
            }

        }

  }


 public function Version(){
    $currentversion = "1.0";
        if($currentversion == $this->systemversion){
            $version = "Version Matched";
        }
        else{
            $version = "New Version Available";
        }

        echo json_encode(array("v"=>$currentversion,"msg"=>$version,"force"=>FORCE));

}

public function selectById( $id ){

        $sql = "select * from " . $this->table_name . " where id = " . $id;
        $result = $this->db->query($sql);
        // print_r(mysqli_fetch_assoc($result));
        // exit(0);

        // return $result->fetch_all(MYSQLI_ASSOC);
        return mysqli_fetch_assoc($result);
    }

public function makeDatatableQuery( $data ) {

        $sql = "select SQL_CALC_FOUND_ROWS * from " .
            $this->table_name . " cat ";

        if (!empty($data['sSearch'])) {
            $sql .= " AND ( cat.reg_fname LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR ( cat.reg_lname LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR ( cat.reg_email LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR ( cat.reg_phone LIKE '" . $data['sSearch'] . "%' )";
        }
        $sql .= " ORDER BY cat.id DESC ";
        $this->temp = $sql;
        if (isset($data['iDisplayStart']) && $data['iDisplayLength'] != '-1') {
            $sql .= " LIMIT " . $data['iDisplayStart'] . ", " . $data['iDisplayLength'];
        }
        $this->dbtb_query = $sql;
        return $this->db->query( $this->dbtb_query );
 }

 public function getClientsDataTable( $data ) {
        $json = array();
        if( !$this->dbtb_query ) { 
            return; 
        }
        $query = $this->db->query( $this->dbtb_query );

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr'] = $k+1;
            $json[$k]['title'] = $row['title'];
            $json[$k]['price'] = $row['price'];
            $json[$k]['beds'] = $row['beds'];
            $json[$k]['baths'] = $row['baths'];
            $json[$k]['location'] = $row['location'];
            $featured = '';
        if($row['isfeatured']){
            $featured.= '<button type="button" data-id = "'.$row['id'].'"  class="removefeatured btn ink-reaction btn-floating-action btn-xs btn-success" data-toggle="tooltip" data-placement="top"  data-original-title="Edit Images" title="Edit">
                <i class="fa fa-pencil"></i>Featured
            </button>';
        }
        else
        {

            $featured.= '<button type="button" data-id = "'.$row['id'].'"  class="markfeatured btn ink-reaction btn-floating-action btn-xs btn-info" data-toggle="tooltip" data-placement="top"  data-original-title="Edit Images" title="Edit">
                <i class="fa fa-pencil"></i>Mark as Featured
            </button>';
        }
            $showonhome = '';
        if($row['showonslider']){
            $showonhome.= '<button type="button" data-id = "'.$row['id'].'"  class="removehome btn ink-reaction btn-floating-action btn-xs btn-success" data-toggle="tooltip" data-placement="top"  data-original-title="Edit Images" title="Edit">
                <i class="fa fa-pencil"></i>Visible on Home
            </button>';
        }
        else
        {

            $showonhome.= '<button type="button" data-id = "'.$row['id'].'"  class="markhome btn ink-reaction btn-floating-action btn-xs btn-info" data-toggle="tooltip" data-placement="top"  data-original-title="Edit Images" title="Edit">
                <i class="fa fa-pencil"></i>Show on Home
            </button>';
        }
            
            $json[$k]['actions'] = '<button type="button" data-id = "'.$row['id'].'"  class="edit_images btn ink-reaction btn-floating-action btn-xs btn-info" data-toggle="tooltip" data-placement="top"  data-original-title="Edit Images" title="Edit">
                <i class="fa fa-pencil"></i> Edit Images

            </button><button type="button" data-id = "'.$row['id'].'"  class="edit_Clients btn ink-reaction btn-floating-action btn-xs btn-info" data-toggle="tooltip" data-placement="top"  data-original-title="Edit" title="Edit">
        <i class="fa fa-pencil"></i> Edit
      </button>'.$featured.$showonhome.'<button type="button" data-id = "'.$row['id'].'" class="delete_Clients btn ink-reaction btn-floating-action btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete">
              <i class="fa fa-remove"></i> Delete
          </button>';
            $k++;

        }
            return $json;

  }

 public function get_total_noof_records(){

        $sql = $this->temp;

        $query = $this->db->query( $sql );

        return $query->num_rows;
  }

 public function update(){
      

        $sql = "UPDATE " . $this->table_name . " set `emailid`='" . $this->emailid . "',`firstname`='" . $this->firstname . "',`lastname`='" . $this->lastname . "',`dateofbirth`='" . $this->dateofbirth . "',`gsm`='" . $this->gsm . "',`nationality`='" . $this->nationality . "',`gender`='" . $this->gender . "',`notificationtoken`='" . $this->notificationtoken . "',`devicename`='" . $this->devicename . "',`isfacebook`='" . $this->isfacebook . "',`istwitter`='" . $this->istwitter . "',`isgoogle`='" . $this->isgoogle . "',`socialtoken`='" . $this->socialtoken . "',`language`='" . $this->language . "' where userid=" . $this->userid;
        $query = $this->db->query( $sql );
   

        if( $this->db->affected_rows > 0 ) {
            $sql = "select * from " . $this->table_name . "  where userid= '" . $this->userid . "'";

            $query = $this->db->query( $sql );
            $reg_result = mysqli_fetch_assoc($query);

            if (!empty($reg_result)) {

                $data["username"] = $reg_result["username"];
                $data["userid"] = $reg_result["userid"];
                $data["emailid"] = $reg_result["emailid"];
                $data["firstname"] = $reg_result["firstname"];
                $data["lastname"] = $reg_result["lastname"];
                $data["dateofbirth"] = $reg_result["dateofbirth"];
                $data["phonenumber"] = $reg_result["phonenumber"];
                $data["gender"] = $reg_result["gender"];
                $data["notificationtoken"] = $reg_result["notificationtoken"];  
                $data["gsm"] = $reg_result["gsm"];
                $data["nationality"] = $reg_result["nationality"];
                $data["devicename"] = $reg_result["devicename"];
                $data["isfacebook"] = $reg_result["isfacebook"];
                $data["istwitter"] = $reg_result["istwitter"];
                $data["isgoogle"] = $reg_result["isgoogle"];
                $data["allowpush"] = $reg_result["allowpush"];
                $data["receiveemail"] = $reg_result["receiveemail"];
                $data["allowlocation"] = $reg_result["allowlocation"];
                $data["socialtoken"] = $reg_result["socialtoken"];
                $data["language"] = $reg_result["language"];
                $data["myrefcode"] = $reg_result["myrefcode"];

                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 1,
                        'msg' => 'Your profile has been updated!',
                        'userdetails' => $data
                    ) );
                }
                else{
                    echo json_encode( array(
                        'status' => 1,
                        'msg' => ' تم تحديث حسابك!',
                        'userdetails' => $data
                    ) );
                }
                               
            }
        } 
        else {
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'Something went wrong',
                ) );
                 
            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'حدث خطأ ما',
                ) );
             
            }
        }
 }
  
 public function deleteById( $cid ){

        if( !$cid ) { return; }

        $sql = "delete from " . $this->table_name . " where id=" . $cid;

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => 1,
                'msg' => 'Property Deleted Successfully',
            ) );
        } 
        else {
            echo json_encode( array(
                'status' => 0,
                'msg' => 'Property is not deleted or doesn\'t exist in system',
            ) );
        }
 }


  
   
}
?>
