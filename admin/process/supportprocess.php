<?php
require_once '../classes/classSupport.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new Support($db);
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
	
    $ClientsObj = new Support( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}
if($_REQUEST['action'] == 'getmerchant') {
    
    $ClientsObj = new Support( $db );
 
    echo json_encode($ClientsObj->getmerchant());
    
}

if($_REQUEST['action'] == 'markisresolved1' ) {
    $id = $_POST['id'];
    $ClientsObj = new Support($db);
    $ClientsObj->markisresolved1($id);
}
if($_REQUEST['action'] == 'markisresolved0' ) {
    $id = $_POST['id'];
    $ClientsObj = new Support($db);
    $ClientsObj->markisresolved0($id);
}

if($_REQUEST['action'] == 'create_Clients') {
 
    $ClientsObj = new Support($db);

    $ClientsObj->name = !empty($_POST['name']) ? $_POST['name'] : false;
    $ClientsObj->username = !empty($_POST['username']) ? $_POST['username'] : false;
    $ClientsObj->password = !empty($_POST['password']) ? $_POST['password'] : false;
    $ClientsObj->isactive = !empty($_POST['isactive']) ? $_POST['isactive'] : false;
   
    $ClientsObj->create();
}

if($_REQUEST['action'] == 'update_Clients') {
    
    $ClientsObj = new Support($db);

    $ClientsObj->id =!empty($_POST['user_id']) ? $_POST['user_id'] : false;
    $ClientsObj->name = !empty($_POST['name']) ? $_POST['name'] : false;
    $ClientsObj->username = !empty($_POST['username']) ? $_POST['username'] : false;
    $ClientsObj->password = !empty($_POST['password']) ? $_POST['password'] : false;
    $ClientsObj->isactive = !empty($_POST['isactive']) ? $_POST['isactive'] : false;
   
    $ClientsObj->update();
}

if($_REQUEST['action'] == 'delete_Clients' ) {
    $id = $_POST['id'];
    $ClientsObj = new Support($db);
    $ClientsObj->deleteById($id);
}



?>