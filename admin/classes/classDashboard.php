<?php
require_once 'classDatabase.php'; 
set_include_path(get_include_path() . PATH_SEPARATOR . 'classes/');

class Dashboard {
    private $db;
    private $table_name = "Dashboard";
    public $id;
   
    function __construct($db) {
        # code...
        $this->db = $db;
    }

    function __destruct() {
        $this->db->close();
    }
    


 public function searchby() {
        
        $json = array();
	 
	 $language = $this->language;
	 if($language==1)
	 {
		 
		   
		 $sql = "select p.*,ac.image as categoryimage from product p inner join appcategory ac on ac.id=p.categoryid where p.isactive='1' and (p.cardname like '%".$this->searchstring."%' or  p.brandname like '%".$this->searchstring."%' or p.actualprice like '%".$this->searchstring."%' or p.discount like '%".$this->searchstring."%'    )"; 
     
	 }
	 else{

		  $searchstring =urldecode($this->searchstring);

		   $sql = "select p.*,ac.image as categoryimage from product p inner join appcategory ac on ac.id=p.categoryid where p.isactive='1' and (p.cardnamearabic like '%".$searchstring."%')";
		
	 }
	 
	 
	
        
        $sql.=" group by p.id";
        $query = $this->db->query( $sql);
        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['id'] = $row['id'];
            if($this->language == "1"){
                $json[$k]['cardname'] = $row['cardname']; 
                $json[$k]['termscondition'] = $row['termscondition'];                             
            }
            else{
                $json[$k]['cardname'] = $row['cardnamearabic'];
                $json[$k]['termscondition'] = $row['termsconditionarabic'];
            }                       
            $json[$k]['brandname'] = $row['brandname'];    
            $json[$k]['pricefornonoab'] = $row['pricefornonoab'];      
            $json[$k]['priceforoab'] = $row['priceforoab'];
            $json[$k]['actualprice'] = $row['actualprice'];
            $json[$k]['pricecurrency'] = $row['pricecurrency'];
            $json[$k]['discount'] = $row['discount'];
            $json[$k]['campaign_id'] = $row['campaign_id'];
            $json[$k]['campaign_name'] = $row['campaign_name'];
            $json[$k]['image'] = "http://doodle.meritincentives.com/img/product/".$row['image'];
            $json[$k]['categoryimage'] = "http://doodle.meritincentives.com/img/appcategory/".$row['categoryimage'];
            $k++;

        }
        if($k >0){
            echo json_encode( array(
                'status' => 1,
                'count' => $k,
                'msg' => "Here is All offer",
                'offercontent' => $json
            ));
        }
        else
        {
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "This isn't available",
                    'offercontent' => $json
                                                       
                ));
            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "عذرا، هذا غير متوفر",
                    'offercontent' => $json
                                                       
                ));
            }  
        }
         
    }


 public function checktransactionfailed(){
        $sql1 = "select errorcode from paymenthistory where trackid='".$this->trackid."'";
               
        $result1 = $this->db->query($sql1);
        $result1 = mysqli_fetch_assoc($result1);
        $errcode= $result1["errorcode"];
            if(strlen($errcode) < 12)
            {
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'Authentication Error',
                ) );                  
            }
            else{
                $ercode = mb_substr($errcode, 0, 11);
                  
                switch ($ercode) {
                    case "IPAY0100114":
                    $msg = "Duplicate Record If transaction ID already exist for another transactionid";
                    break;
                    case "IPAY0100115":
                    $msg = "Transaction denied due to missing original transaction id.";
                    break;
                    case "IPAY0100116":
                    $msg = "Transaction denied due to invalid original transaction id.";
                    break;
                    case "IPAY0100118":
                    $msg = "Transaction denied due to card number length error";
                    break;
                    case "IPAY0100119":
                    $msg = "Transaction denied due to invalid card number";
                    break;
                    case "IPAY0100120":
                    $msg = "Transaction denied due to invalid payment instrument for brand data.";
                    break;
                    case "IPAY0100121":
                    $msg = "Transaction denied due to invalid card holder name.";
                    break;
                    case "IPAY0100122":
                    $msg = "Transaction denied due to invalid address.";
                    break;
                    case "IPAY0100123":
                    $msg = "Transaction denied due to invalid postal code.";
                    break;
                    case "IPAY0100124":
                    $msg = "Problem occurred while validating transaction data";
                    break;
                    case "IPAY0100125":
                    $msg = "Payment instrument not enabled.";
                    break;
                    case "IPAY0100126":
                    $msg = "Brand not enabled.";
                    break;
                    case "IPAY0100127":
                    $msg = "Problem occurred while doing validate original transaction";
                    break;
                    case "IPAY0100128":
                    $msg = "Transaction denied due to Institution ID mismatch";
                    break;
                    case "IPAY0100129":
                    $msg = "Transaction denied due to Merchant ID mismatch";
                    break;
                    case "IPAY0100130":
                    $msg = "Transaction denied due to Terminal ID mismatch";
                    break;
                    case "IPAY0100131":
                    $msg = "Transaction denied due to Payment Instrument mismatch";
                    break;
                    case "IPAY0100132":
                    $msg = "Transaction denied due to Currency Code mismatch";
                    break;
                    case "IPAY0100133":
                    $msg = "Transaction denied due to Card Number mismatch";
                    break;
                    case "IPAY0100134":
                    $msg = "Transaction denied due to invalid Result Code";
                    break;
                    case "IPAY0100135":
                    $msg = "Problem occurred while doing perform action code reference id (ValidateOriginal Transaction)";
                    break;
                    case "IPAY0200028":
                    $msg = "Problem   occurred   while   loading   default   institution   configuration(Validate Original Transaction)";
                    break;
                    case "IPAY0100136":
                    $msg = "Transaction denied due to previous capture check failure ( ValidateOriginal Transaction )";
                    break;
                    case "IPAY0100138":
                    $msg = "Transaction denied due to capture amount versus auth amount checkfailure (Validate Original Transaction)";
                    break;
                    case "IPAY0100139":
                    $msg = "Transaction denied due to void amount versus original amount checkfailure (Validate Original Transaction)";
                    break;
                    case "IPAY0100140":
                    $msg = "Transaction denied due to previous void check failure (Validate OriginalTransaction)";
                    break;
                    case "IPAY0100141":
                    $msg = "Transaction denied due to authorization already captured (ValidateOriginal Transaction)";
                    break;
                    case "IPAY0100142":
                    $msg = "Problem occurred while validating original transaction";
                    break;
                    case "IPAY0200030":
                    $msg = "No external connection details for Extr Conn id :";
                    break;
                    case "IPAY0200031":
                    $msg = "Alternate external connection details not found for the alt Extr Conn id :";
                    break;
                    case "IPAY0100143":
                    $msg = "Transaction action is null";
                    break;
                    case "IPAY0100144":
                    $msg = "ISO MSG is null. See log for more details!";
                    break;
                    case "IPAY0100145":
                    $msg = "Problem occurred while loading default messages in ISO Formatter";
                    break;
                    case "IPAY0100147":
                    $msg = "Problem occurred while formatting purchase request in B24 ISO MessageFormatter";
                    break;
                    case "IPAY0100150":
                    $msg = "Problem occurred while formatting Reverse purchase request in B24 ISOMessage Formatter";
                    break;
                    case "IPAY0100152":
                    $msg = "Problem occurred while formatting authorization request in B24 ISO Message Formatter";
                    break;
                    case "IPAY0100153":
                    $msg = "Problem occurred while formatting Capture request in B24 ISO Message Formatter";
                    break;
                    case "IPAY0100155":
                    $msg = "Problem occurred while formatting reverse authorization request in B24ISO Message Formatter";
                    break;
                    case "IPAY0100156":
                    $msg = "Problem occurred while formatting Reverse Capture request in B24 ISOMessage Formatter";
                    break;
                    case "IPAY0100159":
                    $msg = "External message system error";
                    break;
                    case "IPAY0100160":
                    $msg = "Unable to process the transaction.";
                    break;
                    case "IPAY0100163":
                    $msg = "Problem occurred during transaction.";
                    break;
                    case "IPAY0100166":
                    $msg = "Transaction Not Processed due to Empty Authentication Status";
                    break;
                    case "IPAY0100167":
                    $msg = "Transaction Not Processed due to Invalid Authentication Status";
                    break;
                    case "IPAY0100168":
                    $msg = "Transaction Not Processed due to Empty Enrollment Status";
                    break;
                    case "IPAY0100169":
                    $msg = "Transaction Not Processed due to Invalid Enrollment Status";
                    break;
                    case "IPAY0100170":
                    $msg = "Transaction Not Processed due to invalid CAVV";
                    break;
                    case "IPAY0100171":
                    $msg = "Transaction Not Processed due to Empty CAVV";
                    break;
                    case "IPAY0100172":
                    $msg = "Problem occurred while converting amount.";
                    break;
                    case "IPAY0100173":
                    $msg = "Problem occurred while building refund request.";
                    break;
                    case "IPAY0100175":
                    $msg = "Problem occurred in refund process.";
                    break;
                    case "IPAY0100017":
                    $msg = "Inactive terminal.";
                    break;
                    case "IPAY0100019":
                    $msg = "Invalid log in attempt.";
                    break;
                    case "IPAY0100001":
                    $msg = "Missing error URL.";
                    break;
                    case "IPAY0100002":
                    $msg = "Invalid error URL.";
                    break;
                    case "IPAY0100003":
                    $msg = "Missing response URL.";
                    break;
                    case "IPAY0100004":
                    $msg = "Invalid response URL.";
                    break;
                    case "IPAY0100005":
                    $msg = "Missing tranportal id.";
                    break;
                    case "IPAY0100006":
                    $msg = "Invalid tranportal ID.";
                    break;
                    case "IPAY0100007":
                    $msg = "Missing transaction data.";
                    break;
                    case "IPAY0100008":
                    $msg = "Terminal not enabled.";
                    break;
                    case "IPAY0200001":
                    $msg = "Problem occurred while getting terminal.";
                    break;
                    case "IPAY0100009":
                    $msg = "Institution not enabled.";
                    break;
                    case "IPAY0200002":
                    $msg = "Problem occurred while getting institution details.";
                    break;
                    case "IPAY0100010":
                    $msg = "Institution has not enabled for the encryption process.";
                    break;
                    case "IPAY0200003":
                    $msg = "Problem occurred while getting merchant details.";
                    break;
                    case "IPAY0100011":
                    $msg = "Merchant has not enabled for encryption process.";
                    break;
                    case "IPAY0100012":
                    $msg = "Empty terminal key.";
                    break;
                    case "IPAY0100013":
                    $msg = "Invalid transaction data.";
                    break;
                    case "IPAY0100014":
                    $msg = "Terminal Authentication requested with invalid tranportal ID data.";
                    break;
                    case "IPAY0100015":
                    $msg = "Invalid tranportal password.";
                    break;
                    case "IPAY0100016":
                    $msg = "Password security not enabled.";
                    break;
                    case "IPAY0200004":
                    $msg = "Problem occurred while getting password security rules.";
                    break;
                    case "IPAY0200005":
                    $msg = "Problem occurred while updating terminal details.";
                    break;
                    case "IPAY0100018":
                    $msg = "Terminal password expired.";
                    break;
                    case "IPAY0200006":
                    $msg = "Problem occurred while verifying tranportal password.";
                    break;
                    case "IPAY0100020":
                    $msg = "Invalid action type.";
                    break;
                    case "IPAY0100022":
                    $msg = "Invalid currency.";
                    break;
                    case "IPAY0100023":
                    $msg = "Missing amount.";
                    break;
                    case "IPAY0100025":
                    $msg = "Invalid amount or currency.";
                    break;
                    case "IPAY0100026":
                    $msg = "Invalid language id";
                    break;
                    case "IPAY0100028":
                    $msg = "Invalid user defined field1.";
                    break;
                    case "IPAY0100029":
                    $msg = "Invalid user defined field2.";
                    break;
                    case "IPAY0100031":
                    $msg = "Invalid user defined field4.";
                    break;
                    case "IPAY0100032":
                    $msg = "Invalid user defined field5.";
                    break;
                    case "IPAY0100033":
                    $msg = "Terminal action not enabled.";
                    break;
                    case "IPAY0100034":
                    $msg = "Currency code not enabled.";
                    break;
                    case "IPAY0100035":
                    $msg = "Problem occurred during merchant hashing process.";
                    break;
                    case "IPAY0100036":
                    $msg = "UDF Mismatched";
                    break;
                    case "IPAY0100038":
                    $msg = "Unable to process the request.";
                    break;
                    case "IPAY0100039":
                    $msg = "Invalid payment id .";
                    break;
                    case "IPAY0200009":
                    $msg = "Problem occurred while getting payment details.";
                    break;
                    case "IPAY0100041":
                    $msg = "Payment details missing.";
                    break;
                    case "IPAY0100042":
                    $msg = "Transaction time limit exceeds.";
                    break;
                    case "IPAY0200011":
                    $msg = "Problem occurred while getting IP block details.";
                    break;
                    case "IPAY0100043":
                    $msg = "IP address is blocked already";
                    break;
                    case "IPAY0100044":
                    $msg = "Problem occurred while loading payment page.";
                    break;
                    case "IPAY0100045":
                    $msg = "Denied by Risk";
                    break;
                    case "IPAY0200013":
                    $msg = "Problem occurred while updating description details in payment log.";
                    break;
                    case "IPAY0100047":
                    $msg = "Payment Page validation failed due to invalid Order Status:";
                    break;
                    case "IPAY0100049":
                    $msg = "Transaction declined due to exceeding OTP attempts";
                    break;
                    case "IPAY0200015":
                    $msg = "Problem occurred while getting terminal details.";
                    break;
                    case "IPAY0100050":
                    $msg = "Invalid terminal key.";
                    break;
                    case "IPAY0100051":
                    $msg = "Missing terminal key.";
                    break;
                    case "IPAY0100053":
                    $msg = "Problem occurred while processing direct debit.";
                    break;
                    case "IPAY0100054":
                    $msg = "Payment details not available";
                    break;
                    case "IPAY0100056":
                    $msg = "Instrument not allowed in Terminal and Brand";
                    break;
                    case "IPAY0200016":
                    $msg = "Problem occurred while getting payment instrument.";
                    break;
                    case "IPAY0200018":
                    $msg = "Problem occurred while getting transaction details";
                    break;
                    case "IPAY0100057":
                    $msg = "Transaction denied due to invalid processing option action code";
                    break;
                    case "IPAY0100058":
                    $msg = "Transaction denied due to invalid instrument";
                    break;
                    case "IPAY0100059":
                    $msg = "Transaction denied due to invalid currency code.";
                    break;
                    case "IPAY0100060":
                    $msg = "Transaction denied due to missing amount.";
                    break;
                    case "IPAY0100061":
                    $msg = "Transaction denied due to invalid amount.";
                    break;
                    case "IPAY0100062":
                    $msg = "Transaction denied due to invalid Amount/Currency.";
                    break;
                    case "IPAY0100063":
                    $msg = "Transaction denied due to invalid track ID";
                    break;
                    case "IPAY0100064":
                    $msg = "Transaction denied due to invalid UDF1:";
                    break;
                    case "IPAY0100065":
                    $msg = "Transaction denied due to invalid UDF2:";
                    break;
                    case "IPAY0100066":
                    $msg = "Transaction denied due to invalid UDF3:";
                    break;
                    case "IPAY0100067":
                    $msg = "Transaction denied due to invalid UDF4:";
                    break;
                    case "IPAY0100068":
                    $msg = "Transaction denied due to invalid UDF5:";
                    break;
                    case "IPAY0100069":
                    $msg = "Missing payment instrument.";
                    break;
                    case "IPAY0100070":
                    $msg = "Transaction denied due to failed card check digit calculation.";
                    break;
                    case "IPAY0100071":
                    $msg = "Transaction denied due to missing CVD2.";
                    break;
                    case "IPAY0100072":
                    $msg = "Transaction denied due to invalid CVD2.";
                    break;
                    case "IPAY0100073":
                    $msg = "Transaction denied due to invalid CVV.";
                    break;
                    case "IPAY0100074":
                    $msg = "Transaction denied due to missing expiry year.";
                    break;
                    case "IPAY0100075":
                    $msg = "Transaction denied due to invalid expiry year.";
                    break;
                    case "IPAY0100076":
                    $msg = "Transaction denied due to missing expiry month.";
                    break;
                    case "IPAY0100077":
                    $msg = "Transaction denied due to invalid expiry month.";
                    break;
                    case "IPAY0100078":
                    $msg = "Transaction denied due to missing expiry day.";
                    break;
                    case "IPAY0100079":
                    $msg = "Transaction denied due to invalid expiry day.";
                    break;
                    case "IPAY0100080":
                    $msg = "Transaction denied due to expiration date.";
                    break;
                    case "IPAY0100081":
                    $msg = "Card holder name is not present";
                    break;
                    case "IPAY0100082":
                    $msg = "Card address is not present";
                    break;
                    case "IPAY0100083":
                    $msg = "Card postal code is not present";
                    break;
                    case "IPAY0100086":
                    $msg = "Transaction denied due to missing CVV.";
                    break;
                    case "IPAY0100092":
                    $msg = "Empty OTP number.";
                    break;
                    case "IPAY0100093":
                    $msg = "Invalid OTP number.";
                    break;
                    case "IPAY0100095":
                    $msg = "Terminal inactive.";
                    break;
                    case "IPAY0100098":
                    $msg = "Terminal   Action   not   enabled   for   Transaction   request,   Terminal 'termid' ,Tran Action : 'action'";
                    break;
                    case "IPAY0100099":
                    $msg = "Terminal   Payment   Instrument   not   enabled   for   Transaction   request,Terminal 'termid ' , Tran Instrument :'PAYMENT_INSTRUMENT'";
                    break;
                    case "IPAY0100100":
                    $msg = "Problem occurred while authorize";
                    break;
                    case "IPAY0200019":
                    $msg = "Problem occurred while getting risk profile details";
                    break;
                    case "IPAY0100102":
                    $msg = "Denied by risk : Maximum Floor Limit Check - Fail";
                    break;
                    case "IPAY0100103":
                    $msg = "Transaction denied due to Risk : Maximum transaction count";
                    break;
                    case "IPAY0100104":
                    $msg = "Transaction denied due to Risk : Maximum processing amount";
                    break;
                    case "IPAY0200022":
                    $msg = "Problem occurred while getting currency.";
                    break;
                    case "IPAY0100106":
                    $msg = "Invalid payment instrument";
                    break;
                    case "IPAY0200024":
                    $msg = "Problem occurred while getting brand rules details.";
                    break;
                    case "IPAY0100107":
                    $msg = "Instrument not enabled.";
                    break;
                    case "IPAY0200025":
                    $msg = "Problem occurred while getting terminal details.";
                    break;
                    case "IPAY0100109":
                    $msg = "Invalid subsequent transaction, payment id is null or empty.";
                    break;
                    case "IPAY0200026":
                    $msg = "Problem occurred while getting transaction log details.";
                    break;
                    case "IPAY0200027":
                    $msg = "Missing encrypted card number.";
                    break;
                    case "IPAY0100111":
                    $msg = "Card decryption failed.";
                    break;
                    case "IPAY0100113":
                    $msg = "'transaction id' is a subsequent transaction, but original transaction id isinvalid :";
                    break;
                    case "IPAY0100021":
                    $msg = "Missing currency.";
                    break;
                    case "IPAY0100024":
                    $msg = "Invalid amount.";
                    break;
                    case "IPAY0100027":
                    $msg = "Invalid track id.";
                    break;
                    case "IPAY0100030":
                    $msg = "Invalid user defined field3.";
                    break;
                    case "IPAY0200007":
                    $msg = "Problem occurred while validating payment details";
                    break;
                    case "IPAY0200008":
                    $msg = "Problem occurred while verifying payment details.";
                    break;
                    case "IPAY0100037":
                    $msg = "Payment id missing.";
                    break;
                    case "IPAY0100040":
                    $msg = "Transaction in progress in another tab/window.";
                    break;
                    case "IPAY0200010":
                    $msg = "Problem occurred while updating payment details.";
                    break;
                    case "IPAY0200012":
                    $msg = "Problem occurred while updating payment log IP details.";
                    break;
                    case "IPAY0100046":
                    $msg = "Payment option not enabled.";
                    break;
                    case "IPAY0100048":
                    $msg = "Cancelled";
                    break;
                    case "IPAY0200014":
                    $msg = "Problem occurred during merchant response.";
                    break;
                    case "IPAY0100052":
                    $msg = "Problem occurred during merchant response encryption.";
                    break;
                    case "IPAY0100055":
                    $msg = "Invalid Payment Status";
                    break;
                    case "IPAY0200017":
                    $msg = "Problem occurred while getting payment instrument list";
                    break;
                    case "IPAY0100094":
                    $msg = "Sorry, this instrument is not handled";
                    break;
                    case "IPAY0100101":
                    $msg = "Denied by risk : Risk Profile does not exist";
                    break;
                    case "IPAY0200020":
                    $msg = "Problem occurred while performing transaction risk check";
                    break;
                    case "IPAY0200021":
                    $msg = "Problem occurred while performing risk check";
                    break;
                    case "IPAY0200023":
                    $msg = "Problem occurred while determining payment instrument";
                    break;
                    case "IPAY0100108":
                    $msg = "Perform risk check : Failed";
                    break;
                    case "IPAY0100110":
                    $msg = "Invalid subsequent transaction, Tran Ref id  is null or empty.";
                    break;
                    case "IPAY0100112":
                    $msg = "Problem   occurred   in   method   loading   original   transaction   data(cardnumber, exp month / year) for orig_tran_id";
                    break;
                    case "IPAY0100117":
                    $msg = "Transaction denied due to missing card number.";
                    break;
                    case "IPAY0100137":
                    $msg = "Transaction denied due to refund amount greater than auth amountcheck failure ( Validate Original Transaction )";
                    break;
                    case "IPAY0200029":
                    $msg = "Problem occurred while getting external connection details.";
                    break;
                    case "IPAY0200032":
                    $msg = "Problem occurred while getting external connection details for ExtrCConn id :";
                    break;
                    case "IPAY0100151":
                    $msg = "Problem occurred while formatting Refund request in B24 ISO Message Formatter";
                    break;
                    case "IPAY0100154":
                    $msg = "Problem occurred while formatting Reverse Refund request in B24 ISO Message Formatter";
                    break;
                    case "IPAY0100158":
                    $msg = "Host (SWITCH) timeout";
                    break;
                    case "IPAY0100161":
                    $msg = "Merchant is not allowed for encryption process.";
                    break;
                    case "IPAY0100176":
                    $msg = "Decrypting transaction data failed.";
                    break;
                    case "IPAY0100177":
                    $msg = "Invalid input data received.";
                    break;
                    case "IPAY0100178":
                    $msg = "Merchant encryption enabled.";
                    break;
                    case "IPAY0100179":
                    $msg = "IVR not enabled.";
                    break;
                    case "IPAY0100180":
                    $msg = "Authentication not available.";
                    break;
                    case "IPAY0100181":
                    $msg = "Card encryption failed.";
                    break;
                    case "IPAY0200037":
                    $msg = "Error occurred while getting Merchant ID";
                    break;
                    case "IPAY0100186":
                    $msg = "Encryption enabled.";
                    break;
                    case "IPAY0100189":
                    $msg = "Transaction denied due to brand directory unavailable";
                    break;
                    case "IPAY0100190":
                    $msg = "Transaction denied due to Risk : Maximum transaction count";
                    break;
                    case "IPAY0100191":
                    $msg = "Denied by risk : Negative Card check - Fail";
                    break;
                    case "IPAY0100192":
                    $msg = "Transaction Not Processed due to Empty XID";
                    break;
                    case "IPAY0100193":
                    $msg = "Transaction Not Processed due to invalid XID";
                    break;
                    case "IPAY0100202":
                    $msg = "Error occurred in Determine Payment Instrument";
                    break;
                    case "IPAY0100194":
                    $msg = "Transaction   denied   due   to   Risk   :   Minimum   Transaction   Amount processing";
                    break;
                    case "IPAY0100195":
                    $msg = "Transaction denied due to Risk : Maximum refund processing amount";
                    break;
                    case "IPAY0100196":
                    $msg = "Transaction denied due to Risk : Maximum processing amount";
                    break;
                    case "IPAY0100197":
                    $msg = "Transaction denied due to Risk : Maximum debit amount";
                    break;
                    case "IPAY0100198":
                    $msg = "Transaction denied due to Risk : Transaction count limit exceeded for the IP";
                    break;
                    case "IPAY0100199":
                    $msg = "Transaction denied due to previous refundcheck failure ( Validate Original Transaction )";
                    break;
                    case "IPAY0100200":
                    $msg = "Denied by risk : Negative BIN check - Fail";
                    break;
                    case "IPAY0100201":
                    $msg = "Denied by risk : Declined Card check – Fail";
                    break;
                    case "IPAY0100203":
                    $msg = "Problem occurred while doing perform transaction";
                    break;
                    case "IPAY0100204":
                    $msg = "Missing payment details";
                    break;
                    case "IPAY0100206":
                    $msg = "Problem occurred while getting currency minor digits";
                    break;
                    case "IPAY0100207":
                    $msg = "Bin range not enabled";
                    break;
                    case "IPAY0100208":
                    $msg = "Action not enabled";
                    break;
                    case "IPAY0100209":
                    $msg = "Institution config not enabled";
                    break;
                    case "IPAY0100213":
                    $msg = "Problem occurred while processing the hosted transaction request";
                    break;
                    case "IPAY0100214":
                    $msg = "Problem occurred while verifying tranportal id";
                    break;
                    case "IPAY0100215":
                    $msg = "Invalid tranportal id";
                    break;
                    case "IPAY0100216":
                    $msg = "Invalid data received";
                    break;
                    case "IPAY0100217":
                    $msg = "Invalid payment detail";
                    break;
                    case "IPAY0100218":
                    $msg = "Invalid brand id";
                    break;
                    case "IPAY0100219":
                    $msg = "Missing card number";
                    break;
                    case "IPAY0100220":
                    $msg = "Invalid card number";
                    break;
                    case "IPAY0100221":
                    $msg = "Missing card holder name";
                    break;
                    case "IPAY0100222":
                    $msg = "Invalid card holder name";
                    break;
                    case "IPAY0100223":
                    $msg = "Missing cvv";
                    break;
                    case "IPAY0100224":
                    $msg = "Invalid cvv";
                    break;
                    case "IPAY0100225":
                    $msg = "Missing card expiry year";
                    break;
                    case "IPAY0100226":
                    $msg = "Invalid card expiry year";
                    break;
                    case "IPAY0100227":
                    $msg = "Missing card expiry month";
                    break;
                    case "IPAY0100228":
                    $msg = "Invalid card expiry month";
                    break;
                    case "IPAY0100229":
                    $msg = "Invalid card expiry day";
                    break;
                    case "IPAY0100230":
                    $msg = "Card expired";
                    break;
                    case "IPAY0100231":
                    $msg = "Invalid user defined field";
                    break;
                    case "IPAY0100232":
                    $msg = "Missing original transaction id";
                    break;
                    case "IPAY0100233":
                    $msg = "Invalid original transaction id";
                    break;
                    case "IPAY0100234":
                    $msg = "Problem occurred while formatting Reverse completion request in ISO Message Formatter";
                    break;
                    case "IPAY0100235":
                    $msg = "Problem   occurred   while   formatting   Reverse   refund   request   in   ISO Message Formatter";
                    break;
                    case "IPAY0100236":
                    $msg = "Problem   occurred   while   formatting   Reverse   refund   request   in   ISO Message Formatter";
                    break;
                    case "IPAY0100237":
                    $msg = "Problem occurred while formatting Reverse purchase request in ISO Message Formatter";
                    break;
                    case "IPAY0100238":
                    $msg = "Problem occurred while formatting Capture request in ISO Message Formatter";
                    break;
                    case "IPAY0100239":
                    $msg = "Problem occurred while formatting authorization request in ISO Message Formatter";
                    break;
                    case "IPAY0100240":
                    $msg = "Problem occurred while formatting refund request in ISO Message Formatter";
                    break;
                    case "IPAY0100241":
                    $msg = "Problem occurred while formatting purchase request in ISO Message Formatter";
                    break;
                    case "IPAY0100243":
                    $msg = "NOT SUPPORTED";
                    break;
                    case "IPAY0100244":
                    $msg = "Payment Instrument Not Configured";
                    break;
                    case "IPAY0100245":
                    $msg = "Problem occurred while sending/receiving ISO message";
                    break;
                    case "IPAY0100246":
                    $msg = "Problem occurred while doing perform ip risk check";
                    break;
                    case "IPAY0100249":
                    $msg = "Merchant response url is down";
                    break;
                    case "IPAY0100250":
                    $msg = "Payment details verification failed";
                    break;
                    case "IPAY0100251":
                    $msg = "Invalid payment data";
                    break;
                    case "IPAY0100253":
                    $msg = "Problem occurred while cancelling the transaction";
                    break;
                    case "IPAY0100254":
                    $msg = "Merchant not enabled";
                    break;
                    case "IPAY0100255":
                    $msg = "External connection not enabled";
                    break;
                    case "IPAY0100256":
                    $msg = "Payment encryption failed";
                    break;
                    case "IPAY0100257":
                    $msg = "Brand rules not enabled";
                    break;
                    case "IPAY0100260":
                    $msg = "Payment option(s) not enabled";
                    break;
                    default:
                    $msg = $errcode;
                }
            }
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => $msg,
                        ) );

                    
 }
    
 public function updatetransaction() {
            $sql = "update paymenthistory set transactionstatus='".$this->transactionstatus."',transactionid='".$this->transactionid."',paymentid='".$this->paymentid."', errorcode='".$this->errorcode."' where trackid='".$this->transactionrefid."'";
         
            $query = $this->db->query( $sql );
            if( $this->db->affected_rows > 0 ) {
                if($this->language == "1"){
                    return json_encode( array(
                        'status' => 1,
                        'msg' => 'Yay! This is done!'
                    ) );

                }
                else{
                    return json_encode( array(
                        'status' => 1,
                        'msg' => 'لقد تمت العملية بنجاح!'
                    ) );

                }
 
            }else{
                if($this->language == "1"){
                    return json_encode( array(
                        'status' => 0,
                        'msg' => 'Something went wrong with this'
                    ) );
 
                }
                else{
                    return json_encode( array(
                        'status' => 0,
                        'msg' => 'حدث خطأ ما '
                    ) );
         
                }
            }
               
  }
    
 public function buynow() {
        $randomno = substr(number_format(time() * rand(),0,'',''),0,10);
        $sql = "insert into paymenthistory(userid,productid,price,isoab,trackid,sharingcode)VALUES('" . $this->userid . "','" . $this->productid . "','" . $this->price . "','" . $this->isoab . "','" . $this->trackid . "','".$randomno."')";
        
        $query = $this->db->query( $sql );
            if( $this->db->affected_rows > 0 ) {
              if($this->language == "1"){
                    echo  json_encode( array(
                    'status' => 1,
                    'msg' => 'Yay! This is done!',
                    'trackid'=>$this->trackid
                ) );
                }
                else{
                echo  json_encode( array(
                    'status' => 1,
                    'msg' => 'لقد تمت العملية بنجاح!',
                    'trackid'=>$this->trackid
                ) );
                }


            }else{
                 if($this->language == "1"){
                echo   json_encode( array(
                    'status' => 0,
                    'msg' => 'It did not go through so please try again',
                    'trackid'=>$this->trackid
                ) );
                }
                else{
                echo   json_encode( array(
                    'status' => 0,
                    'msg' => 'حدث خطأ ما ',
                    'trackid'=>$this->trackid
                ) );}
                
            }
}
   
 public function dashboard() {

    echo json_encode( array(
        'status' => 1,                                                               
        'msg' => "dashboard",
        'userinfo' => $this->userinfo($this->userid),
        'slider' => $this->getslider(),
        'category' => $this->getcategory()

    ) );
        
}
 public function userinfo($userid) {
        
        $json = array();
        $sql = "select firstname,lastname from usermaster where userid='".$userid."'";
        $query = $this->db->query( $sql);
        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
        $k++;
            $fullname = $row['firstname']. " ". $row['lastname'];

        }
        if($k >0){
            return  array(
                'status' => 1,
                'count' => $k,
                'msg' => "Here is FullName",
                'slidercontent' => $fullname
            ) ;
        }
        else
        {
            if($this->language == "1"){
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "No Info. Available"
                                                           
                ) ;
            }
            else{
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "لا توجد قائمة منزلقة متاحة"
                                                           
                ) ;
            }  
        }
 }
