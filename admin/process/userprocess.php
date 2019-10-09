<?php
require_once '../classes/classUsers.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new User($db);
    $json['aaData'] = array();
    $sql = $ClientsObj->makeDatatableQuery($_REQUEST);
    $sql1 = "select FOUND_ROWS()";
    $filteredTotalQry = $db->query($sql1);

    $json['iTotalDisplayRecords'] = $filteredTotalQry->fetch_array()[0];
    $json['aaData'] = $ClientsObj->getClientsDataTable($sql);

    $json['iTotalRecords'] = $ClientsObj->get_total_noof_records();

    $json['sEcho'] = $_REQUEST['sEcho'];

    echo json_encode($json);
}

if($_REQUEST['action'] == 'edit_Clients') {
    
    $ClientsObj = new User( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}

if($_REQUEST['action'] == 'create_user') {
    $UserObj = new User($db);
  
    $UserObj->emailid = !empty($_POST['emailid']) ? $_POST['emailid'] : false;
    $UserObj->firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : false;
    $UserObj->lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : false;
    $UserObj->password = !empty($_POST['password']) ? $_POST['password'] : '123';
    $UserObj->username = !empty($_POST['username']) ? $_POST['username'] : false;
    $UserObj->dateofbirth = !empty($_POST['dateofbirth']) ? $_POST['dateofbirth'] : false;
    $UserObj->notificationtoken = !empty($_POST['notificationtoken']) ? $_POST['notificationtoken'] : false;
    $UserObj->devicename = !empty($_POST['devicename']) ? $_POST['devicename'] : false;
    $UserObj->isfacebook = !empty($_POST['isfacebook']) ? $_POST['isfacebook'] : 0;
    $UserObj->istwitter = !empty($_POST['istwitter']) ? $_POST['istwitter'] : 0;
    $UserObj->issocial = !empty($_POST['issocial']) ? $_POST['issocial'] : 0;
    $UserObj->isgoogle = !empty($_POST['isgoogle']) ? $_POST['isgoogle'] : 0;
    $UserObj->socialtoken = !empty($_POST['socialtoken']) ? $_POST['socialtoken'] : false;
    $UserObj->gsm = !empty($_POST['gsm']) ? $_POST['gsm'] : false;
    $UserObj->referralcode = !empty($_POST['referralcode']) ? $_POST['referralcode'] : false;
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $UserObj->gender = !empty($_POST['gender']) ? $_POST['gender'] : false;
    $UserObj->rememberme = !empty($_POST['rememberme']) ? $_POST['rememberme'] : false;
    $UserObj->nationality = !empty($_POST['nationality']) ? $_POST['nationality'] : false;

    
    $UserObj->create();
   
}
if($_REQUEST['action'] == 'login') {

    $UserObj = new User($db);
    
    $UserObj->username = !empty($_POST['username']) ? $_POST['username'] : false;
    $UserObj->notificationtoken = !empty($_POST['notificationtoken']) ? $_POST['notificationtoken'] : false;
    $UserObj->password = !empty($_POST['password']) ? $_POST['password'] : '123';
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $UserObj->login();
   
}
if($_REQUEST['action'] == 'update_password') {

    $UserObj = new User($db);
    
    $UserObj->user = !empty($_POST['user']) ? $_POST['user'] : false;
    $UserObj->myPassword = !empty($_POST['myPassword']) ? $_POST['myPassword'] : false;
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : 1;
  
    $UserObj->update_password();
   
}
if($_REQUEST['action'] == 'socialtokencheck') {

    $UserObj = new User($db);
    
    $UserObj->socialtoken = !empty($_POST['socialtoken']) ? $_POST['socialtoken'] : false;
    $UserObj->emailid = !empty($_POST['emailid']) ? $_POST['emailid'] : false;
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
     
    
    $UserObj->socialtoken();
   
}
if($_REQUEST['action'] == 'versioncheck') {

    $UserObj = new User($db);

    $UserObj->systemversion = !empty($_POST['systemversion']) ? $_POST['systemversion'] : false;
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $UserObj->Version();
   
}
if($_REQUEST['action'] == 'changepassword') {

    $UserObj = new User($db);

    $UserObj->id = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $UserObj->password = !empty($_POST['password']) ? $_POST['password'] : '123';
    $UserObj->oldpassword = !empty($_POST['oldpassword']) ? $_POST['oldpassword'] : '123';
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $UserObj->changepassword();
   
}
if($_REQUEST['action'] == 'forgetchangepassword') {

    $UserObj = new User($db);

    $UserObj->id = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $UserObj->password = !empty($_POST['password']) ? $_POST['password'] : '123';
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;

    $UserObj->forgetchangepassword();
   
}
if($_REQUEST['action'] == 'forgetpassword') {

    $UserObj = new User($db);
    
    $UserObj->emailid = !empty($_POST['emailid']) ? $_POST['emailid'] : false;
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $UserObj->type = !empty($_POST['type']) ? $_POST['type'] : false;
    $UserObj->username = !empty($_POST['username']) ? $_POST['username'] : false;
    $UserObj->forgetpassword();
   
}

if($_REQUEST['action'] == 'forgetpasswordcheck') {

    $UserObj = new User($db);
    
    $UserObj->OTP = !empty($_POST['OTP']) ? $_POST['OTP'] : false;
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    
    $UserObj->forgetpasswordcheck();
   
}
if($_REQUEST['action'] == 'checkusername') {

    $UserObj = new User($db);
    
    $UserObj->username = !empty($_POST['username']) ? $_POST['username'] : false;
    $UserObj->emailid = !empty($_POST['emailid']) ? $_POST['emailid'] : false;
    $UserObj->phone = !empty($_POST['phone']) ? $_POST['phone'] : false;
    $UserObj->refcode = !empty($_POST['refcode']) ? $_POST['refcode'] : false;
      $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $UserObj->checkusername();
   
}


if($_REQUEST['action'] == 'update_user') {
    
    $UserObj = new User($db);
  
  
    $UserObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $UserObj->emailid = !empty($_POST['emailid']) ? $_POST['emailid'] : false;
    $UserObj->firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : false;
    $UserObj->lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : false;    
    $UserObj->dateofbirth = !empty($_POST['dateofbirth']) ? $_POST['dateofbirth'] : false;
    $UserObj->notificationtoken = !empty($_POST['notificationtoken']) ? $_POST['notificationtoken'] : false;
    $UserObj->devicename = !empty($_POST['devicename']) ? $_POST['devicename'] : false;
    $UserObj->isfacebook = !empty($_POST['isfacebook']) ? $_POST['isfacebook'] : 0;
    $UserObj->istwitter = !empty($_POST['istwitter']) ? $_POST['istwitter'] : 0;
    
    $UserObj->isgoogle = !empty($_POST['isgoogle']) ? $_POST['isgoogle'] : 0;
    $UserObj->socialtoken = !empty($_POST['socialtoken']) ? $_POST['socialtoken'] : false;
    $UserObj->gsm = !empty($_POST['gsm']) ? $_POST['gsm'] : false;
    $UserObj->nationality = !empty($_POST['nationality']) ? $_POST['nationality'] : false;
    $UserObj->gender = !empty($_POST['gender']) ? $_POST['gender'] : false;
    $UserObj->language = !empty($_POST['language']) ? $_POST['language'] : false;


    $UserObj->update();
  
}

?>