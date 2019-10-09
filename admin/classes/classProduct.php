<?php
require_once 'classDatabase.php';
class Product {
    private $db;
    private $table_name = "product";
    public $id;
    public $categoryid;
    public $image;
    public $featuredimage;
    public $cardname;
    public $cardnamearabic;
    public $termscondition;
    public $termsconditionarabic;
    public $pricefornonoab;
    public $priceforoab;
    public $actualprice;
    public $pricecurrency;
    public $currencycode;
    public $campaign_id;
    public $campaign_name;
    public $discount;
    public $cardbutton1;
    public $cardbutton2;
    public $cardbutton2arabic;
    
 
   
    //public $temp;
    public $dbtb_query;


    function __construct($db) {
        # code...
        $this->db = $db;
    }

    function __destruct() {
        $this->db->close();
    }

    public function selectAll() {

        $sql = "select * from " . $this->table_name . " where is_delete = 0";

        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);

    }
 public function create(){
    if($this->pricecurrency == "512"){
        $curren = "OMR";
    }else if($this->pricecurrency == "840"){
        $curren = "USD";
    }else if($this->pricecurrency == "784"){
        $curren = "AED";
    }else if($this->pricecurrency == "682"){
        $curren = "SAR";
    }
        $sql = "insert into " . $this->table_name. "(categoryid,image,featuredimage,cardname,cardnamearabic,termscondition,termsconditionarabic,pricefornonoab,priceforoab,actualprice,pricecurrency,currencycode,campaign_id,campaign_name,discount,cardbutton1,cardbutton2,cardbutton2arabic)VALUES('" . $this->categoryid . "','" . $this->image . "','" . $this->featuredimage . "','" . $this->cardname . "','" . $this->cardnamearabic . "','" . $this->termscondition . "','" . $this->termsconditionarabic . "','" . $this->pricefornonoab . "','" . $this->priceforoab . "','" . $this->actualprice . "','" . $curren . "','" . $this->pricecurrency . "','" . $this->campaign_id . "','" . $this->campaign_name . "','" . $this->discount . "','" . $this->cardbutton1 . "','" . $this->cardbutton2 . "','" . $this->cardbutton2arabic . "')";

	 
	 
        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Product Created Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Error Occured',
            ) );
        }
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
            $sql .= " where cat.image LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.featuredimage LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.cardname LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.cardnamearabic LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.brandname LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.termscondition LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.termsconditionarabic LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.pricefornonoab LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.priceforoab LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.actualprice LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.pricecurrency LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.currencycode LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.discount LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.campaign_id LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.campaign_name LIKE '%" . $data['sSearch'] . "%' ";

   
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
        if( !$this->dbtb_query ) { return; }
        $query = $this->db->query( $this->dbtb_query );

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr'] = $k+1;
            $json[$k]['image'] = "<img src='../img/product/".$row['image']."' width='150px' /> ";
            $json[$k]['cardname'] = $row['cardname'];
            $json[$k]['termscondition'] = $row['termscondition'];
            $json[$k]['pricefornonoab'] = $row['pricefornonoab'];
            $json[$k]['priceforoab'] = $row['priceforoab'];
            $json[$k]['campaign_id'] = $row['campaign_id'];

            if($row['isactive'] == "1"){
                $json[$k]['isactive'] = '<button type="button" data-id = "'.$row['id'].'" class="markisactive0 btn ink-reaction btn-floating-action btn-xs btn-success" >
                    <i class="fa fa-check"></i>
                </button>';}
            else{
                 $json[$k]['isactive'] = '<button type="button" data-id = "'.$row['id'].'" class="markisactive1 btn ink-reaction btn-floating-action btn-xs btn-danger" >
                    <i class="fa fa-times"></i>
                </button>';        
                }
                  
                  
            $json[$k]['language'] = $row['language'];
              

            if($row['id'] == 24){
              $json[$k]['actions'] = '<button type="button" data-id = "'.$row['id'].'"  class="edit_Clients btn ink-reaction btn-floating-action btn-xs btn-info" data-toggle="tooltip" data-placement="top"  data-original-title="Edit" title="Edit">
                    <i class="fa fa-pencil"></i> Edit
                </button>';

            }
            else{

              $json[$k]['actions'] = '<button type="button" data-id = "'.$row['id'].'"  class="edit_Clients btn ink-reaction btn-floating-action btn-xs btn-info" data-toggle="tooltip" data-placement="top"  data-original-title="Edit" title="Edit">
                    <i class="fa fa-pencil"></i> Edit
                </button>
                <button type="button" data-id = "'.$row['id'].'" class="delete_Clients btn ink-reaction btn-floating-action btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete">
                    <i class="fa fa-remove"></i> Delete
                </button>';
                }
            
            $k++;

        }
        return $json;

    }

     

    public function get_total_noof_records(){

        $sql = $this->temp;

        $query = $this->db->query( $sql );

        return $query->num_rows;
    }

    public function getcategories() {
        $json = '';
         $sql = "select * from " . $this->table_name ."";

        $result = $this->db->query($sql);

        $k = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $json .='<option value="'.$row["id"].'">'.$row["name"].'</option>'; 
        }
        //echo $json;
        return $json;

    }

    public function update(){
          if($this->pricecurrency == "512"){
        $curren = "OMR";
    }else if($this->pricecurrency == "840"){
        $curren = "USD";
    }else if($this->pricecurrency == "784"){
        $curren = "AED";
    }else if($this->pricecurrency == "682"){
        $curren = "SAR";
    }
    
        $sql = "UPDATE " . $this->table_name . " set `categoryid`='" . $this->categoryid . "',`image`='" . $this->image . "',`featuredimage`='" . $this->featuredimage . "',`cardname`='" . $this->cardname . "',`cardnamearabic`='" . $this->cardnamearabic . "',`termscondition`='" . $this->termscondition . "',`termsconditionarabic`='" . $this->termsconditionarabic . "',`pricefornonoab`='" . $this->pricefornonoab . "',`priceforoab`='" . $this->priceforoab . "',`actualprice`='" . $this->actualprice . "',`pricecurrency`='" . $curren . "',`currencycode`='" . $this->pricecurrency . "',`campaign_id`='" . $this->campaign_id . "',`campaign_name`='" . $this->campaign_name . "',`discount`='" . $this->discount . "',`cardbutton1`='" . $this->cardbutton1 . "',`cardbutton2`='" . $this->cardbutton2 . "',`cardbutton2arabic`='" . $this->cardbutton2arabic . "' where id=" . $this->id;

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Product Updated Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Error Occured',
            ) );
        }
    }


    public function markisactive1($id){
        $sql = "UPDATE " . $this->table_name . " set `isactive`='1' where id=" . $id;

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'product is successfully Updated',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Product is Already Updated',
            ) );
        }
    }
    public function markisactive0($id){
        $sql = "UPDATE " . $this->table_name . " set `isactive`='0' where id=" . $id;

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Product is successfully Updated',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Product is Already Updated',
            ) );
        }
    }

    public function deleteById( $cid ){

        if( !$cid ) { return; }

        $sql = "delete from " . $this->table_name . " where id=" . $cid;

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Category Deleted Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Category is not deleted or doesn\'t exist in system',
            ) );
        }
    }

}
?>
