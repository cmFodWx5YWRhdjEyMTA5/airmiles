<?php
require_once 'classDatabase.php';
class Referralcards {
    private $db;
    private $table_name = "referralcards";
    public $id;
    public $categoryid;
    public $image;
    public $featuredimage;
    public $cardname;
    public $cardnamearabic;
    public $termscondition;
    public $termsconditionarabic;
    public $referralcount;
    public $actualprice;
    public $pricecurrency;
    public $campaign_id;
    public $campaign_name;
    
 
   
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
        $sql = "insert into " . $this->table_name. "(categoryid,image,featuredimage,cardname,cardnamearabic,termscondition,termsconditionarabic,referralcount,actualprice,pricecurrency,campaign_id,campaign_name)VALUES('" . $this->categoryid . "','" . $this->image . "','" . $this->featuredimage . "','" . $this->cardname . "','" . $this->cardnamearabic . "','" . $this->termscondition . "','" . $this->termsconditionarabic . "','" . $this->referralcount . "','" . $this->actualprice . "','" . $this->pricecurrency . "','" . $this->campaign_id . "','" . $this->campaign_name . "')";

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Referralcards Created Successfully',
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
       
        return mysqli_fetch_assoc($result);
    }


    public function makeDatatableQuery( $data ) {

        $sql = "select SQL_CALC_FOUND_ROWS * from " .
            $this->table_name . " cat ";

        if (!empty($data['sSearch'])) {
            $sql .= " where cat.cardname LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.cardname LIKE '%" . $data['sSearch'] . "%' ";
   
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
            $json[$k]['image'] = "<img src='../img/referralcards/".$row['image']."' width='150px' /> ";
            $json[$k]['cardname'] = $row['cardname'];
            $json[$k]['termscondition'] = $row['termscondition'];
            $json[$k]['referralcount'] = $row['referralcount'];
            $json[$k]['campaign_id'] = $row['campaign_id'];
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
        $sql = "UPDATE " . $this->table_name . " set `categoryid`='" . $this->categoryid . "',`image`='" . $this->image . "',`featuredimage`='" . $this->featuredimage . "',`cardname`='" . $this->cardname . "',`cardnamearabic`='" . $this->cardnamearabic . "',`termscondition`='" . $this->termscondition . "',`termsconditionarabic`='" . $this->termsconditionarabic . "',`referralcount`='" . $this->referralcount . "',`actualprice`='" . $this->actualprice . "',`pricecurrency`='" . $this->pricecurrency . "',`campaign_id`='" . $this->campaign_id . "',`campaign_name`='" . $this->campaign_name . "' where id=" . $this->id;

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Referralcards Updated Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Error Occured',
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
                'msg' => 'Referralcards Deleted Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Referralcards is not deleted or doesn\'t exist in system',
            ) );
        }
    }

}
?>