public function getslider() {
        
        $json = array();
         if($this->language == "1"){
            $language = "english";
        }else{
            $language = "arabic";
        }
        $sql = "select * from homeslider where language='".$language."' order by orderby asc";
        $query = $this->db->query( $sql);

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr'] = $k+1;
            $json[$k]['image'] = "http://doodle.meritincentives.com/img/homeslider/".$row['image'];
            $json[$k]['language'] = $row['language'];
            $json[$k]['url'] = trim($row['url']);

            $k++;

        }
        if($k >0){
            return  array(
                'status' => 1,
                'count' => $k,
                'msg' => "Here is All Slider",
                'slidercontent' => $json
            ) ;
        }
        else
        {
            if($this->language == "1"){
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "Sorry, this isn't available"
                       
                ) ;
            }
            else{
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "عذرا، هذا غير متوفر"
                       
                ) ;
            }  
                                                                           

        }
}
 public function getprofile() {
        
        $json = array();

        $sql = "select * from usermaster where profileid='".$this->profileid."'";
        $query = $this->db->query( $sql);

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {

            $json['fullname'] = $row['fullname'];
            $json['dateofbirth'] = $row['dateofbirth'];
            $json['gender'] = $row['gender'];
            $json['location'] = $row['location'];
            $json['phonenumber'] = $row['phonenumber'];
            $json['nationality'] = $row['nationality'];
            $json['email'] = $row['email'];
          
            $json['points'] = $row['points'];
            // dubai police api call here for image
            $json['image'] = "http://ourstagedsite.com/dubaipolice/img/admin/image.png";

            $k++;

        }
        if($k >0){
            if($this->language == "1"){
                echo json_encode(  array(
                    'status' => 1,
                    'count' => $k,
                    'msg' => "Here is Information",
                    'profilecontent' => $json
                )) ;
            }else{
                echo json_encode(  array(
                    'status' => 1,
                    'count' => $k,
                    'msg' => "هذه هي المعلومات",
                    'profilecontent' => $json
                )) ;
            }
        }
        else
        {
            if($this->language == "1"){

                echo json_encode(   array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "No Profile Data Available"
                   
                )) ;
            }
            else{

                echo json_encode(   array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "لا توجد بيانات خاصة بالملف "
                   
                )) ;
            }  
                                                                           

        }
 }
 public function getcategory(  ) {
        $json = array();
                        
        $sql = "select * from appcategory order by orderby asc";
        $query = $this->db->query( $sql);

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['id'] = $row['id'];
        if($this->language == "1"){
            $json[$k]['name'] = $row['name'];  
        }
        else{
            $json[$k]['name'] = $row['namearabic'];
                            
        }  
            $json[$k]['image'] = "http://doodle.meritincentives.com/img/appcategory/".$row['image'];
            $k++;

        }
        if($k >0){
            return array(
                'status' => 1,
                'count' => $k,
                'msg' => "Here is All Category",
                'categorycontent' => $json
            );
        }
        else
        {
            if($this->language == "1"){
                return array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "No Category Available"
                   
                );
            }
            else{
                return array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "لا توجد فئة متاحة"
                   
                   
                );
            }  
        }
    }


  public function offer() {
        $json = array();
                        
        $sql = "select of.*,m.businessname,m.businessnamearabic,ac.image as categoryimage from offer of inner join merchant m on of.merchantid=m.id  inner join appcategory ac on ac.id=of.category where of.isactive='1' and of.isfeature='1' and CURDATE() between of.startdate and of.enddate order by id desc";
        $query = $this->db->query( $sql);

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
                $json[$k]['id'] = $row['id'];
            if($this->language == "arabic"){
                 $json[$k]['offertitle'] = $row['offertitleotherarabic'];   
                 $json[$k]['businessname'] = $row['businessnamearabic'];                            
            }
            else{
                $json[$k]['offertitle'] = $row['offertitle'];                              
                $json[$k]['businessname'] = $row['businessname']; 
            }  
            
                $json[$k]['discount'] = $row['discount'];    
                $json[$k]['distance'] = number_format((float)$row['distance'], 2, '.', '')."KM"; 

              
                $json[$k]['pointsvalue'] = $row['pointsvalue'];
                $json[$k]['expires'] = $row['enddate'];    
                $json[$k]['image'] = "http://doodle.meritincentives.com/img/offer/".$row['offerimage'];
                $json[$k]['categoryimage'] = "http://doodle.meritincentives.com/img/appcategory/".$row['categoryimage'];
            $k++;

        }
        if($k >0){
            return array(
                'status' => 1,
                'count' => $k,
                'msg' => "Here is All offer",
                'offercontent' => $json
            );
        }
        else
        {
            if($this->language == "1"){
                return array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "No Offer Available"
                   
                );
            }
            else{
                return array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "لا يوجد عرض متاح"
                   
                );
            }  
                               

        }
   }
 public function profilentionality() {
        
        $json = array();
        $sql = "select * from profile_nationality order by isorder";

        $query = $this->db->query( $sql);
        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr'] = $k+1;
            $json[$k]['name'] = $row['name'];
            $k++;

        }
        if($k >0){
            return  array(
                'status' => 1,
                'count' => $k,
                'msg' => "Here is All Slider",
                'slidercontent' => $json
                ) ;
        }
        else
        {
            if($this->language == "1"){
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "Sorry, this isn't available"
                   
                ) ;
            }
            else{
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "عذرا، هذا غير متوفر"
                   
                ) ;
            }  
                                                                           

        }
}

 public function faq($language) {
          
        $json = array();
        $sql = "select * from faq order by id asc";
        $query = $this->db->query( $sql);
        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr'] = $k+1;
        if($language == "1"){
            $json[$k]['question'] = $row['question'];
            $json[$k]['answer'] = $row['answer'];
        }else{
            $json[$k]['question'] = $row['questionarabic'];
            $json[$k]['answer'] = $row['answerarabic'];
        }
        $k++;

        }
        if($k >0){
            return  array(
                'status' => 1,
                'count' => $k,
                'msg' => "Here is All FAQ",
                'slidercontent' => $json
            ) ;
        }
        else
        {
            if($this->language == "1"){
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "Sorry but this FAQ hasn't been written yet",
                    'slidercontent' => $json
                   
                ) ;
            }
            else{
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "عذرا،  لم تتم كتابة هذه الأسئلة المتكرّرة بعد",
                    'slidercontent' => $json
                   
                ) ;
            }  
        }
  }

  public function howtotutorial($language) {
        
        $json = array();
	 if($this->language==1)
	 {
		 $language = "english";
	 }
	  else{
		  		 $language = "arabic";

	  }
	  
	  
	  
        $sql = "select * from howtotutorial where language='".$language."' order by id asc";
        $query = $this->db->query( $sql);

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr'] = $k+1;
            $json[$k]['icon'] = "http://doodle.meritincentives.com/img/howtotutorial/".$row['icon'];
        if($language == "english"){
            $json[$k]['title'] = $row['title'];
        }
        else{
            $json[$k]['title'] = $row['titlearabic'];
        }
            $json[$k]['image'] = "http://doodle.meritincentives.com/img/howtotutorial/".$row['image'];
			$json[$k]['language'] = $row['language'];

        $k++;

        }
        if($k >0){
            return  array(
                'status' => 1,
                'count' => $k,
                'msg' => "Here is All Tutorial",
                'slidercontent' => $json
                ) ;
        }
        else
        {
            if($this->language == "1"){
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "Sorry but this tutorial hasn't been made yet"
                   
                ) ;
            }
            else{
                return  array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "عذرا،  لا يوجد فيديو إرشادي بعد"
                   
                ) ;
            }  
        }
    }

  public function getloginslider($language) {
        
    $json = array();
    if($language == "1"){
        $language = "english";
    }else{
        $language = "arabic";
    }
    $sql = "select * from loginslider where language='".$language."' order by orderby asc";
    $query = $this->db->query( $sql);

    $k = 0;
    while ($row = mysqli_fetch_assoc($query)) {
        $json[$k]['sr'] = $k+1;
        $json[$k]['image'] = "http://doodle.meritincentives.com/img/loginslider/".$row['image'];
        $k++;

    }
    if($k >0){
        return  array(
            'status' => 1,
            'count' => $k,
            'msg' => "Here is All Slider",
            'slidercontent' => $json
            ) ;
    }
    else
    {
        if($this->language == "1"){
            return  array(
                'status' => 0,
                'count' => $k,
                'msg' => "Sorry, this isn't available"
               
            ) ;
        }
        else{
            return  array(
                'status' => 0,
                'count' => $k,
                'msg' => "عذرا، هذا غير متوفر"
               
            ) ;
        }  
                                                                           

    }
}

 public function contentpages() {
        $sql = "select * from content where option_key='image' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {
            $image = stripslashes($row["option_value"]);

        }

        if($this->language == "1"){
          //eng

        $sql = "select * from content where option_key='aboutenglish' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {
            $aboutenglish = stripslashes($row["option_value"]);
        }
        
  
        $sql = "select * from content where option_key='enduseragreementenglish' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {
            $enduseragreementenglish = stripslashes($row["option_value"]);

        }

        $sql = "select * from content where option_key='welcomeenglish' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $welcomeenglish = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='welcometitleenglish' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $welcometitlearabic = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='calltitle' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $calltitle = stripslashes($row["option_value"]);
        }
        $sql = "select * from content where option_key='calltext' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $calltext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='callnumber' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $callnumber = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='emailtitle' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $emailtitle = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='emailtext' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $emailtext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='whatsapptitle' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $whatsapptitle = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='whatsapptext' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $whatsapptext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='whatsappsharingtext' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $whatsappsharingtext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='termsconditiontextenglish' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $termsconditiontext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='image' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $mainimage = "http://doodle.meritincentives.com/img/product/".$row['option_value'];
        }


        }else{
//ara

        $sql = "select * from content where option_key='aboutarabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {
            $aboutenglish = stripslashes($row["option_value"]);
        }
        
  
        $sql = "select * from content where option_key='enduseragreementarabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $enduseragreementenglish = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='welcomearabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $welcomeenglish = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='welcometitlearabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $welcometitlearabic = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='calltitlearabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $calltitle = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='calltextarabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $calltext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='callnumber' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $callnumber = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='emailtitlearabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $emailtitle = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='emailtext' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $emailtext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='whatsapptitlearabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $whatsapptitle = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='whatsapptext' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $whatsapptext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='whatsappsharingtextarabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $whatsappsharingtext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='termsconditiontextarabic' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $termsconditiontext = stripslashes($row["option_value"]);
        }

        $sql = "select * from content where option_key='image' ";
        $query = $this->db->query( $sql );
        while ($row = mysqli_fetch_assoc($query)) {

            $mainimage = "http://doodle.meritincentives.com/img/product/".$row['option_value'];
        }


        }        
        
        echo json_encode( array(
            'status' => 1,                                                            
            'about' => $aboutenglish,
            'enduser' => $enduseragreementenglish,
            'applyforoabtitle' => $welcometitlearabic,
            'applyforoabtext' => $welcomeenglish,
            'calltitle' => $calltitle,
            'calltext' => $calltext,
            'callnumber' => $callnumber,
            'emailtitle' => $emailtitle,
            'emailtext' => $emailtext,
            'whatsapptitle' => $whatsapptitle,
            'whatsappnumber' => $whatsapptext,
            'whatsappsharingtext' => $whatsappsharingtext,
            'termsconditiontext' => $termsconditiontext,
            //'mainimage' => $mainimage,
            'loginslider' => $this->getloginslider($this->language),
            'profilentionality' => $this->profilentionality(),
            'faq' => $this->faq($this->language),
            'howtotutorial' => $this->howtotutorial($this->language),
               

        ) );
        
}
 public function giftbycategory() {
        $json = array();

        if($this->filter == "brandname"){

            $sql = "select * from product where isactive='1' and categoryid='".$this->category."'  order by cardname asc";  
        }                       
         else if($this->filter == "ptlowtohigh"){
                  
            $sql = "select * from product where isactive='1' and categoryid='".$this->category."'  order by cast(actualprice as UNSIGNED) asc";  

        }
        else if($this->filter == "pthightolow"){
            $sql = "select * from product where isactive='1' and categoryid='".$this->category."'  order by cast(actualprice as UNSIGNED) desc";  
        }
        else if($this->filter == "location"){
            $sql = "select * from product where isactive='1' and categoryid='".$this->category."'  order by pricecurrency asc";  
        }
        else{
            $sql = "select * from product where isactive='1' and categoryid='".$this->category."'  order by id desc";  
        }
                        
                        
        $query = $this->db->query( $sql);

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
              $json[$k]['id'] = $row['id'];

        if($this->language == "1"){
            $json[$k]['cardname'] = $row['cardname'];
            $json[$k]['termscondition'] = $row['termscondition'];
			            $json[$k]['pricecurrency'] = $row['pricecurrency']; 

        }else{
            $json[$k]['cardname'] = $row['cardnamearabic'];
            $json[$k]['termscondition'] = $row['termsconditionarabic'];
			
			
			
			
			
			if($row['pricecurrency']=='OMR')
			{
			$json[$k]['pricecurrency'] = "ريال عماني"; 
			}
			
			
			if($row['pricecurrency']=='USD')
			{
			$json[$k]['pricecurrency'] = "دولار أمريكي"; 
			}
			
			
			if($row['pricecurrency']=='AED')
			{
			$json[$k]['pricecurrency'] = "درهم إماراتي"; 
			}
			
			if($row['pricecurrency']=='SAR')
			{
			$json[$k]['pricecurrency'] = "الريال السعودي"; 
			}
			
			
			
			
			
			
			
			
			
        }                             
            $json[$k]['brandname'] = $row['brandname']; 
            //$json[$k]['termscondition'] = $row['termscondition']; 
            $json[$k]['pricefornonoab'] = $row['pricefornonoab']; 
            $json[$k]['priceforoab'] = $row['priceforoab']; 
            $json[$k]['campaign_id'] = $row['campaign_id']; 
            $json[$k]['campaign_name'] = $row['campaign_name']; 
            $json[$k]['actualprice'] = $row['actualprice']; 
            
       
            $json[$k]['image'] = "http://doodle.meritincentives.com/img/product/".$row['image'];
            $json[$k]['featuredimage'] = "http://doodle.meritincentives.com/img/product/".$row['featuredimage'];
      
            $k++;

        }
        if($k >0){
            echo json_encode( array(
                'status' => 1,
                'count' => $k,
                'msg' => "Here is All offer",
                'offercontent' => $json
                 ));
        }
        else
        {
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "Sorry, this isn't available"
                   
                ));
            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'count' => $k,
                    'msg' => "عذرا، هذا غير متوفر"
                   
                ));
            }  
                

        }
    }
 
 public function productbyid() {
        
        $json = array();
        $json1 = array();

        $sql = "select pr.*,ac.image as categoryimage from product pr inner join appcategory ac on ac.id=pr.categoryid where pr.isactive='1' and pr.id='".$this->productid."'";
                        
        $query = $this->db->query( $sql);

        $k = 0;
        $j = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['productid'] = $this->productid; 
            $json[$k]['image'] = "http://doodle.meritincentives.com/img/product/".$row['image'];
         
        if($this->language == "1"){
            $json[$k]['cardname'] = $row['cardname']; 
            $json[$k]['termscondition'] = $row['termscondition'];
            $json[$k]['cardbutton2'] = $row['cardbutton2'];
			$json[$k]['pricecurrency'] = $row['pricecurrency']; 

        }
        else{
            $json[$k]['cardname'] = $row['cardnamearabic'];
            $json[$k]['termscondition'] = $row['termsconditionarabic']; 
            $json[$k]['cardbutton2'] = $row['cardbutton2arabic'];
			if($row['pricecurrency']=='OMR')
			{
			$json[$k]['pricecurrency'] = "ريال عماني"; 
			}
			
			
			if($row['pricecurrency']=='USD')
			{
			$json[$k]['pricecurrency'] = "دولار أمريكي"; 
			}
			
			
			if($row['pricecurrency']=='AED')
			{
			$json[$k]['pricecurrency'] = "درهم إماراتي"; 
			}
			
			if($row['pricecurrency']=='SAR')
			{
			$json[$k]['pricecurrency'] = "الريال السعودي"; 
			}
			

        }
            $json[$k]['brandname'] = $row['brandname'];
            $json[$k]['pricefornonoab'] = $row['pricefornonoab']; 
            $json[$k]['priceforoab'] = $row['priceforoab']; 
            $json[$k]['actualprice'] = $row['actualprice'];
            $json[$k]['campaign_id'] = $row['campaign_id']; 
            $json[$k]['campaign_name'] = $row['campaign_name'];
            $json[$k]['currencycode'] = $row['currencycode'];

            $json[$k]['categoryimage'] = "http://doodle.meritincentives.com/img/appcategory/".$row['categoryimage'];

            $json[$k]['discount'] = $row['discount'];
            $json[$k]['cardbutton1'] = $row['cardbutton1'];
        $k++;

        }
        if($k >0){
            echo json_encode( array(
                'status' => 1,'msg' => "Product Content",
                'productcontent' => $json
            ));
                                                          
        }
        else
        {
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,'msg' => "Content here isn't available"
                            
                ));
            }
            else{
                echo json_encode( array(
                    'status' => 0,'msg' => "المحتوى غير متاح هنا"
                            
                ));
            }
        }
    }


   public function getmyreferrals() {
        
       $sql = "select myrefcode from usermaster where userid= '" . $this->userid . "'";
       $query = $this->db->query( $sql);
        
        while ($row = mysqli_fetch_assoc($query)) {
            
            $myreferralcode = $row['myrefcode'];
                             
        }

        $json = array();
        $sql = "select count(referralcode) as referralcodes from usermaster where referralcode= '" . $myreferralcode . "'";
        $query = $this->db->query( $sql);

                       
                           
        while ($row = mysqli_fetch_assoc($query)) {
            $referralcodecount = $row['referralcodes'];
                             
        }
                        //echo $referralcode;
        $sql = "select * from referralcards order by referralcount asc";
        $query = $this->db->query( $sql); 
        $k = 0;    
        while ($row = mysqli_fetch_assoc($query)) {
            $a= $row['referralcount'];

            if($referralcodecount >= $a ){
                $json[$k]['active'] = 1;
            }
            else{
                 $json[$k]['active'] = 0;
            }

            if($this->language == "1"){
                $json[$k]['cardname'] = $row['cardname'];
                $json[$k]['termscondition'] = $row['termscondition'];
            }
            else{
                $json[$k]['cardname'] = $row['cardnamearabic'];
                $json[$k]['termscondition'] = $row['termsconditionarabic'];
            }
                $json[$k]['productid'] = $row['id'];
     
                //$json[$k]['cardname'] = $row['cardname'];
                $json[$k]['image'] = "http://doodle.meritincentives.com/img/referralcards/".$row['image'];

                $json[$k]['featuredimage'] = "http://doodle.meritincentives.com/img/referralcards/".$row['featuredimage'];
                //$json[$k]['termscondition'] = $row['termscondition'];
                $json[$k]['actualprice'] = $row['actualprice'];
                $json[$k]['pricecurrency'] = $row['pricecurrency'];
                $json[$k]['campaign_id'] = $row['campaign_id'];
                $json[$k]['campaign_name'] = $row['campaign_name'];
                $json[$k]['referralcount'] = $row['referralcount'];

            $sql2 = "select * from paymenthistory where referralproductid= '".$row['id']."' and userid= '" . $this->userid . "'";
            $query2 = $this->db->query( $sql2); 

        if(mysqli_num_rows($query2 ) > 0){
            while ($row2 = mysqli_fetch_assoc($query2)) {
                $json[$k]['purchased'] = 1;
                $json[$k]['batchid'] = $row2['batchid'];
                $json[$k]['giftcard_key'] = $row2['giftcard_key'];
                $json[$k]['giftcard_number'] = $row2['giftcard_number'];
                $json[$k]['card_id'] = $row2['card_id'];
                $json[$k]['original_value'] = $row2['original_value'];
                $json[$k]['remaining_value'] = $row2['remaining_value'];
                $json[$k]['expiration_date'] = $row2['expiration_date'];
                $json[$k]['style_image'] = $row2['style_image'];
                $json[$k]['giftcard_url'] = $row2['giftcard_url'];
            } 
        }else{
                $json[$k]['purchased'] = 0; 
                $json[$k]['batchid'] = '';
                $json[$k]['giftcard_key'] = '';
                $json[$k]['giftcard_number'] = '';
                $json[$k]['card_id'] = '';
                $json[$k]['original_value'] = '';
                $json[$k]['remaining_value'] = '';
                $json[$k]['expiration_date'] = '';
                $json[$k]['style_image'] = '';
                $json[$k]['giftcard_url'] = '';
        }

          $k++;
        }
        if($k >0){
            echo json_encode( array(
                'status' => 1,'msg' => "Referral Code",
                'referralcount' =>$referralcodecount,
                'myreferralcode' => $myreferralcode,
                'content' => $json
            ));
                                                          
        }
        else
        {
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,'msg' => "Your referral isn't available"
                            
                ));
            }
            else{
                echo json_encode( array(
                    'status' => 0,'msg' => "إحالتك غير متاحة"
                            
                ));
            }
                                  

        }
    }


