<?php
require_once 'classDatabase.php';
class Faq {
    private $db;
    private $table_name = "faq";
    public $id;
    public $question;
    public $questionarabic;
    public $answer;
    public $answerarabic;

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
        $sql = "insert into " . $this->table_name. "(question,questionarabic,answer,answerarabic)VALUES('" . $this->question . "','" . $this->questionarabic . "','" . $this->answer . "','" . $this->answerarabic . "')";

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'FAQ Created Successfully',
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
            $sql .= " where cat.question LIKE '%" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.questionarabic LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.answer LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR cat.answerarabic LIKE '" . $data['sSearch'] . "%' ";
            
        }
        $sql .= " ORDER BY cat.id DESC ";
        $this->temp = $sql;
        if (isset($data['iDisplayStart']) && $data['iDisplayLength'] != '-1') {
            $sql .= " LIMIT " . $data['iDisplayStart'] . ", " . $data['iDisplayLength'];
        }
        $this->dbtb_query = $sql;
        return $this->db->query( $this->dbtb_query );
    }

public function getlocation() {
        $json = '';
         $sql = "select * from " . $this->table_name . " where isactive = '1'";

        $result = $this->db->query($sql);

        $k = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $json .='<option value="'.$row["id"].'">'.$row["name"].'</option>'; 
        }
        //echo $json;
        return $json;

    }
    public function getClientsDataTable( $data ) {
        $json = array();
        if( !$this->dbtb_query ) { return; }
        $query = $this->db->query( $this->dbtb_query );

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr'] = $k+1;
         
            $json[$k]['question'] = $row['question'];
            $json[$k]['questionarabic'] = $row['questionarabic'];
            $json[$k]['answer'] = $row['answer'];
            $json[$k]['answerarabic'] = $row['answerarabic'];
            
           
            $json[$k]['actions'] = '<button type="button" data-id = "'.$row['id'].'"  class="edit_Clients btn ink-reaction btn-floating-action btn-xs btn-info" data-toggle="tooltip" data-placement="top"  data-original-title="Edit" title="Edit">
	     			<i class="fa fa-pencil"></i> Edit

	     		</button>
	       		<button type="button" data-id = "'.$row['id'].'" class="delete_Clients btn ink-reaction btn-floating-action btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete">
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
        $sql = "UPDATE " . $this->table_name . " set `question`='" . $this->question . "',`questionarabic`='" . $this->questionarabic . "',`answer`='" . $this->answer . "',`answerarabic`='" . $this->answerarabic . "' where id=" . $this->id;

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Profile Location Updated Successfully',
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
                'msg' => 'Profile Location Deleted Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Profile Location is not deleted or doesn\'t exist in system',
            ) );
        }
    }

    public function redirect( $location ) {
        header('location:'.$location);
    }

    public function checkUnique( $data ) {
        $sql = "select SQL_CALC_FOUND_ROWS * from " . $this->table_name . " where tag_no ='" . $data."' and is_delete=0 ";
        $query = $this->db->query($sql);

        if( $query->num_rows == 1){
            return true;
        }else{
            return false;
        }

        //return $result->fetch_all(MYSQLI_ASSOC);
    }
     
    
}
?>
