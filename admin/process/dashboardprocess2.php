<?php
require_once '../classes/classDashboard.php';

error_reporting(0);
ini_set('display_errors', 1);


if($_REQUEST['action'] == 'dashboard') {
	
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
       $ClientsObj->lat = !empty($_POST['lat']) ? $_POST['lat'] : false;
            $ClientsObj->long = !empty($_POST['long']) ? $_POST['long'] : false;
    $ClientsObj->dashboard();
    
}
if($_REQUEST['action'] == 'offerbycategory') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->category = !empty($_POST['category']) ? $_POST['category'] : false;
    $ClientsObj->filter = !empty($_POST['filter']) ? $_POST['filter'] : false;
        $ClientsObj->lat = !empty($_POST['lat']) ? $_POST['lat'] : false;
            $ClientsObj->long = !empty($_POST['long']) ? $_POST['long'] : false;
    $ClientsObj->offerbycategory();
    
}
if($_REQUEST['action'] == 'getnotification') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->getnotification();
    
}
if($_REQUEST['action'] == 'offerbyid') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
     $ClientsObj->offerid = !empty($_POST['offerid']) ? $_POST['offerid'] : false;
   $ClientsObj->lat = !empty($_POST['lat']) ? $_POST['lat'] : false;
            $ClientsObj->long = !empty($_POST['long']) ? $_POST['long'] : false;
    $ClientsObj->offerbyid();
    
}
if($_REQUEST['action'] == 'searchby') {
    
    $ClientsObj = new Dashboard( $db );

    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->searchstring = !empty($_POST['searchstring']) ? $_POST['searchstring'] : false;
       $ClientsObj->lat = !empty($_POST['lat']) ? $_POST['lat'] : false;
            $ClientsObj->long = !empty($_POST['long']) ? $_POST['long'] : false;
    $ClientsObj->searchby();
    
}
if($_REQUEST['action'] == 'getcode') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->offerid = !empty($_POST['offerid']) ? $_POST['offerid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->emailid = !empty($_POST['emailid']) ? $_POST['emailid'] : false;
    
    $ClientsObj->name = !empty($_POST['name']) ? $_POST['name'] : false;
    $ClientsObj->phone = !empty($_POST['phone']) ? $_POST['phone'] : false;
    $ClientsObj->getcode();
    
}
if($_REQUEST['action'] == 'allvoucher') {
    
    $ClientsObj = new Dashboard( $db );
     $ClientsObj->emailid = !empty($_POST['emailid']) ? $_POST['emailid'] : false;
        $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->name = !empty($_POST['name']) ? $_POST['name'] : false;
    $ClientsObj->phone = !empty($_POST['phone']) ? $_POST['phone'] : false;
    $ClientsObj->allvoucher();
    
}
if($_REQUEST['action'] == 'redeemcode') {
    
    $ClientsObj = new Dashboard( $db );
        $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->vouchercode = !empty($_POST['vouchercode']) ? $_POST['vouchercode'] : false;
    $ClientsObj->merchantpin = !empty($_POST['merchantpin']) ? $_POST['merchantpin'] : false;
    $ClientsObj->redeemcode();
    
}
if($_REQUEST['action'] == 'gifted') {
    
    $ClientsObj = new Dashboard( $db );
        $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->vouchercode = !empty($_POST['vouchercode']) ? $_POST['vouchercode'] : false;
    $ClientsObj->gifted();
    
}
if($_REQUEST['action'] == 'myfavourite') {
    
    $ClientsObj = new Dashboard( $db );
        $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;

    $ClientsObj->myfavourite();
    
}

if($_REQUEST['action'] == 'favouriteselected') {
    
    $ClientsObj = new Dashboard( $db );
        $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
     $ClientsObj->offerid = !empty($_POST['offerid']) ? $_POST['offerid'] : false;
     $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
     $ClientsObj->selected = !empty($_POST['selected']) ? $_POST['selected'] : 0;

    $ClientsObj->favouriteselected();
    
}


?>