public function giftcardpurchased() {

    $json = array();
                         
    $sql = "select ph.*,p.*,ph.id as paymenthistoryid from product p inner join paymenthistory ph on ph.productid=p.id where (ph.userid='".$this->userid."' and ph.isshared='0' and ( ph.redeemby='' || ph.redeemby is null) and ph.transactionstatus='CAPTURED' and (ph.batchid !='' || ph.batchid is not null)  and ph.batchid !='error') or ph.redeemby='".$this->userid."' order by ph.id desc";
                        
    $query = $this->db->query( $sql);

    $current_timestamp = date('Y-m-d');
    $datetime1 = date_create(date('Y-m-d')); 
                            
    $k = 0;

    while ($row = mysqli_fetch_assoc($query)) {
                                                         
        $json[$k]['trackid'] = $row['trackid']; 
        $json[$k]['transactionid'] = $row['transactionid'];
    if($this->language == "1"){
        $json[$k]['cardname'] = $row['cardname'];
		        $json[$k]['currency'] = $row['currency'];

    }
    else{
        $json[$k]['cardname'] = $row['cardnamearabic'];
		
		if($row['currency']=='OMR')
			{
			$json[$k]['currency'] = "ريال عماني"; 
			}
			
			
			if($row['currency']=='USD')
			{
			$json[$k]['currency'] = "دولار أمريكي"; 
			}
			
			
			if($row['currency']=='AED')
			{
			$json[$k]['currency'] = "درهم إماراتي"; 
			}
			
			if($row['currency']=='SAR')
			{
			$json[$k]['currency'] = "الريال السعودي"; 
			}
			

		
		
		
    } 
        $json[$k]['batchid'] = $row['batchid']; 
        $json[$k]['giftcard_key'] = $row['giftcard_key'];    
        $json[$k]['giftcard_number'] = $row['giftcard_number'];
        $json[$k]['card_id'] = $row['card_id'];
		        //$json[$k]['original_value'] = $row['original_value'];
	    $json[$k]['original_value'] = $row['actualprice'];	
        $json[$k]['remaining_value'] = $row['remaining_value'];
        //$json[$k]['style_image'] = $row['style_image'];
        
		    $json[$k]['style_image'] = "http://doodle.meritincentives.com/img/product/".$row['image'];
        $json[$k]['giftcard_url'] = $row['giftcard_url']; 
        $json[$k]['expiration_date'] = $row['expiration_date']; 
    if($row['expiration_date'] != "Unlimited"){
        $datetime2 = date_create($row['expiration_date']); 
        $interval = date_diff($datetime1, $datetime2); 
        $json[$k]['diff'] = $interval->format('%R%a');
    if($interval->format('%R%a') >=0){  
        $json[$k]['expired'] = 0;
    }else{
        $json[$k]['expired'] = 1;
    }
    }else{
        $json[$k]['diff'] = "+1000";
        $json[$k]['expired'] = 0;
    }     

    if(!is_null($row['redeemby'])){
       // $json[$k]['redeemby'] = $row['redeemby'];                               
    }
    else{
        $json[$k]['redeemby'] = "0";                            
    }
             $json[$k]['redeemby'] = "0";      
        $json[$k]['cardactive'] = $row['cardactive'];                            
        $json[$k]['productid'] = $row['productid'];                            
        $json[$k]['paymenthistoryid'] = $row['paymenthistoryid'];
             


	$sql1 = "select * from favourites where userid='".$this->userid."' and productid='".$row['paymenthistoryid']."'";
  
    $result2 = $this->db->query($sql1);
    $isf = 0;
        while ($row12 = mysqli_fetch_assoc($result2)) {
            $json[$k]['isfavourite'] = $row12["selected"];
            $isf++;
        }
        if($isf <= 0){
            $json[$k]['isfavourite'] = 0;                                
        }
        
    $k++;


    }

    if($k >0){
        echo json_encode( array(
            'status' => 1,
            'count' => $k,
            'msg' => "Here is All Gift Card",
            'productcontent' => $json
        ));
    }
    else
    {
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 0,
                'count' => $k,
                'msg' => "You don’t have any gift cards at the moment. Why not have a look at our gifti range of gift cards & purchase now!"
               
            ));
        }
        else{
            echo json_encode( array(
                'status' => 0,
                'count' => $k,
                'msg' => "ليس لديك أية بطاقات هدايا في الوقت الحالي. ما رأيك بتصفح نطاق بطاقات الهدايا لدينا والشراء الآن؟!"
               
            ));
        }
             

    }
                            
}


