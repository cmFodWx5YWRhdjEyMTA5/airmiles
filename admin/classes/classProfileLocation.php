<?php
require_once 'classDatabase.php';
class ProfileLocation {
    private $db;
    private $table_name = "profile_location";
    public $id;
    public $name;
     public $namearabic;
      public $createddate;

 
   
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
        $sql = "insert into " . $this->table_name. "(name,namearabic)VALUES('" . $this->name . "','" . $this->namearabic . "')";

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Profile Location Created Successfully',
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
            $sql .= " where cat.name LIKE '%" . $data['sSearch'] . "%' ";
            
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
         
            $json[$k]['name'] = $row['name'];
            $json[$k]['namearabic'] = $row['namearabic'];
            /*if($row['isactive'] == "1"){$json[$k]['isactive'] = 'Yes';}
                else{

            $json[$k]['isactive'] = 'No';        
                }*/
            
           
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
        $sql = "UPDATE " . $this->table_name . " set `name`='" . $this->name . "',`namearabic`='" . $this->namearabic . "' where id=" . $this->id;

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
