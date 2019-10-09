<?php
/*require_once 'admin/classes/classDatabase.php'; 

class Dashboard {
    private $db;
    public $id;
   
    function __construct($db) {
        # code...
        $this->db = $db;
    }

    function __destruct() {
        $this->db->close();
    }
    

public function productbyid() {
        
        $json = array();
        $sql = "SELECT * FROM paymenthistory  order by id desc";
        $query = $this->db->query( $sql);

	 $numrows = mysqli_num_rows($query);
	     $k = 0;
        $j = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            echo "asad";
            $json[$k]['trackid'] = $row['trackid'];
			  $json[$k]['batchid'] = $row['batchid']; 
			  $json[$k]['productid'] = $row['productid']; 
			  $json[$k]['userid'] = $row['userid']; 

			$selection2 = $this->db->query("Select cardname from product where id='".$row['productid']."'");
			$fetchio = mysqli_fetch_assoc($selection2);
			 $json[$k]['product'] = $row['cardname']; 
			

			
          //  $json[$k]['termscondition'] = $row['termscondition'];
           // $json[$k]['cardbutton2'] = $row['cardbutton2'];
       
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
                echo json_encode( array(
                    'status' => 0,'msg' => "Content here isn't available"
                            
                ));
            
         
        }
    }

	
	
	

}




if($_REQUEST['action'] == 'productbyid') {
    
    $ClientsObj = new Dashboard( $db );
    $ClientsObj->pid = !empty($_GET['pid']) ? $_GET['pid'] : false;
    $ClientsObj->productbyid();
    
}

*/








/*


$curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://giftapi.shopmygiftcards.com/api/v1/currency/giftcards?vendor_id=VID_OAB&batch_id=batch_48668bd177ae3845be",
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

*/
      
   $curl = curl_init();

  curl_setopt_array($curl, array(
 CURLOPT_URL => "https://giftapi.shopmygiftcards.com/api/v1/currency/giftcards",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "giftcard%5Bvendor_id%5D=VID_OAB&giftcard%5Bquantity%5D=1&giftcard%5Bcampaign_id%5D=product_bd4bba35386122f161&giftcard%5Bdenomination%5D=10&undefined=",
  CURLOPT_HTTPHEADER => array(
    "Authorization: bearer secret_live_iGRAD5X03NZSDfohKmYguCTiVXJ6_7B43rqek2c5KaU",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 5d32623d-3a6b-47a8-8b53-980be3797acc",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$redp = json_decode($response);
$p = json_encode($redp);
print_r($p);
?>
