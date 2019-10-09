<?php
require_once '../classes/classProfileLocation.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new ProfileLocation($db);
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
	
    $ClientsObj = new ProfileLocation( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}
if($_REQUEST['action'] == 'getlocation') {
    
    $ClientsObj = new ProfileLocation( $db );
  
    echo json_encode($ClientsObj->getlocation());
    
}


if($_REQUEST['action'] == 'create_Clients') {
    $ClientsObj = new ProfileLocation($db);

   
    $ClientsObj->name = !empty($_POST['name']) ? $_POST['name'] : false;
    $ClientsObj->namearabic = !empty($_POST['namearabic']) ? $_POST['namearabic'] : false;
    $ClientsObj->create();
}

if($_REQUEST['action'] == 'update_Clients') {
    $ClientsObj = new ProfileLocation($db);
    $ClientsObj->id =!empty($_POST['user_id']) ? $_POST['user_id'] : false;
   $ClientsObj->name = !empty($_POST['name']) ? $_POST['name'] : false;
    $ClientsObj->namearabic = !empty($_POST['namearabic']) ? $_POST['namearabic'] : false;

    $ClientsObj->update();
}

if($_REQUEST['action'] == 'delete_Clients' ) {
    $id = $_POST['id'];
    $ClientsObj = new ProfileLocation($db);
    $ClientsObj->deleteById($id);
}


?>