public function signupotp() {

    $randomno = substr(number_format(time() * rand(),0,'',''),0,6);

    $curl = curl_init();

	
	$language = $this->language;
			
			
			
			if($language == "1")
{
$msg = urlencode("Hello, you are one step closer to enjoy Gifti benefits. Your verification code is ".$randomno."");
}
if($language != "1")
{
$msg = urlencode("مرحبًا ، أنت على بعد خطوة واحدة للاستمتاع بمزايا Gifti. رمز التحقق هو ".$randomno."");

}			

			
	
	
	
	
	
   curl_setopt_array($curl, array(
     CURLOPT_URL => "https://api.smsglobal.com/http-api.php?action=sendsms&user=rlm2it40&password=wNLkOwao&maxsplit=8&from=GIFTI&to=968".$this->mobile."&text=$msg",
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
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 1,
                    'msg' => 'Your One-Time Password is sent!',
                    'otp' => $randomno
                            
                ) ); 
            }
            else{
                echo json_encode( array(
                    'status' => 1,
                    'msg' => 'تم  ارسال رمز التحقق',
                    'otp' => $randomno
                            
                ) ); 
            }
        }
        else{
            if($this->language == "1"){
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

}
   

 public function sharedgifts() {
        
    $json = array();
                     
    $sql = "select p.*,po.cardname,po.pricecurrency,po.image from paymenthistory p inner join product po on po.id=p.productid where p.userid='".$this->userid."' and p.isshared='1' and p.batchid!='error' and (p.batchid!='' || p.batchid is not null) order by p.id desc";
    $query = $this->db->query( $sql);

    $current_timestamp = date('Y-m-d');
    $datetime1 = date_create(date('Y-m-d'));

    $k = 0;
        
    while ($row = mysqli_fetch_assoc($query)) {
			$pricecurrency = $row['pricecurrency'];

if($this->language == "1")
	{
	$pricecurrency = $row['pricecurrency'];
		}	
		
		if($this->language != "1")
		{
			if($pricecurrency=='OMR')
			{
			$pricecurrency = "ريال عماني"; 
			}
			
			
			if($pricecurrency=='USD')
			{
			$pricecurrency = "دولار أمريكي"; 
			}
			
			
			if($pricecurrency=='AED')
			{
			$pricecurrency = "درهم إماراتي"; 
			}
			
			if($pricecurrency=='SAR')
			{
			$pricecurrency = "الريال السعودي"; 
			}
			
		}
                         
        $json[$k]['productid'] = $row['productid'];
        $json[$k]['trackid'] = $row['trackid']; 
        $json[$k]['price'] = $row['price']." ". $pricecurrency;
        $json[$k]['cardname'] = $row['cardname'];
        $json[$k]['transactionstatus'] = $row['transactionstatus']; 
        $json[$k]['transactionid'] = $row['transactionid']; 
        $json[$k]['paymentid'] = $row['paymentid']; 
        $json[$k]['batchid'] = $row['batchid'];
        $json[$k]['giftcard_key'] = $row['giftcard_key'];
        $json[$k]['giftcard_number'] = $row['giftcard_number'];
        $json[$k]['card_id'] = $row['card_id'];
        $json[$k]['original_value'] = $row['original_value']." ". $pricecurrency;
        $json[$k]['remaining_value'] = $row['remaining_value']." ". $pricecurrency;
    if($row['expiration_date'] != "Unlimited"){
        $datetime2 = date_create($row['expiration_date']); 
        $interval = date_diff($datetime1, $datetime2); 
        $json[$k]['diff'] = $interval->format('%R%a');
        if($interval->format('%R%a') >=0){  
            $json[$k]['expired'] = 0;
        }else{
            $json[$k]['expired'] = 1;
        }
    }else{
        $json[$k]['diff'] = "+1000";
        $json[$k]['expired'] = 0;
    } 
        $json[$k]['expiration_date'] = $row['expiration_date'];
$json[$k]['style_image'] = "http://doodle.meritincentives.com/img/product/".$row['image'];
        $json[$k]['giftcard_url'] = $row['giftcard_url'];
        $json[$k]['campaign_id'] = $row['campaign_id'];
        $json[$k]['sharingcode'] = $row['sharingcode'];
        $json[$k]['cardactive'] = $row['cardactive']; 
    if(!is_null($row['redeemby']))
    {
        $json[$k]['isredeemed'] = 1;
    }
    else
    {
        $json[$k]['isredeemed'] = 0;   
    }
               $json[$k]['isredeemed'] = 0;   
 
    $sql1 = "select * from favourites where userid='".$this->userid."' and productid='".$row['productid']."'";

    $result2 = $this->db->query($sql1);
    if( $this->db->affected_rows > 0 ) {
       $json[$k]['isfavourite'] = 1;                            
    }
    else{
       $json[$k]['isfavourite'] = 0;                            
    }

 $k++;

    }
    if($k >0){
        echo json_encode( array(
            'status' => 1,
            'msg' => "All Shared Gift Card",
            'productcontent' => $json
        ));
                                  
    }
    else
    {
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 0,
                'msg' => "Oops! You haven’t shared any gifts yet.Remember, sharing is caring! Go and share some gifts now."
                    
            ));
        }
        else{
            echo json_encode( array(
                'status' => 0,
'msg' => 'عذرًا لم تقم بمشاركة أية هدايا حتى الآن! لا تنسى أن المشاركة تعنى الاهتمام. قم بمشاركة الهدايا الآن.'                    
            ));
        }
           

    }
}

