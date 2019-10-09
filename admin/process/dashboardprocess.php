<?php
require_once '../classes/classDashboard.php';

error_reporting(0);
ini_set('display_errors', 1);

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
if($_REQUEST['action'] == 'dashboard') {
	
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->dashboard();
    
}

if($_REQUEST['action'] == 'paymentinitiate') {
    
    $trackid = getToken(17);
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $ClientsObj->productid = !empty($_POST['productid']) ? $_POST['productid'] : false;
    $ClientsObj->price = !empty($_POST['price']) ? $_POST['price'] : false;
    $ClientsObj->isoab = !empty($_POST['isoab']) ? $_POST['isoab'] : 0;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->trackid = $trackid;
    $ClientsObj->buynow();
    
}
if($_REQUEST['action'] == 'signupotp') {
    
  
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->mobile = !empty($_POST['mobile']) ? $_POST['mobile'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->signupotp();
    
}
if($_REQUEST['action'] == 'getprofile') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->profileid = !empty($_POST['profileid']) ? $_POST['profileid'] : false;
    $ClientsObj->getprofile();
    
}
if($_REQUEST['action'] == 'checkbalance') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->cardid = !empty($_POST['cardid']) ? $_POST['cardid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->checkbalance();
    
}

if($_REQUEST['action'] == 'giftbycategory') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->category = !empty($_POST['category']) ? $_POST['category'] : false;
    $ClientsObj->filter = !empty($_POST['filter']) ? $_POST['filter'] : false;

    $ClientsObj->giftbycategory();
    
}
if($_REQUEST['action'] == 'getnotification') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->profileid = !empty($_POST['profileid']) ? $_POST['profileid'] : false;
    $ClientsObj->getnotification();    
}
if($_REQUEST['action'] == 'creategiftcard') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->trackid = !empty($_POST['trackid']) ? $_POST['trackid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->creategiftcard();    
}
if($_REQUEST['action'] == 'checktransactionfailed') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->trackid = !empty($_POST['trackid']) ? $_POST['trackid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->checktransactionfailed();    
}
if($_REQUEST['action'] == 'redeemgift') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $ClientsObj->code = !empty($_POST['code']) ? $_POST['code'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->redeemgift();    
}

if($_REQUEST['action'] == 'sharinggiftcard') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->giftcard_number = !empty($_POST['giftcard_number']) ? $_POST['giftcard_number'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->sharinggiftcard();    
}

if($_REQUEST['action'] == 'getgiftreferral') {
    
   $ClientsObj = new Dashboard( $db );
    $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->productid = !empty($_POST['productid']) ? $_POST['productid'] : false;
    
	
$ClientsObj->actualPrice = !empty($_POST['actualprice']) ? $_POST['actualprice'] : false;
    $ClientsObj->pricecurrency = !empty($_POST['pricecurrency']) ? $_POST['pricecurrency'] : false;
    $ClientsObj->campaignId = !empty($_POST['campaign_id']) ? $_POST['campaign_id'] : false;
	
	 
    $ClientsObj->getgiftreferral();    
}

if($_REQUEST['action'] == 'getmyreferrals') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->getmyreferrals();    
}

if($_REQUEST['action'] == 'giftcardpurchased') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->giftcardpurchased();    
}

if($_REQUEST['action'] == 'activategift') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->cardnumber = !empty($_POST['cardnumber']) ? $_POST['cardnumber'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->activategift();    
}

if($_REQUEST['action'] == 'offerbyid') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->offerid = !empty($_POST['offerid']) ? $_POST['offerid'] : false;
    $ClientsObj->lat = !empty($_POST['lat']) ? $_POST['lat'] : false;
    $ClientsObj->long = !empty($_POST['long']) ? $_POST['long'] : false;
    $ClientsObj->offerbyid();
    
}
if($_REQUEST['action'] == 'productbyid') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->productid = !empty($_POST['productid']) ? $_POST['productid'] : false;

    $ClientsObj->productbyid();
    
}


