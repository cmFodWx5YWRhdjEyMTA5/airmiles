<?php
require_once '../classes/classReferralcards.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new Referralcards($db);
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
	
    $ClientsObj = new Referralcards( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}
if($_REQUEST['action'] == 'getcategories') {
    
    $ClientsObj = new Referralcards( $db );
 
    echo json_encode($ClientsObj->getcategories());
    
}

if($_REQUEST['action'] == 'create_Clients') {
    $ClientsObj = new Referralcards($db);

    $ClientsObj->categoryid = !empty($_POST['categoryid']) ? $_POST['categoryid'] : false;
    $ClientsObj->cardname = !empty($_POST['cardname']) ? $_POST['cardname'] : false;
    $ClientsObj->cardnamearabic = !empty($_POST['cardnamearabic']) ? $_POST['cardnamearabic'] : false;
   
    $ClientsObj->termscondition = !empty($_POST['termscondition']) ? $_POST['termscondition'] : false;
    $ClientsObj->termsconditionarabic = !empty($_POST['termsconditionarabic']) ? $_POST['termsconditionarabic'] : false;
    $ClientsObj->referralcount = !empty($_POST['referralcount']) ? $_POST['referralcount'] : 0;
    $ClientsObj->actualprice = !empty($_POST['actualprice']) ? $_POST['actualprice'] : false;
    $ClientsObj->pricecurrency = !empty($_POST['pricecurrency']) ? $_POST['pricecurrency'] : false;
    $ClientsObj->campaign_id = !empty($_POST['campaign_id']) ? $_POST['campaign_id'] : false;
    $ClientsObj->campaign_name = !empty($_POST['campaign_name']) ? $_POST['campaign_name'] : false;
    
 if($_FILES['image']['name']!=""){


        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/referralcards/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->image = $newfilename_1;
            

    }
   //featured image
    if($_FILES['featuredimage']['name']!=""){


        $file_name = $_FILES['featuredimage']['name'];
        $file_size = $_FILES['featuredimage']['size'];
        $file_tmp = $_FILES['featuredimage']['tmp_name'];
        $file_type = $_FILES['featuredimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['featuredimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/referralcards/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->featuredimage = $newfilename_1;
            

    }
    $ClientsObj->create();
}

if($_REQUEST['action'] == 'update_Clients') {
    $ClientsObj = new Referralcards($db);

    $ClientsObj->id =!empty($_POST['user_id']) ? $_POST['user_id'] : false;
    $ClientsObj->categoryid = !empty($_POST['categoryid']) ? $_POST['categoryid'] : false;
    $ClientsObj->cardname = !empty($_POST['cardname']) ? $_POST['cardname'] : false;
    $ClientsObj->cardnamearabic = !empty($_POST['cardnamearabic']) ? $_POST['cardnamearabic'] : false;
    $ClientsObj->termscondition = !empty($_POST['termscondition']) ? $_POST['termscondition'] : false;
    $ClientsObj->termsconditionarabic = !empty($_POST['termsconditionarabic']) ? $_POST['termsconditionarabic'] : false;
    $ClientsObj->referralcount = !empty($_POST['referralcount']) ? $_POST['referralcount'] : 0;
    $ClientsObj->actualprice = !empty($_POST['actualprice']) ? $_POST['actualprice'] : false;
    $ClientsObj->pricecurrency = !empty($_POST['pricecurrency']) ? $_POST['pricecurrency'] : false;
    $ClientsObj->campaign_id = !empty($_POST['campaign_id']) ? $_POST['campaign_id'] : false;
    $ClientsObj->campaign_name = !empty($_POST['campaign_name']) ? $_POST['campaign_name'] : false;
    


     if($_FILES['image']['name']!=""){


        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/referralcards/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->image = $newfilename_1;
            

    }
    else{
         $ClientsObj->image = !empty($_POST['imgsrc']) ? $_POST['imgsrc'] : false;
    }

 //featured image
    if($_FILES['featuredimage']['name']!=""){


        $file_name = $_FILES['featuredimage']['name'];
        $file_size = $_FILES['featuredimage']['size'];
        $file_tmp = $_FILES['featuredimage']['tmp_name'];
        $file_type = $_FILES['featuredimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['featuredimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/referralcards/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->featuredimage = $newfilename_1;
            

    }
    else{
         $ClientsObj->featuredimage = !empty($_POST['imgsrc1']) ? $_POST['imgsrc1'] : false;
    }

    $ClientsObj->update();
}

if($_REQUEST['action'] == 'delete_Clients' ) {
    $id = $_POST['id'];
    $ClientsObj = new Referralcards($db);
    $ClientsObj->deleteById($id);
}

?>