public function myfavourite() {

    $json = array();
    $json1 = array();
    
    $sql = "select p.*,f.*,p.productid as pid,p.id as paymenthistoryid from favourites f inner join paymenthistory p on f.productid=p.id where f.userid='".$this->userid."' and f.selected='1' and p.isshared=0";
                       
    $query = $this->db->query( $sql);
    $current_timestamp = date('Y-m-d');
    $datetime1 = date_create(date('Y-m-d')); 
                            
    $k = 0;
    while ($row = mysqli_fetch_assoc($query)) {
                           
        $datetime2 = date_create($row['expiration_date']); 
        
        $interval = date_diff($datetime1, $datetime2); 

        $json[$k]['trackid'] = $row['trackid']; 
        $json[$k]['transactionid'] = $row['transactionid'];

        $sql1 = "select * from product where id='".$row["pid"]."'";

        $query12 = $this->db->query( $sql1);
        while ($row12 = mysqli_fetch_assoc($query12)) {               
            if($this->language == "1"){
                $json[$k]['cardname'] = $row12['cardname'];
				$json[$k]['currency'] = $row['currency'];

            }
            else{
                $json[$k]['cardname'] = $row12['cardnamearabic'];
				if($row['currency']=='OMR')
			{
			$json[$k]['currency'] = "ريال عماني"; 
			}
			
			
			if($row['currency']=='USD')
			{
			$json[$k]['currency'] = "دولار أمريكي"; 
			}
			
			
			if($row['currency']=='AED')
			{
			$json[$k]['currency'] = "درهم إماراتي"; 
			}
			
			if($row['currency']=='SAR')
			{
			$json[$k]['currency'] = "الريال السعودي"; 
			}
			
				
				
				
				
				
				
				
				
            } 
        }

                       
            $json[$k]['batchid'] = $row['batchid']; 
            $json[$k]['giftcard_key'] = $row['giftcard_key'];    
            $json[$k]['giftcard_number'] = $row['giftcard_number'];
            $json[$k]['card_id'] = $row['card_id'];
            $json[$k]['original_value'] = $row['original_value'];
            $json[$k]['remaining_value'] = $row['remaining_value'];
            $json[$k]['style_image'] = $row['style_image'];
            $json[$k]['giftcard_url'] = $row['giftcard_url']; 
            $json[$k]['expiration_date'] = $row['expiration_date']; 
            $json[$k]['redeemby'] = $row['redeemby'];                            
            $json[$k]['cardactive'] = $row['cardactive'];                            
            $json[$k]['productid'] = $row['productid'];          
            $json[$k]['paymenthistoryid'] = $row['paymenthistoryid'];                            
            $json[$k]['isfavourite'] = $row['selected'];                            
        if($row['expiration_date'] != "Unlimited"){
            $datetime2 = date_create($row['expiration_date']); 
            $interval = date_diff($datetime1, $datetime2); 
            $json[$k]['diff'] = $interval->format('%R%a');
        if($interval->format('%R%a') >=0){  
            $json[$k]['expired'] = 0;
        }else{
            $json[$k]['expired'] = 1;
        }
       }else{
            $json[$k]['diff'] = "+1000";
            $json[$k]['expired'] = 0;
        } 

                        
       $k++;


    }
    if($k >0){
        echo json_encode( array(
            'status' => 1,
            'count' => $k,
            'msg' => "Here is All Product",
            'productcontent' => $json
        ));
    }
    else
    {
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 0,
                'count' => $k,
                'msg' => "See something you fancy? Don't be shy and add as many as you like- you might just get lucky!"
               
            ));
        }
        else{
            echo json_encode( array(
                'status' => 0,
                'count' => $k,
                'msg' => "هل أعجبك شيء؟ لا تخجل وقم بإضافة ما تحب! قد تكون محظوظ! "
               
            ));
        }
             

    }
                            
}
 
 public function redeemgift() {




$selectionquery=$this->db->query("Select * from paymenthistory where `redeemby`='" . $this->userid . "' and sharingcode='".$this->code."'");
if(mysqli_num_rows($selectionquery )>0){
$language = $this->language;
if($this->language == "1"){
echo json_encode( array(
'status' => 0,
'msg' => 'This promo code has already been redeemed so check the number and try again',
) );

}
else{
echo json_encode( array(
'status' => 0,
'msg' => ' تم استخدم هذا الرمز الترويجي من قبل. يرجى التأكد من الرقم و المحاولة مرة أخرى.',
) );

}




}


if(mysqli_num_rows($selectionquery )==0)
{

$selectionquery23=$this->db->query("Select * from paymenthistory where sharingcode='".$this->code."'");
$result12= mysqli_fetch_assoc($selectionquery23);
$sharingcode = $result12['sharingcode'];
if($sharingcode==$this->code)  
{
$sql = "UPDATE paymenthistory set `redeemby`='" . $this->userid . "' where sharingcode=" . $this->code;
$query = $this->db->query( $sql );
if( $this->db->affected_rows > 0 ) {
if($this->language == "1"){
	
	
echo json_encode( array(
'status' => 1,                                    
'msg' => 'Updated successfully, please find your giftcard in gifts purchased section',
) );
} 
	
	
if($this->language != "1"){	
	
	echo json_encode( array(
'status' => 1,                                    
'msg' => 'تم التحديث بنجاح ، يرجى العثور على بطاقة الهدايا الخاصة بك في قسم الهدايا المشتراة',
) );
	
	
}
}
}

if($sharingcode!=$this->code)  
{


$language = $this->language;
if($this->language == "1"){
echo json_encode( array(
'status' => 0,
'msg' => 'Invalid Sharing Code',
) );

}
else{
echo json_encode( array(
'status' => 0,
'msg' => 'رمز المشاركة غير صالح',
) );

} 
















}




}






/*
$sql = "UPDATE paymenthistory set `redeemby`='" . $this->userid . "' where sharingcode=" . $this->code;
$query = $this->db->query( $sql );
if( $this->db->affected_rows > 0 ) {
echo json_encode( array(
status' => 1,                                    
msg' => 'updated Successfully',
) );
} else {
if($this->language == "1"){
echo json_encode( array(
status' => 0,
msg' => 'This promo code has already been redeemed so check the number and try again',
) );

}
else{
echo json_encode( array(
status' => 0,
msg' => 'تم استخدم هذا الرمز الترويجي من قبل. يرجى التأكد من الرقم و المحاولة مرة أخرى.',
) );

}
}
*/}


