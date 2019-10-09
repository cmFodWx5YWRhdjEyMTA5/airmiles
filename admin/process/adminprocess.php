<?php
require_once '../classes/classAdmin.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new Admin($db);
    $json['aaData'] = array();
    $sql = $ClientsObj->makeDatatableQuery($_REQUEST);
    $sql1 = "select FOUND_ROWS()";
    $filteredTotalQry = $db->query($sql1);

    $json['iTotalDisplayRecords'] = $filteredTotalQry->fetch_array()[0];
    $json['aaData'] = $ClientsObj->getClientsDataTable($sql);

    $json['iTotalRecords'] = $ClientsObj->get_total_noof_records();

    $json['sEcho'] = $_REQUEST['sEcho'];

    echo json_encode($json);
}

if($_REQUEST['action'] == 'edit_Clients') {
	
    $ClientsObj = new Admin( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}
if($_REQUEST['action'] == 'getmerchant') {
    
    $ClientsObj = new Admin( $db );
 
    echo json_encode($ClientsObj->getmerchant());
    
}


if($_REQUEST['action'] == 'create_Clients') {
 
    $ClientsObj = new Admin($db);

    $ClientsObj->name = !empty($_POST['name']) ? $_POST['name'] : false;
    $ClientsObj->username = !empty($_POST['username']) ? $_POST['username'] : false;
    $ClientsObj->password = !empty($_POST['password']) ? $_POST['password'] : false;
    $ClientsObj->isactive = !empty($_POST['isactive']) ? $_POST['isactive'] : false;
       $ClientsObj->user_role = !empty($_POST['user_role']) ? $_POST['user_role'] : false;

  

    $ClientsObj->create();
}

if($_REQUEST['action'] == 'update_Clients') {
    
    $ClientsObj = new Admin($db);

    $ClientsObj->id =!empty($_POST['user_id']) ? $_POST['user_id'] : false;
    $ClientsObj->name = !empty($_POST['name']) ? $_POST['name'] : false;
    $ClientsObj->username = !empty($_POST['username']) ? $_POST['username'] : false;
	
	
	
    $ClientsObj->password = !empty($_POST['password']) ? $_POST['password'] : false;
    $ClientsObj->isactive = !empty($_POST['isactive']) ? $_POST['isactive'] : false;
          $ClientsObj->user_role = !empty($_POST['user_role']) ? $_POST['user_role'] : false;


    $ClientsObj->update();
}

if($_REQUEST['action'] == 'delete_Clients' ) {
    $id = $_POST['id'];
    $ClientsObj = new Admin($db);
    $ClientsObj->deleteById($id);
}



?>