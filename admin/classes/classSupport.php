<?php
require_once 'classDatabase.php';
class Support
{
    private $db;
    private $table_name = "support";
    public $id;
    public $name;
    public $username;
    public $password;
    public $isactive;
    
    
    //public $temp;
    public $dbtb_query;
    
    
    function __construct($db)
    {
        # code...
        $this->db = $db;
    }
    
    function __destruct()
    {
        $this->db->close();
    }
    
    public function selectAll()
    {
        
        $sql = "select * from " . $this->table_name . " where is_delete = 0";
        
        $result = $this->db->query($sql);
        
        return $result->fetch_all(MYSQLI_ASSOC);
        
    }
    public function create()
    {
        $sql1     = "select * from " . $this->table_name . " where user_name='" . $this->username . "'";
        $result1  = $this->db->query($sql1);
        $rowcount = mysqli_num_rows($result1);
        if ($rowcount <= 0) {
            $sql = "insert into " . $this->table_name . "(name,user_name,password,isactive)VALUES('" . $this->name . "','" . $this->username . "','" . $this->password . "','" . $this->isactive . "')";
            
            $query = $this->db->query($sql);
            
            if ($this->db->affected_rows > 0) {
                echo json_encode(array(
                    'status' => true,
                    'msg' => 'Admin Created Successfully'
                ));
            } else {
                echo json_encode(array(
                    'status' => false,
                    'msg' => 'Error Occured'
                ));
            }
        } else {
            echo json_encode(array(
                'status' => false,
                'msg' => 'UserName Already Exist'
            ));
            
        }
    }
    public function selectById($id)
    {
        
        $sql = "select * from " . $this->table_name . " where id = " . $id;
        
        $result = $this->db->query($sql);
        // print_r(mysqli_fetch_assoc($result));
        // exit(0);
        
        // return $result->fetch_all(MYSQLI_ASSOC);
        return mysqli_fetch_assoc($result);
    }
    public function getmerchant()
    {
        $json = '';
        $sql  = "select * from " . $this->table_name . " where isactive = '1'";
        
        $result = $this->db->query($sql);
        
        $k = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $json .= '<option value="' . $row["id"] . '">' . $row["businessname"] . '</option>';
        }
        //echo $json;
        return $json;
        
    }
    public function makeDatatableQuery($data)
    {
        
        $sql = "select SQL_CALC_FOUND_ROWS * from " . $this->table_name . " cat ";
        
        if (!empty($data['sSearch'])) {
            $sql .= " where cat.message LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.email LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR  cat.phonenumber LIKE '" . $data['sSearch'] . "%' ";
            $sql .= " OR cat.userid LIKE '" . $data['sSearch'] . "%' ";
        }
        $sql .= " ORDER BY cat.id DESC ";
        $this->temp = $sql;
        if (isset($data['iDisplayStart']) && $data['iDisplayLength'] != '-1') {
            $sql .= " LIMIT " . $data['iDisplayStart'] . ", " . $data['iDisplayLength'];
        }
        $this->dbtb_query = $sql;
        return $this->db->query($this->dbtb_query);
    }
    
    public function getClientsDataTable($data)
    {
        $json = array();
        if (!$this->dbtb_query) {
            return;
        }
        $query = $this->db->query($this->dbtb_query);
        
        $k = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $json[$k]['sr']       = $k + 1;
            $json[$k]['email']  = $row['email'];
            $json[$k]['phonenumber']    = $row['phonenumber'];
            $json[$k]['message']     = $row['message'];
            /*if ($row['isoabcustomer'] == "1") {
                $json[$k]['isoabcustomer'] = 'Yes';
            } else {
                
                $json[$k]['isoabcustomer'] = 'No';
            }*/
            
            
            if ($row['isresolved'] == "1") {
                $json[$k]['isresolved'] = '<button type="button" data-id = "' . $row['id'] . '" class="markisresolved0 btn ink-reaction btn-floating-action btn-xs btn-success" >
                    <i class="fa fa-check"></i>
                </button>';
            } else {
                $json[$k]['isresolved'] = '<button type="button" data-id = "' . $row['id'] . '" class="markisresolved1 btn ink-reaction btn-floating-action btn-xs btn-danger" >
                    <i class="fa fa-times"></i>
                </button>';
            }
            
            
            $json[$k]['actions'] = '
                   <button type="button" data-id = "' . $row['id'] . '" class="delete_Clients btn ink-reaction btn-floating-action btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete">
                      <i class="fa fa-remove"></i> Delete
                </button>';
            $k++;
            
        }
        return $json;
        
    }
    
    
    
    public function get_total_noof_records()
    {
        
        $sql = $this->temp;
        
        $query = $this->db->query($sql);
        
        return $query->num_rows;
    }
    
    public function update()
    {
        
        
        $sql = "UPDATE " . $this->table_name . " set `name`='" . $this->name . "',`user_name`='" . $this->username . "',`password`='" . $this->password . "',`isactive`='" . $this->isactive . "' where id=" . $this->id;
        
        
        
        $query = $this->db->query($sql);
        
        if ($this->db->affected_rows > 0) {
            echo json_encode(array(
                'status' => true,
                'msg' => 'Admin Updated Successfully'
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'msg' => 'Error Occured'
            ));
        }
    }
    
    
    
    public function markisresolved1($id)
    {
        $sql = "UPDATE " . $this->table_name . " set `isresolved`='1' where id=" . $id;
        
        $query = $this->db->query($sql);
        
        if ($this->db->affected_rows > 0) {
            echo json_encode(array(
                'status' => true,
                'msg' => 'Support is successfully Updated'
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'msg' => 'Support is Already Updated'
            ));
        }
    }
    public function markisresolved0($id)
    {
        $sql = "UPDATE " . $this->table_name . " set `isresolved`='0' where id=" . $id;
        
        $query = $this->db->query($sql);
        
        if ($this->db->affected_rows > 0) {
            echo json_encode(array(
                'status' => true,
                'msg' => 'Support is successfully Updated'
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'msg' => 'Support is Already Updated'
            ));
        }
    }
    public function updatebit()
    {
        $sql = "UPDATE " . $this->table_name . " set `reg_canviewdetails`='" . $this->reg_canviewdetails . "' where id=" . $this->id;
        
        $query = $this->db->query($sql);
        
        if ($this->db->affected_rows > 0) {
            echo json_encode(array(
                'status' => true,
                'msg' => 'User is successfully Updated'
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'msg' => 'User is Already Updated'
            ));
        }
    }
    
    public function deleteById($cid)
    {
        
        if (!$cid) {
            return;
        }
        
        $sql = "delete from " . $this->table_name . " where id=" . $cid;
        
        $query = $this->db->query($sql);
        
        if ($this->db->affected_rows > 0) {
            echo json_encode(array(
                'status' => true,
                'msg' => 'Support Deleted Successfully'
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'msg' => 'Support is not deleted or doesn\'t exist in system'
            ));
        }
    }
    
    public function redirect($location)
    {
        header('location:' . $location);
    }
    
    public function checkUnique($data)
    {
        $sql   = "select SQL_CALC_FOUND_ROWS * from " . $this->table_name . " where tag_no ='" . $data . "' and is_delete=0 ";
        $query = $this->db->query($sql);
        
        if ($query->num_rows == 1) {
            return true;
        } else {
            return false;
        }
        
        //return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    
}
?>