public function favouriteselected() {
    if($this->productid != ''){
        
        $sql = "select * from favourites where userid='".$this->userid."' and productid='".$this->productid."' ";
        $query = $this->db->query( $sql );
        $result= mysqli_fetch_assoc($query);
        if(!empty($result)){
            $sql = "UPDATE favourites set `selected`='" . $this->selected . "' where userid=" . $this->userid ." and productid = '".$this->productid."'";
                         
            $query = $this->db->query( $sql );
            if( $this->db->affected_rows > 0 ) {
                echo json_encode( array(
                    'status' => 1,                                    
                    'msg' => 'favourites updated Successfully',
                ) );
            } 
            else {
                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'Whoops, something went wrong :('
                    
                   ) );  
                }
                else{
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'عفوًا، حدث خطأ ما :('
                    
                ) );  
                }

            }
        }
        else{
            $sql = "insert into favourites(userid,productid,selected)VALUES('" . $this->userid . "','" . $this->productid . "','" . $this->selected . "')";
            $query = $this->db->query( $sql );
                                      
            if( $this->db->affected_rows > 0 ) {
	
	if($this->language == "1"){
echo json_encode( array(
'status' => 1,                                    
'msg' => 'favourites Created Successfully',
) );
} 

if($this->language != "1"){
echo json_encode( array(
'status' => 1,                                    
'msg' => 'تم انشاء المفضلة بنجاح',
) );
} 


} 
            else {
                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'Whoops, something went wrong :('
                    
                    ) );  
                }
                else{
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'عفوًا، حدث خطأ ما :('
                    
                    ) );  
                }
            }
        }

    }
    else{
		
		 if($this->language == "1"){
        echo json_encode( array(
            'status' => 0,
            'msg' => 'Provide Valid Card Id',
        ) );
		 }
		
		 if($this->language != "1"){
        echo json_encode( array(
            'status' => 0,
            'msg' => 'الرجاء ادخال رمز بطاقة صالح',
        ) );
		 }
		
    }
}
public function checkbalance(){
  
	
$selectcheck = 	$this->db->query("Select * from paymenthistory where card_id= '".$this->cardid."' and redeemby != '' ");
  if( mysqli_num_rows($selectcheck)> 0 ) {	
	if($this->language=="1")
{
   echo json_encode( array(
        'status' => 0,
        'msg' => "Gift Card already redeemed.",
        'remaining_value' => '0'
    ) ); 	
}
else
{	

 echo json_encode( array(
        'status' => 0,
        'msg' => 'استبدال بطاقة الهدايا',
        'remaining_value' => '0'
    ) );

}
die();
	
	
	
  }
	
	
	
	
	
	
	
	
	
	
	
	
	
 $curl = curl_init();

 curl_setopt_array($curl, array(
   CURLOPT_URL => "https://testapi.meritincentives.com/api/v1/currency/giftcards/balance_check?card_id=".$this->cardid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: bearer secret_live_M9d9tWXFUG_IblAjVjkwPl7QKRyP7Z4cKad8hQNxohE",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 680dfa9a-e24d-492a-a998-426182d20edb",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo json_encode( array(
        'status' => 0,
        'msg' => 'Error',
        'remaining_value' => '0'
    ) ); 
} 
else {

  $a = json_decode($response);
  $remaining_value = $a->data->remaining_value; 
	//$remaining_value = 0;
if($remaining_value=="" || $remaining_value==0) 
{
if($this->language=="1")
{
   echo json_encode( array(
        'status' => 0,
        'msg' => "We can't see any data",
        'remaining_value' => '0'
    ) ); 	
}
else
{	

 echo json_encode( array(
        'status' => 0,
        'msg' => 'لا يمكننا رؤية أي بيانات',
        'remaining_value' => '0'
    ) );

}
die();
}
	
	
	
	
	
  $sql1 = "update paymenthistory set remaining_value='".$remaining_value."' where card_id= '".$this->cardid."'";
  $result1 = $this->db->query($sql1);
    if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => 1,
                'msg' => 'Successfully',
                'remaining_value' => $remaining_value
            ) ); 
    }
    else{

            echo json_encode( array(
                'status' => 1,
                'msg' => 'Same Data Available',
                'remaining_value' => $remaining_value
            ) ); 
    }

 }

}
public function creategiftcard(){
    
        $sql = "select * from paymenthistory where trackid= '" . $this->trackid . "'";

        $query = $this->db->query( $sql );
        $reg_result = mysqli_fetch_assoc($query);
        $paymenthistoryid = $reg_result["id"];
        $sql = "select * from product where id= '" . $reg_result["productid"] . "'";

        $query = $this->db->query( $sql );
        $reg_result = mysqli_fetch_assoc($query);
        $campid= $reg_result["campaign_id"];
$imagecard = $reg_result['image'];
        $price= $reg_result["actualprice"];
        $pricecurrency = $reg_result["pricecurrency"];
        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://testapi.meritincentives.com/api/v1/currency/giftcards",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "giftcard%5Bvendor_id%5D=VID_OAB&giftcard%5Bquantity%5D=1&giftcard%5Bcampaign_id%5D=".$campid."&giftcard%5Bdenomination%5D=".$price."&undefined=",
  CURLOPT_HTTPHEADER => array(
    "Authorization: bearer secret_live_M9d9tWXFUG_IblAjVjkwPl7QKRyP7Z4cKad8hQNxohE",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 5d32623d-3a6b-47a8-8b53-980be3797acc",
    "cache-control: no-cache"
  ),
));
	
	

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$redp = json_decode($response);


if ($redp->code == "400" || $redp->code == "401" || $redp->code == "403" || $redp->code == "404" || $redp->code == "410" || $redp->code == "429" || $redp->code == "500" || $redp->code == "503" || $redp->code == "422" || $redp->status == "500") {
    $sql1 = "update paymenthistory set batchid='error', giftcard_key='error', giftcard_number='error', card_id='error',original_value='error',remaining_value='error', expiration_date='error', currency='error',convert_rate='error',style_image='error', giftcard_url='error', campaign_id='error' where trackid= '" . $this->trackid . "'"; ///need to be done by monica
    $result1 = $this->db->query($sql1);
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 0,
                //'msg' => 'There is a problem while creating Gift card please contact Support team with Trackid: '.$this->trackid,
                'msg' => 'You need to get in touch with us with your Order Number:'.$this->trackid.' to retrieve this Gift Card',

                'data' => null,
            ) );
        }
        else{
            echo json_encode( array(
                'status' => 0,
                //'msg' => 'There is a problem while creating Gift card please contact Support team with Trackid: '.$this->trackid,
'msg' => 'يرجى الاتصال بنا و ارسال رقم طلبك التالي:'.$this->trackid.' من أجل االحصول على هديتك.',

                'data' => null,
            ) );
        }
                    

/////////////Email Notifiers To List//////////////////////////////	
	
