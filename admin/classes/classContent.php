<?php
require_once 'classDatabase.php';
class Content {
    private $db;
    private $table_name = "content";
    public $id;
    public $keycode;
  
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

        $sql = "select * from " . $this->table_name;

        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);

    }
 
   
    public function getdata(){

        $sql = "select * from ".$this->table_name." where appid='".$this->appid."' and option_key='".$this->key."' ";
            $json = array();
        $result = $this->db->query($sql);
 
        while ($row = mysqli_fetch_assoc($result)) {
 
                $response['content'] = $row['option_value'];
              
            }
        echo json_encode(array("status"=>1,'msg'=>$response));
        
    }
     public function get_contentwelcome(){

        $sql = "select * from ".$this->table_name." where appid='".$this->appid."' and option_key='".$this->title."' ";
            $json = array();
        $result = $this->db->query($sql);
 
        while ($row = mysqli_fetch_assoc($result)) {
 
                $response['title'] = $row['option_value'];
              
            }


        $sql = "select * from ".$this->table_name." where appid='".$this->appid."' and option_key='".$this->text."' ";
            
        $result = $this->db->query($sql);
 
        while ($row = mysqli_fetch_assoc($result)) {
 
                $response['text'] = $row['option_value'];
              
            }
            
        echo json_encode(array("status"=>1,'msg'=>$response));
        
    }
    
    

   
}
?>
