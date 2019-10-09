<?php
require_once '../classes/classLoginslider.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new LoginSLider($db);
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
    
    $ClientsObj = new LoginSLider( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}
if($_REQUEST['action'] == 'getcategories') {
    
    $ClientsObj = new Category( $db );
 
    echo json_encode($ClientsObj->getcategories());
    
}
if($_REQUEST['action'] == 'getcategory') {
    
    $ClientsObj = new Category( $db );
 
    echo json_encode($ClientsObj->getcategory());
}
if($_REQUEST['action'] == 'getcategory1') {
    
    $ClientsObj = new Category( $db );
    $id = $_POST['id'];
   
    echo json_encode($ClientsObj->getcategory1($id));
}
if($_REQUEST['action'] == 'create_Clients') {

    $ClientsObj = new LoginSLider($db);

    $ClientsObj->order = !empty($_POST['order']) ? $_POST['order'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
   
    
 if($_FILES['logoimage']['name']!=""){


        $file_name = $_FILES['logoimage']['name'];
        $file_size = $_FILES['logoimage']['size'];
        $file_tmp = $_FILES['logoimage']['tmp_name'];
        $file_type = $_FILES['logoimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['logoimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/loginslider/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->image = $newfilename_1;
            

    }
    $ClientsObj->create();
}

if($_REQUEST['action'] == 'update_Clients') {
    
    $ClientsObj = new LoginSLider($db);

    $ClientsObj->id =!empty($_POST['user_id']) ? $_POST['user_id'] : false;
    $ClientsObj->order = !empty($_POST['order']) ? $_POST['order'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;
    


     if($_FILES['logoimage']['name']!=""){


        $file_name = $_FILES['logoimage']['name'];
        $file_size = $_FILES['logoimage']['size'];
        $file_tmp = $_FILES['logoimage']['tmp_name'];
        $file_type = $_FILES['logoimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['logoimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/loginslider/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->image = $newfilename_1;
            

    }
    else{
         $ClientsObj->image = !empty($_POST['imgsrc']) ? $_POST['imgsrc'] : false;
    }

    $ClientsObj->update();
}

if($_REQUEST['action'] == 'delete_Clients' ) {
    $id = $_POST['id'];
    $ClientsObj = new LoginSLider($db);
    $ClientsObj->deleteById($id);
}

?>