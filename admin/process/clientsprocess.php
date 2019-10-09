<?php
require_once '../classes/classClients.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new Clients($db);
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
	
    $ClientsObj = new Clients( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}
if($_REQUEST['action'] == 'create_Clients') {
    $ClientsObj = new Clients($db);

   


    $ClientsObj->title = !empty($_POST['title']) ? $_POST['title'] : false;
    $ClientsObj->subtitle = !empty($_POST['subtitle']) ? $_POST['subtitle'] : false;
    $ClientsObj->text = !empty($_POST['text']) ? addslashes($_POST['text']) : false;
    $ClientsObj->email = !empty($_POST['email']) ? $_POST['email'] : false;
    


     if($_FILES['logoimage']['name']!=""){


        $file_name = $_FILES['logoimage']['name'];
        $file_size = $_FILES['logoimage']['size'];
        $file_tmp = $_FILES['logoimage']['tmp_name'];
        $file_type = $_FILES['logoimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['logoimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->logo = $newfilename_1;
            

    }
    $ClientsObj->create();
}

if($_REQUEST['action'] == 'update_Clients') {
    $ClientsObj = new Clients($db);
    $ClientsObj->id =!empty($_POST['user_id']) ? $_POST['user_id'] : false;
    

    $ClientsObj->title = !empty($_POST['title']) ? $_POST['title'] : false;
    $ClientsObj->subtitle = !empty($_POST['subtitle']) ? $_POST['subtitle'] : false;
    $ClientsObj->text = !empty($_POST['text']) ? addslashes($_POST['text']) : false;
    $ClientsObj->email = !empty($_POST['email']) ? $_POST['email'] : false;
    


     if($_FILES['logoimage']['name']!=""){


        $file_name = $_FILES['logoimage']['name'];
        $file_size = $_FILES['logoimage']['size'];
        $file_tmp = $_FILES['logoimage']['tmp_name'];
        $file_type = $_FILES['logoimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['logoimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->logo = $newfilename_1;
            

    }
    else{
         $ClientsObj->logo = !empty($_POST['imgsrc']) ? $_POST['imgsrc'] : false;
    }

    $ClientsObj->update();
}
if($_REQUEST['action'] == 'update_Clients_permission') {
    $ClientsObj = new Clients($db);
    $ClientsObj->id =!empty($_POST['id']) ? $_POST['id'] : false;
    $ClientsObj->reg_canviewdetails = !empty($_POST['marked']) ? $_POST['marked'] : 0;
    $ClientsObj->updatebit();
}
if($_REQUEST['action'] == 'delete_Clients' ) {
    $id = $_POST['id'];
    $ClientsObj = new Clients($db);
    $ClientsObj->deleteById($id);
}

if($_REQUEST['action'] == 'get_question_answer' ) {
    // echo "here";
    $id = $_POST['id'];
    $ClientsObj = new Clients($db);
    echo $ClientsObj->get_question_answer($id);
}
if($_REQUEST['action'] == 'get_images' ) {
    // echo "here";
    $id = $_POST['id'];
    $ClientsObj = new Clients($db);
    echo $ClientsObj->get_images($id);
}

?>