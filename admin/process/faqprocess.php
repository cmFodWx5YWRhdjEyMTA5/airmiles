<?php
require_once '../classes/classFaq.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new Faq($db);
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
	
    $ClientsObj = new Faq( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}
if($_REQUEST['action'] == 'getlocation') {
    
    $ClientsObj = new Faq( $db );
  
    echo json_encode($ClientsObj->getlocation());
    
}


if($_REQUEST['action'] == 'create_Clients') {
    $ClientsObj = new Faq($db);

   
    $ClientsObj->question = !empty($_POST['question']) ? $_POST['question'] : false;
    $ClientsObj->questionarabic = !empty($_POST['questionarabic']) ? $_POST['questionarabic'] : false;
    $ClientsObj->answer = !empty($_POST['answer']) ? $_POST['answer'] : false;
    $ClientsObj->answerarabic = !empty($_POST['answerarabic']) ? $_POST['answerarabic'] : false;
    $ClientsObj->create();
}

if($_REQUEST['action'] == 'update_Clients') {
    
    $ClientsObj = new Faq($db);
    $ClientsObj->id =!empty($_POST['user_id']) ? $_POST['user_id'] : false;
    $ClientsObj->question = !empty($_POST['question']) ? $_POST['question'] : false;
    $ClientsObj->questionarabic = !empty($_POST['questionarabic']) ? $_POST['questionarabic'] : false;
    $ClientsObj->answer = !empty($_POST['answer']) ? $_POST['answer'] : false;
    $ClientsObj->answerarabic = !empty($_POST['answerarabic']) ? $_POST['answerarabic'] : false;

    $ClientsObj->update();
}

if($_REQUEST['action'] == 'delete_Clients' ) {
    $id = $_POST['id'];
    $ClientsObj = new Faq($db);
    $ClientsObj->deleteById($id);
}


?>