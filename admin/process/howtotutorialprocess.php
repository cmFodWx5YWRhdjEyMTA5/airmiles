<?php
require_once '../classes/classHowtoTutorial.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new Tutorials($db);
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
	
    $ClientsObj = new Tutorials( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}
if($_REQUEST['action'] == 'getslider') {
    
    $ClientsObj = new Tutorials( $db );
    /*$ClientsObj->appid = !empty($_POST['appid']) ? $_POST['appid'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;*/
    $ClientsObj->getslider();
    
}
if($_REQUEST['action'] == 'create_Clients') {
    $ClientsObj = new Tutorials($db);

    $ClientsObj->title = !empty($_POST['title']) ? $_POST['title'] : false;
    $ClientsObj->titlearabic = !empty($_POST['titlearabic']) ? $_POST['titlearabic'] : false;
    $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;

 if($_FILES['logoimage']['name']!=""){


        $file_name = $_FILES['logoimage']['name'];
        $file_size = $_FILES['logoimage']['size'];
        $file_tmp = $_FILES['logoimage']['tmp_name'];
        $file_type = $_FILES['logoimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['logoimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/howtotutorial/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->icon = $newfilename_1;
            

    }

    if($_FILES['image']['name']!=""){


        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/howtotutorial/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->image = $newfilename_1;
            

    }
    $ClientsObj->create();
}

if($_REQUEST['action'] == 'update_Clients') {
    $ClientsObj = new Tutorials($db);

     $ClientsObj->id =!empty($_POST['user_id']) ? $_POST['user_id'] : false;
     $ClientsObj->title = !empty($_POST['title']) ? $_POST['title'] : false;
     $ClientsObj->titlearabic = !empty($_POST['titlearabic']) ? $_POST['titlearabic'] : false;
      $ClientsObj->language = !empty($_POST['language']) ? $_POST['language'] : false;

     if($_FILES['logoimage']['name']!=""){


        $file_name = $_FILES['logoimage']['name'];
        $file_size = $_FILES['logoimage']['size'];
        $file_tmp = $_FILES['logoimage']['tmp_name'];
        $file_type = $_FILES['logoimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['logoimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/howtotutorial/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->icon = $newfilename_1;
            

    }
    else{
         $ClientsObj->icon = !empty($_POST['imgsrc']) ? $_POST['imgsrc'] : false;
    }

    if($_FILES['image']['name']!=""){


        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/howtotutorial/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->image = $newfilename_1;
            

    }
    else{
         $ClientsObj->image = !empty($_POST['imgsrc1']) ? $_POST['imgsrc1'] : false;
    }


    $ClientsObj->update();
}

if($_REQUEST['action'] == 'delete_Clients' ) {
    $id = $_POST['id'];
    $ClientsObj = new Tutorials($db);
    $ClientsObj->deleteById($id);
}


if($_REQUEST['action'] == 'selectAll' ) {
    
    $ClientsObj = new Tutorials($db);
    $ClientsObj->selectAll();
}


?>