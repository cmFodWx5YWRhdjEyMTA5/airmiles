<?php
require_once 'classDatabase.php';
class Tutorials {
    private $db;
    private $table_name = "howtotutorial";
    public $id;
    public $icon;
    public $title;
    public $titlearabic;
    public $image;
      public $language;

   
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
        $sql = "insert into " . $this->table_name. "(icon,title,titlearabic,image,language)VALUES('" . $this->icon . "','" . $this->title . "','" . $this->titlearabic . "','" . $this->image . "','" . $this->language . "')";

        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Tutorial Created Successfully',
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
            $sql .= " AND ( cat.reg_fname LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR ( cat.reg_lname LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR ( cat.reg_email LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR ( cat.language LIKE '" . $data['language'] . "%' ";

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
            $json[$k]['icon'] = "<img src='../img/howtotutorial/".$row['icon']."' width='150px' /> ";
            $json[$k]['title'] = $row['title'];
            $json[$k]['titlearabic'] = $row['titlearabic'];
            $json[$k]['image'] = "<img src='../img/howtotutorial/".$row['image']."' width='150px' /> ";
            
            $json[$k]['actions'] = '<button type="button" data-id = "'.$row['id'].'"  class="edit_Clients btn ink-reaction btn-floating-action btn-xs btn-info" data-toggle="tooltip" data-placement="top"  data-original-title="Edit" title="Edit">
	     			<i class="fa fa-pencil"></i> Edit

	     		</button>
	       		<button type="button" data-id = "'.$row['id'].'" class="delete_Clients btn ink-reaction btn-floating-action btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete">
              		<i class="fa fa-remove"></i> Delete
            	</button>';
				$json[$k]['language'] = $row['language'];

            $k++;

        }
        return $json;

    }

     public function getslider(  ) {
        $json = array();
		// $sencondquery = $this->db->query("ALTER TABLE " . $this->table_name . " ADD COLUMN language TEXT NOT NULL AFTER image");
         $sql = "select * from " . $this->table_name . "  order by id asc";

        $query = $this->db->query( $sql);

        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr'] = $k+1;
      $json[$k]['image'] ="https://gifticms.meritincentives.com/admin/img/howtotutorial/".$row['image'];
            $json[$k]['language'] = $row['language'];

            $k++;

        }
                 if($k >0){
                                                        echo json_encode( array(
                                                                'status' => 1,
                                                                'count' => $k,
                                                                'msg' => "Here is All Slider",
                                                               'tutorial' => $json
                                                            ) );
                                                        }
                                                        else
                                                        {
                                                            echo json_encode( array(
                                                                'status' => 0,
                                                                'count' => $k,
                                                                'msg' => "No Slider Available"
                                                               
                                                            ) );

                                                        }

    }

    public function get_total_noof_records(){

        $sql = $this->temp;

        $query = $this->db->query( $sql );

        return $query->num_rows;
    }

    public function update(){
        $sql = "UPDATE " . $this->table_name . " set `icon`='" . $this->icon . "',`title`='" . $this->title . "',`titlearabic`='" . $this->titlearabic . "',`image`='" . $this->image . "',`language` = '" . $this->language . "' where id=" . $this->id;

		
		
		
		
        $query = $this->db->query( $sql );

        if( $this->db->affected_rows > 0 ) {
            echo json_encode( array(
                'status' => true,
                'msg' => 'Tutorial Updated Successfully',
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
                'msg' => 'Slider Deleted Successfully',
            ) );
        } else {
            echo json_encode( array(
                'status' => false,
                'msg' => 'Slider is not deleted or doesn\'t exist in system',
            ) );
        }
    }

}
?>
