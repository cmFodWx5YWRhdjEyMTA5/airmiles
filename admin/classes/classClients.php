<?php
require_once 'classDatabase.php';
class Clients {
    private $db;
    private $table_name = "referrals";
    public $id;
    public $reg_fname;
    public $reg_lname;
    public $is_active;
    public $reg_email;
public $reg_phone;
public $reg_gender;
public $reg_whatsappnumber;
public $reg_skype;
public $reg_brithdate;
public $password;
public $reg_canviewdetails;
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

        $sql = "select * from " . $this->table_name . " where is_delete = 0";

        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);

    }
 public function create(){
        $sql = "insert into " . $this->table_name. "(logo,title,subtitle,text,email)VALUES('" . $this->logo . "','" . $this->title . "','" . $this->subtitle . "','" . $this->text . "','" . $this->email . "')";

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Referrals Created Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Referrals Already Updated',
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
        if( !$this->dbtb_query ) { return; }
        $query = $this->db->query( $this->dbtb_query );

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr'] = $k+1;
            $json[$k]['logo'] = "<img src='../img/".$row['logo']."'' /> ";
            $json[$k]['title'] = $row['title'];
            $json[$k]['subtitle'] = $row['subtitle'];
              $json[$k]['text'] = $row['text'];
                $json[$k]['email'] = $row['email'];

            

            // $sqlq = "select * from question_master qm where qm.is_delete=0 LIMIT 0,3";
            // $queryq = $this->db->query($sqlq);
            // // print_r($queryq);
            //     if( mysqli_num_rows($queryq) > 0) {
            //         $qc = 1;
            //         while ($rowa = mysqli_fetch_assoc($queryq)) {
            //         $sqla = "select * from answer_master am where am.question_id=".$rowa['id']." and am.user_id=".$row['id'];
            //         $querya = $this->db->query($sqla);
            //         $rowaa = mysqli_fetch_assoc($querya);
            //         $que_cnt = 'question'.$qc;
            //         $json[$k][$que_cnt] = $rowaa['answer'];
            //         $qc++;
            //     }
            // }
            // $json[$k]['device_type']
            // $json[$k]['device_type']
            // if($row['device_type'] == 1){
            //     $json[$k]['device_type'] = 'Iphone';
            // }else {
            //     $json[$k]['device_type'] = 'Android';
            // }
            // $json[$k]['reg_created'] = date('d/m/Y',strtotime($row['reg_created']));
            // if($row['is_active'] == 1){
            //     $json[$k]['is_active'] = 'Active';
            // }else {
            //     $json[$k]['is_active'] = 'InActive';
            // }

            
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
        $sql = "UPDATE " . $this->table_name . " set `logo`='" . $this->logo . "',`title`='" . $this->title . "',`subtitle`='" . $this->subtitle . "',`text`='" . $this->text . "',`email`='" . $this->email . "' where id=" . $this->id;

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Referrals Updated Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Error Occured',
            ) );
        }
    }

 public function updatebit(){
        $sql = "UPDATE " . $this->table_name . " set `reg_canviewdetails`='" . $this->reg_canviewdetails . "' where id=" . $this->id;

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'User is successfully Updated',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'User is Already Updated',
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
                'msg' => 'Referrals Deleted Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Referrals is not deleted or doesn\'t exist in system',
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
     public function get_question_answer( $id ) {
        $sql = "select * from question_master qm where qm.is_delete=0";
        $query = $this->db->query($sql);
        if( mysqli_num_rows($query) > 0) {
            $msg ="";
            while ($row = mysqli_fetch_assoc($query)) {
                $sqla = "select * from answer_master am where am.question_id=".$row['id']." and am.user_id=".$id;
                $querya = $this->db->query($sqla);
                $rowa = mysqli_fetch_assoc($querya);
                $msg .= '<div class="form-group" >';
                $msg .= '<label for="exampleInputEmail1">'.$row['question'].'</label>';
                // $msg .= '    <input type="hidden" value="'.$row['id'].'" name="hdn_ids[]"> ';
                $msg .= '    <label class="form-control ckeditor" id="question_'.$row['id'].'" name="answer[]" aria-describedby="" placeholder="Enter Answer">'.$rowa['answer'].'</label>';
                $msg .= '</div>';
                // print_r($rowa);
            }
            return json_encode( array(
                'status' => true,
                'msg' => $msg,
            ) );
            // return  $msg;
        }

    }
    public function get_images( $id ) {
        $sql = "SELECT * FROM user_data where user_id = ".$id." and is_delete= 0";
        $query = $this->db->query($sql);
        if( mysqli_num_rows($query) > 0) {
            $msg ="";
            while ($row = mysqli_fetch_assoc($query)) {
                $msg .= '<tr>';
                $msg .= '<td><a href="uploads/'.$row['image_name'].'" download>'.$row['image_name'].'</a></td>';
                $msg .= '</tr>';
            }
            return json_encode( array(
                'status' => true,
                'msg' => $msg,
            ) );
            // return  $msg;
        }else{
            return json_encode( array(
                'status' => false,
                'msg' => '<tr><td>No Files</td></tr>',
            ) );
        }

    }
}
?>