$sql = "select * from paymenthistory where trackid= '" . $this->trackid . "'";
$query12 = $this->db->query( $sql );
$reg_result12 = mysqli_fetch_assoc($query12);
$paymenthistoryid = $reg_result12["id"];
$userid = $reg_result12['userid'];	
$sql = "select * from product where id= '" . $reg_result12["productid"] . "'";
$query = $this->db->query( $sql );
$reg_result = mysqli_fetch_assoc($query);
$cardname= $reg_result["cardname"];
$price= $reg_result["actualprice"]." ".$reg_result['pricecurrency'];	
$quantity =1;

$userquery = $this->db->query("Select * from usermaster where userid = '".$userid."'");	
$getuserdetails = mysqli_fetch_assoc($userquery);	
$usergsm = $getuserdetails['gsm'];	
$username = $getuserdetails['firstname']. " " .$getuserdetails['lastname'] ;	
$useremail = $getuserdetails['emailid'];	
	
	
	
	
	
$query854 = $this->db->query("Select * from email_notifiers where status = 'active'");
while($getemails = mysqli_fetch_assoc($query854))
{

$name_notify = $getemails['name'];	
$email_notify = $getemails['email'];	
	
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
$msg.= '<p>Hello '.$name_notify.',</p>';
$msg.= "<p>Attention: Rewards Fulfillment Team. </p>";
$msg.= "<table border='1'>
<tr><td>Customer Name</td><td>Mobile Number</td><td>Email</td><td>Brand Ordered</td><td>Denomination</td><td>Quantity</td></tr>
<tr><td>".$username."</td><td>".$gsm."</td><td>".$useremail."</td><td>".$cardname."</td><td>".$price."</td><td>".$quantity."</td></tr>
</table><br/>";
	
	
	
	
	
	
	
	

$msg.= "<p>Regards</p>";

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
$a = mail($email_notify,$name_notify."FAILED TRANSACTIONS – GIFTI",$msg,$headers);	
if($a)
{
	 $in = $this->db->query("Insert into email_track (name_notify,email_notify,subject,username,usergsm,useremail,cardname,price,quantity,msg) Values ('".$name_notify."','".$email_notify."','FAILED TRANSACTIONS GIFTI','".$username."','".$usergsm."','".$useremail."','".$cardname."','".$price."','".$quantity."','".addslashes($msg)."')");
}	
}
} else {

$a = json_decode($response);
$batchid = $a->data->giftcard->batch_id;  
 
$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://testapi.meritincentives.com/api/v1/currency/giftcards?vendor_id=VID_OAB&batch_id=".$batchid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "undefined=",
  CURLOPT_HTTPHEADER => array(
    "Authorization: bearer secret_live_M9d9tWXFUG_IblAjVjkwPl7QKRyP7Z4cKad8hQNxohE",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 6a73272d-9a7a-436c-8176-2f288af2dc57",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);


curl_close($curl);
$redp = json_decode($response);

if ($redp->code == "400" || $redp->code == "401" || $redp->code == "403" || $redp->code == "404" || $redp->code == "410" || $redp->code == "429" || $redp->code == "500" || $redp->code == "503" || $redp->code == "422" || $redp->status == "500") {
    $sql1 = "update paymenthistory set batchid='".$batchid."', giftcard_key='error',giftcard_number='error',card_id='error',original_value='error', remaining_value='error', expiration_date='error', currency='error', convert_rate='error',style_image='error', giftcard_url='error', campaign_id='error' where trackid= '" . $this->trackid . "'"; ///need to be done by monica
    $result1 = $this->db->query($sql1);
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 0,
                //'msg' => 'There is a problem while creating Gift card please contact Support team with Trackid: '.$this->trackid,
                'msg' => 'You need to get in touch with us with your Order Number:'.$this->trackid.' to retrieve this Gift Card',

                'data' => null,
            ) );
        }
        else{
            echo json_encode( array(
                'status' => 0,
                //'msg' => 'There is a problem while creating Gift card please contact Support team with Trackid: '.$this->trackid,
'msg' => 'يرجى الاتصال بنا و ارسال رقم طلبك التالي:'.$this->trackid.' من أجل االحصول على هديتك.',

                'data' => null,
            ) );
        }
	
	
	
	
	
	
	
	
	
	
	
	
/////////////Email Notifiers To List//////////////////////////////	
	
$sql = "select * from paymenthistory where trackid= '" . $this->trackid . "'";
$query12 = $this->db->query( $sql );
$reg_result12 = mysqli_fetch_assoc($query12);
$paymenthistoryid = $reg_result12["id"];
$userid = $reg_result12['userid'];	
$sql = "select * from product where id= '" . $reg_result12["productid"] . "'";
$query = $this->db->query( $sql );
$reg_result = mysqli_fetch_assoc($query);
$cardname= $reg_result["cardname"];
$price= $reg_result["actualprice"]." ".$reg_result['pricecurrency'];	
$quantity =1;

$userquery = $this->db->query("Select * from usermaster where userid = '".$userid."'");	
$getuserdetails = mysqli_fetch_assoc($userquery);	
$usergsm = $getuserdetails['gsm'];	
$username = $getuserdetails['firstname']. " " .$getuserdetails['lastname'] ;	
$useremail = $getuserdetails['emailid'];	
	
	
	
	
	
$query854 = $this->db->query("Select * from email_notifiers where status = 'active'");
while($getemails = mysqli_fetch_assoc($query854))
{

$name_notify = $getemails['name'];	
$email_notify = $getemails['email'];	
	
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
$msg.= '<p>Hello '.$name_notify.',</p>';
$msg.= "<p>Attention: Rewards Fulfillment Team. </p>";
$msg.= "<table border='1'>
<tr><td>Customer Name</td><td>Mobile Number</td><td>Email</td><td>Brand Ordered</td><td>Denomination</td><td>Quantity</td></tr>
<tr><td>".$username."</td><td>".$gsm."</td><td>".$useremail."</td><td>".$cardname."</td><td>".$price."</td><td>".$quantity."</td></tr>
</table><br/>";
	
	
	
	
	
	
	
	

$msg.= "<p>Regards</p>";

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
$a = mail($email_notify,$name_notify."FAILED TRANSACTIONS – GIFTI",$msg,$headers);	
	
	
if($a)
{
	 $in = $this->db->query("Insert into email_track (name_notify,email_notify,subject,username,usergsm,useremail,cardname,price,quantity,msg) Values ('".$name_notify."','".$email_notify."','FAILED TRANSACTIONS GIFTI','".$username."','".$usergsm."','".$useremail."','".$cardname."','".$price."','".$quantity."','".addslashes($msg)."')");
}	
	
	
	
	
	
}
} else {

    $b = json_decode($response);
   // $pricecurrency = $b->data->giftcards[0]->currency;
	$pricecurrency = $pricecurrency;
    $sql1 = "update paymenthistory set batchid='".$b->data->giftcards[0]->batchid."', giftcard_key='".$b->data->giftcards[0]->giftcard_key."', giftcard_number='".$b->data->giftcards[0]->giftcard_number."',card_id='".$b->data->giftcards[0]->card_id."', original_value='".$b->data->giftcards[0]->original_value."',remaining_value='".$b->data->giftcards[0]->remaining_value."',expiration_date='".$b->data->giftcards[0]->expiration_date."', currency='".$pricecurrency."',convert_rate='".$b->data->giftcards[0]->convert_rate."', style_image='".$b->data->giftcards[0]->style_image."', giftcard_url='".$b->data->giftcards[0]->giftcard_url."', campaign_id='".$b->data->giftcards[0]->campaign_id."' where trackid= '" . $this->trackid . "'"; 
    $result1 = $this->db->query($sql1);
        if( $this->db->affected_rows > 0 ) {
            $data["batchid"] =$b->data->giftcards[0]->batchid;
            $data["giftcard_key"] =$b->data->giftcards[0]->giftcard_key;
            $data["giftcard_number"] =$b->data->giftcards[0]->giftcard_number;
            $data["card_id"] =$b->data->giftcards[0]->card_id;
            $data["original_value"] =$b->data->giftcards[0]->original_value;
            $data["remaining_value"] =$b->data->giftcards[0]->remaining_value;
            $data["expiration_date"] =$b->data->giftcards[0]->expiration_date;
          //  $data["currency"] =$b->data->giftcards[0]->currency;
            
			if($this->language == "1")
			{
			$data["currency"] = $pricecurrency;
			}
			
			
			
			if($this->language != "1")
			{
			if($pricecurrency=='OMR')
			{
			$data["currency"] = "ريال عماني"; 
			}
			
			
			if($pricecurrency=='USD')
			{
			$data["currency"] = "دولار أمريكي"; 
			}
			
			
			if($pricecurrency=='AED')
			{
			$data["currency"] = "درهم إماراتي"; 
			}
			
			if($pricecurrency=='SAR')
			{
			$data["currency"] = "الريال السعودي"; 
			}
			
			
			}
			
			
			
			
			
			
			
			
			$data["convert_rate"] =$b->data->giftcards[0]->convert_rate;
            //$data["style_image"] =$b->data->giftcards[0]->style_image;
			
			
		$data["style_image"] ="http://doodle.meritincentives.com/img/product/".$imagecard;
            $data["giftcard_url"] =$b->data->giftcards[0]->giftcard_url;
            $data["campaign_id"] =$b->data->giftcards[0]->campaign_id;
            $data["paymenthistoryid"] = $paymenthistoryid;
           
			
			
			
			
		$sql = "select * from paymenthistory where trackid= '" . $this->trackid . "'";
        $query = $this->db->query( $sql );
        $reg_result = mysqli_fetch_assoc($query);
		$userid = $reg_result['userid'];
			
		$sql = "select * from product where id= '" . $reg_result["productid"] . "'";
        $query = $this->db->query( $sql );
        $reg_result1 = mysqli_fetch_assoc($query);	
			
			
			
        $query3 = $this->db->query("SELECT * FROM `usermaster` where userid = '".$userid."'");
		$fe = mysqli_fetch_assoc($query3);
		$name = $fe['firstname'];	
		$gsm = $fe['gsm'];	
			
		$cardname = 	$reg_result1['cardname'];
		$cardnamearabic = 	$reg_result1['cardnamearabic'];
	
			
	/////////////////SMS////////////////////	
if($this->language == "1")
{
$msg = urlencode("Thank you for purchasing ( ".$cardname." ) . For queries, please send an email to support.gifti@meritincentives.com or send WhatsApp message on +968 99372653.");
}
if($this->language != "1")
{
$msg = urlencode("شكرًا لك لشراء بطاقة الهدايا الإلكترونية ( ".$cardnamearabic." ).للاستفسارات ، يرجى إرسال رسالة الكترونية إلى support.gifti@meritincentives.com أو إرسال رسالة WhatsApp على +968 99372653.");

}			









$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.smsglobal.com/http-api.php?action=sendsms&user=rlm2it40&password=wNLkOwao&maxsplit=8&from=GIFTI&to=968".$gsm."&text=$msg",

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

			
			/////////////////////Email/////////////////////////////////
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
$msg.= '<p>Hello'.$name.',</p>';
$msg.= "<p>We are pleased that you have purchased (".$cardname.") e-Gift card. We hope you are enjoying the convenience of the Gifti app. 
</p>";
$msg.= "<p>You can also check the same from the Gifts Purchased section on your Gifti app.
</p>";
$msg.= "<p>If you have any questions concerning your e-Gift card or Gifti app, please feel free to send an email to support.gifti@meritincentives.com. You can also reach via WhatsApp on +968 99372653.</p>";
$msg.= "<p>Again, thank you for your purchase.</p>";

$msg.= "<p>Regards</p>";

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
$a = mail($fe['emailid'],$name."  your purchase is successful, enjoy exciting vouchers with your Gifti app.!",$msg,$headers);
}		

			
			
if($this->language != "1")			
{

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
                $msg.= '<p style="text-align:right;">مرحبا'. $name .'</p>';
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
                // $msg = "Dear".$full_name.", \n\n Your Password = ".$password;
$a = mail($fe['emailid'],$name."عملية الشراء ناجحة وتمتع بقسائم مثيرة من خلال تطبيق Gifti الخاص بك.!",$msg,$headers);

			

}
			
			
			
			
			
	//////////////////////////////////////////////////////////////////		
			
			
            echo json_encode( array(
                'status' => 1,
                'msg' => 'Successfully',
                'data' => $data
            ) ); 
        }


   }

}

}
public function getgiftreferral(){

  $curl = curl_init();

  curl_setopt_array($curl, array(
 CURLOPT_URL => "https://testapi.meritincentives.com/api/v1/currency/giftcards",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "giftcard%5Bvendor_id%5D=VID_OAB&giftcard%5Bquantity%5D=1&giftcard%5Bcampaign_id%5D=".$this->campaignId."&giftcard%5Bdenomination%5D=".$this->actualPrice."&undefined=",
  CURLOPT_HTTPHEADER => array(
    "Authorization: bearer secret_live_M9d9tWXFUG_IblAjVjkwPl7QKRyP7Z4cKad8hQNxohE",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 5d32623d-3a6b-47a8-8b53-980be3797acc",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    $sql1 = "insert into paymenthistory(batchid,giftcard_key, giftcard_number,card_id,original_value,remaining_value,expiration_date,currency,convert_rate,style_image,giftcard_url,campaign_id,referralproductid,userid) values('error','error','error','error','error','error','error','error','error','error','error','".$this->campaignId."','".$this->productid."','".$this->userid."')"; ///need to be done by monica
    $result1 = $this->db->query($sql1);
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 0,
                'msg' => 'There was a problem generating a Gift card our Support team can sort it out you get in touch',
                'data' => null,
            ) );

        }
        else{
            echo json_encode( array(
                'status' => 0,
'msg' => 'حدثت مشكلة ما أثناء انشاء بطاقة هدايا. يمكن لفريق الدعم لدينا حل المشكلة إذا تواصلت معهم.',                'data' => null,
             ) );

        }
 
} else {
  $a = json_decode($response);
  $batchid = $a->data->giftcard->batch_id;  
 
  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://testapi.meritincentives.com/api/v1/currency/giftcards?vendor_id=VID_OAB&batch_id=".$batchid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "undefined=",
  CURLOPT_HTTPHEADER => array(
    "Authorization: bearer secret_live_M9d9tWXFUG_IblAjVjkwPl7QKRyP7Z4cKad8hQNxohE",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 6a73272d-9a7a-436c-8176-2f288af2dc57",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    $sql1 = "insert into paymenthistory(batchid,giftcard_key, giftcard_number,card_id,original_value,remaining_value,expiration_date,currency,convert_rate,style_image,giftcard_url,campaign_id,referralproductid,userid) values('".$batchid."','error','error','error','error','error','error','error','error','error','error','".$this->campaignId."','".$this->productid."','".$this->userid."')";
    $result1 = $this->db->query($sql1);
       if($this->language == "1"){
            echo json_encode( array(
                'status' => 0,
                'msg' => 'There was a problem generating a Gift card our Support team can sort it out if you get in touch',
                'data' => null,
            ) );

        }
        else{
            echo json_encode( array(
                'status' => 0,
'msg' => 'حدثتت مشكلة ما أثناء انشاء بطاقة هدايا. يمكن لفريق الدعم لدينا حل المشكلة إذا تواصلت معهم.',                'data' => null,
             ) );

        }
} else {

    $b = json_decode($response);
    $sql1 = "insert into paymenthistory(batchid,giftcard_key, giftcard_number,card_id,original_value,remaining_value,expiration_date,currency,convert_rate,style_image,giftcard_url,campaign_id,referralproductid,userid) values('".$b->data->giftcards[0]->batchid."','".$b->data->giftcards[0]->giftcard_key."','".$b->data->giftcards[0]->giftcard_number."','".$b->data->giftcards[0]->card_id."','".$b->data->giftcards[0]->original_value."','".$b->data->giftcards[0]->remaining_value."','".$b->data->giftcards[0]->expiration_date."','".$b->data->giftcards[0]->currency."','".$b->data->giftcards[0]->convert_rate."','".$b->data->giftcards[0]->style_image."','".$b->data->giftcards[0]->giftcard_url."','".$this->campaignId."','".$this->productid."','".$this->userid."')";

    $result1 = $this->db->query($sql1);
        if( $this->db->affected_rows > 0 ) {
            $data["batchid"] =$b->data->giftcards[0]->batchid;
            $data["giftcard_key"] =$b->data->giftcards[0]->giftcard_key;
            $data["giftcard_number"] =$b->data->giftcards[0]->giftcard_number;
            $data["card_id"] =$b->data->giftcards[0]->card_id;
            $data["original_value"] =$b->data->giftcards[0]->original_value;
            $data["remaining_value"] =$b->data->giftcards[0]->remaining_value;
            $data["expiration_date"] =$b->data->giftcards[0]->expiration_date;
            $data["currency"] =$b->data->giftcards[0]->currency;
            $data["convert_rate"] =$b->data->giftcards[0]->convert_rate;
            $data["style_image"] =$b->data->giftcards[0]->style_image;
            $data["giftcard_url"] =$b->data->giftcards[0]->giftcard_url;
            $data["campaign_id"] =$b->data->giftcards[0]->campaign_id;

            echo json_encode( array(
                'status' => 1,
                'msg' => 'Successfully',
                'data' => $data
            ) ); 
        }


   }

 }

  
}
public function activategift(){

  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://testapi.meritincentives.com/api/v1/currency/giftcards/activate",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "giftcard%5Bgiftcard_number%5D=".$this->cardnumber,
  CURLOPT_HTTPHEADER => array(
    "Authorization: bearer secret_live_M9d9tWXFUG_IblAjVjkwPl7QKRyP7Z4cKad8hQNxohE",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 5d32623d-3a6b-47a8-8b53-980be3797acc",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$redp = json_decode($response);
if ($redp->code == "400") {
    if($this->language == "1"){
        echo json_encode( array(
            'status' => 0,
            'msg' => 'Something went wrong…'
                            
        ) );
    }
    else{
        echo json_encode( array(
            'status' => 0,
            'msg' => 'حدث خطأ ما...'
                            
        ) );
    }
    

} else {
    $a = json_decode($response);

    $sql1 = "update paymenthistory set cardactive='1', cardstate='".$a->data->distributor_giftcard->state."', activationtransaction_date='".$a->data->distributor_giftcard->transaction_date."',activationtransaction_timestamp='".$a->data->distributor_giftcard->transaction_timestamp."' where giftcard_number= '" . $this->cardnumber. "'"; 
    $result1 = $this->db->query($sql1);
    if( $this->db->affected_rows > 0 ) {
                           
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 1,
                'msg' => 'Card Activated Successfully'
                        
            ) ); 
        }
        else{
            echo json_encode( array(
                'status' => 1,
                'msg' => 'تم تفعيل البطاقة بنجاح'
                        
            ) ); 
        }                           
    }
    else
    {
        if($this->language == "1"){
            echo json_encode( array(
                'status' => 0,
                'msg' => 'Whoops, something went wrong :('
                        
            ) );  
        }
        else{
            echo json_encode( array(
                'status' => 0,
                'msg' => 'عفوًا، حدث خطأ ما :('
                        
            ) );  
        }

    }


   }

}