if($_REQUEST['action'] == 'searchby') {
    
    $ClientsObj = new Dashboard( $db );

    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->searchstring = !empty($_POST['searchstring']) ? $_POST['searchstring'] : false;
    $ClientsObj->criteria = !empty($_POST['criteria']) ? $_POST['criteria'] : false;
    
    $ClientsObj->searchby();
    
}
if($_REQUEST['action'] == 'getcode') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->offerid = !empty($_POST['offerid']) ? $_POST['offerid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->profileid = !empty($_POST['profileid']) ? $_POST['profileid'] : false;
    $ClientsObj->getcode();
    
}
if($_REQUEST['action'] == 'allvoucher') {
    
    $ClientsObj = new Dashboard( $db );
        $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false; 
           $ClientsObj->profileid = !empty($_POST['profileid']) ? $_POST['profileid'] : false;
    $ClientsObj->allvoucher();
    
}
if($_REQUEST['action'] == 'redeemcode') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->vouchercode = !empty($_POST['vouchercode']) ? $_POST['vouchercode'] : false;
    $ClientsObj->merchantpin = !empty($_POST['merchantpin']) ? $_POST['merchantpin'] : false;
    $ClientsObj->profileid = !empty($_POST['profileid']) ? $_POST['profileid'] : false;
    $ClientsObj->redeemcode();
    
}
if($_REQUEST['action'] == 'gifted') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->vouchercode = !empty($_POST['vouchercode']) ? $_POST['vouchercode'] : false;
    $ClientsObj->gifted();
    
}

if($_REQUEST['action'] == 'sharedgifts') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
    $ClientsObj->sharedgifts();
    
}

if($_REQUEST['action'] == 'myfavourite') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;

    $ClientsObj->myfavourite();
    
}
if($_REQUEST['action'] == 'contentpages') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->contentpages();
    
}
if($_REQUEST['action'] == 'favouriteselected') {
    
     $ClientsObj = new Dashboard( $db );
     $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
     $ClientsObj->productid = !empty($_POST['productid']) ? $_POST['productid'] : false;
     $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
     $ClientsObj->selected = !empty($_POST['selected']) ? $_POST['selected'] : 0;

     $ClientsObj->favouriteselected();
    
}

if($_REQUEST['action'] == 'createsupport') {
    
     $ClientsObj = new Dashboard( $db );
     
     $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
     $ClientsObj->email = !empty($_POST['email']) ? $_POST['email'] : false;
     $ClientsObj->phonenumber = !empty($_POST['phonenumber']) ? $_POST['phonenumber'] : false;
     $ClientsObj->message = !empty($_POST['message']) ? $_POST['message'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;

    $ClientsObj->createsupport();
    
}

if($_REQUEST['action'] == 'applyoabcard') {
    
     $ClientsObj = new Dashboard( $db );
    
     $ClientsObj->userid = !empty($_POST['userid']) ? $_POST['userid'] : false;
     $ClientsObj->name = !empty($_POST['name']) ? $_POST['name'] : false;
     $ClientsObj->emailid = !empty($_POST['emailid']) ? $_POST['emailid'] : false;
     $ClientsObj->phone = !empty($_POST['phone']) ? $_POST['phone'] : false;
     $ClientsObj->city = !empty($_POST['city']) ? $_POST['city'] : false;
     $ClientsObj->civilid = !empty($_POST['civilid']) ? $_POST['civilid'] : false;
     $ClientsObj->employer = !empty($_POST['employer']) ? $_POST['employer'] : false;
     $ClientsObj->salaryrange = !empty($_POST['salaryrange']) ? $_POST['salaryrange'] : false;
     $ClientsObj->isoabcustomer = !empty($_POST['isoabcustomer']) ? $_POST['isoabcustomer'] : 0;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;

    $ClientsObj->applyoabcard();
    
}




if($_REQUEST['action'] == 'versioncheck') {
	
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->currentversion = !empty($_POST['currentversion']) ? $_POST['currentversion'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    $ClientsObj->versioncheck();
    
}






if($_REQUEST['action'] == 'versioncheckandroid') {
	
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->currentversion = !empty($_REQUEST['currentversion']) ? $_REQUEST['currentversion'] : false;
    $ClientsObj->language = !empty($_REQUEST['language']) ? $_REQUEST['language'] : false;
    $ClientsObj->versioncheckandroid();
    
}





?>