public function sharinggiftcard(){
        $sql = "update paymenthistory set isshared='1' where id= '" . $this->giftcard_number . "'";
        $query = $this->db->query($sql);
        $sql = "select * from paymenthistory where id= '" . $this->giftcard_number . "'";
        
         //echo $sql;
        $query = $this->db->query($sql);
        $reg_result = mysqli_fetch_assoc($query);
        $data  = array();
            
        if (!empty($reg_result)) {

            echo json_encode( array(
                'status' => 1,
                'msg' => 'Successfully',
                'promocode'=> $reg_result["sharingcode"]
                                                            
            ) );
        }
        else{
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'Whoops, something went wrong :(',
                    'promocode'=> ''
                    
                ) );  
            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'عفوًا، حدث خطأ ما :(',
                    'promocode'=> ''
                    
                ) );  
            }

        }

}
public function createsupport(){
        
        $sql = "select * from usermaster where userid= '" . $this->userid . "'";
        $query = $this->db->query( $sql );
        $reg_result = mysqli_fetch_assoc($query);
        $data  = array();

        if (!empty($reg_result)) {

        $sql = "insert into support(userid,email,phonenumber,message)VALUES('" . $this->userid . "','" . $this->email . "','" . $this->phonenumber . "','" . $this->message . "')";
        $query = $this->db->query( $sql );
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 1,
                    'msg' => 'Support ticket Create Successfully',
               
                ) );
            }
            else{
                echo json_encode( array(
                    'status' => 1,
                    'msg' => 'تم انشاء بطاقة الدعم بنجاح',
               
                 ) );
            }
        } 
        else {
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'Whoops, something went wrong :('
                               
                                
                ) );  
            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'عفوًا، حدث خطأ ما :('
                ) );  
            }

        }
}


 public function applyoabcard(){
        
        //$sql = "select * from oabcard where userid= '" . $this->userid . "'";
       $sql = "select * from oabcard where userid= '" . $this->userid . "' or emailid='".$this->emailid."' or phone='".$this->phone."'";
       $query = $this->db->query( $sql );
       $reg_result = mysqli_fetch_assoc($query);

       $emailid=$reg_result["emailid"];
       $phone=$reg_result["phone"];

        if (!empty($reg_result)) {
            if($this->language == "1"){
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'Your request has already been submitted',
                                
                ) );
            }
            else{
                echo json_encode( array(
                    'status' => 0,
                    'msg' => 'تم تقديم طلبك مسبقا',
                                
                ) );
            }
        } else {

            $sql = "insert into oabcard(userid,name,emailid,phone,city,civilid,employer,salaryrange,isoabcustomer)VALUES('" . $this->userid . "','" . $this->name . "','" . $this->emailid . "','" . $this->phone . "','" . $this->city . "','" . $this->civilid . "','" . $this->employer . "','" . (int)$this->salaryrange . "','" . $this->isoabcustomer . "')";
            $query = $this->db->query( $sql );

            if( $this->db->affected_rows > 0 ) {

                $sql = "select * from oabcard where userid= '" . $this->userid . "'";
                $query = $this->db->query( $sql );
                $reg_result = mysqli_fetch_assoc($query);

                    if (!empty($reg_result)) {
                        $data["userid"] = $reg_result["userid"];
                        $data["name"] = $reg_result["name"];
                        $data["emailid"] = $reg_result["emailid"];
                        $data["phone"] = $reg_result["phone"];
                        $data["city"] = $reg_result["city"];
                        $data["civilid"] = $reg_result["civilid"];
                        $data["employer"] = $reg_result["employer"];
                        $data["salaryrange"] = $reg_result["salaryrange"];
                        $data["isoabcustomer"] = $reg_result["isoabcustomer"];
                    if($data["isoabcustomer"] == 1){
                        $data["isoabcustomer"] = Yes;
                    }
                    else{
                        $data["isoabcustomer"] = No;
                    }
                                
                            //mail here
                            
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
                    $msg.= '<p>Name '. $reg_result["name"] .',</p>';
                    $msg.= '<p>Admin'. $reg_result["emailid"] .'</p>';
                    $msg.= '<p>Phone:'. $reg_result["phone"] .'</p>';
                    $msg.= '<p>City:'. $reg_result["city"] .'</p>';
                    $msg.= '<p>Civilid:'. $reg_result["civilid"] .'</p>';
                    $msg.= '<p>Employer:'. $reg_result["employer"] .'</p>';
                    $msg.= '<p>SalaryRange:'. $reg_result["salaryrange"] .'</p>';
                    $msg.= '<p>Is OAB Customer:'.  $data["isoabcustomer"] .'</p>';
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
                    $a = mail("mmahad1@kpmg.com","Apply For OAB Card Request Received",$msg,$headers);
                        if($this->language == "1"){
                            echo json_encode( array(
                                'status' => 1,
                                'msg' => 'Success! Your OAB card has been applied',
                                    'userdetails' => $data
                            ) );
                        }
                        else{
                            echo json_encode( array(
                                'status' => 1,
                                'msg' => 'رائع! تم تقديم بطاقة بنك عمان العربي بنجاح',
                                'userdetails' => $data
                            ) );
                        }


                               
                    }

            } 
            else {
                if($this->language == "1"){
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'Something went wrong…'
                                                        
                    ) );
                }
                else{
                    echo json_encode( array(
                        'status' => 0,
                        'msg' => 'حدث خطأ ما.'
                                                        
                    ) );
                }
            }
        }
   }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
public function versioncheck() {
$sql = "select * from version order by id desc";
$query = $this->db->query( $sql);
$k = 0;
$row = mysqli_fetch_assoc($query);
$k = mysqli_num_rows($query);	
$currentversion = $this->currentversion;
$dbversion = $row['version'];	
if($currentversion<$dbversion)
{
if($this->language == "1"){
echo json_encode( array(
'status' => 1,
'version' => $dbversion,
'msg' => "Update available Check out the latest version available of Gifti"
));
}
if($this->language != "1"){
echo json_encode( array(
'status' => 1,
'version' => $dbversion,
'msg' => "التحديث متوفر. الرجاء تحميل الإصدار الأخير  "
));
}

}
	else{
		
		echo json_encode( array(
'status' => 2,
));
	}



}
 	
	
	
	
	
	
public function versioncheckandroid() {
$currentversion = $this->currentversion;
$dbversion = 10;	
if($currentversion<$dbversion)
{
if($this->language == "1"){
echo json_encode( array(
'status' => 1,
'version' => $dbversion,
'msg' => "Update available Check out the latest version available of Gifti"
));
}
if($this->language != "1"){
echo json_encode( array(
'status' => 1,
'version' => $dbversion,
'msg' => "التحديث متوفر. الرجاء تحميل الإصدار الأخير  "
));
}

}
else{

echo json_encode( array(
'status' => 0,
'version' => '',
'msg' => ""			
));
	}



}	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>
