<?php
require_once '../classes/classProduct.php';

error_reporting(0);
ini_set('display_errors', 1);

if($_REQUEST['action'] == 'get_clients' ) {
    $ClientsObj = new Product($db);
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
	
    $ClientsObj = new Product( $db );
    $id = $_POST['id'];
    echo json_encode($ClientsObj->selectById($id));
    
}
if($_REQUEST['action'] == 'getcategories') {
    
    $ClientsObj = new Product( $db );
 
    echo json_encode($ClientsObj->getcategories());
    
}

if($_REQUEST['action'] == 'markisactive1' ) {
    $id = $_POST['id'];
    $ClientsObj = new Product($db);
    $ClientsObj->markisactive1($id);
}
if($_REQUEST['action'] == 'markisactive0' ) {
    $id = $_POST['id'];
    $ClientsObj = new Product($db);
    $ClientsObj->markisactive0($id);
}

if($_REQUEST['action'] == 'create_Clients') {
    $ClientsObj = new Product($db);

    $ClientsObj->categoryid = !empty($_POST['categoryid']) ? $_POST['categoryid'] : false;
    $ClientsObj->cardname = !empty($_POST['cardname']) ? $_POST['cardname'] : false;
    $ClientsObj->cardnamearabic = !empty($_POST['cardnamearabic']) ? $_POST['cardnamearabic'] : false;
    $ClientsObj->termscondition = !empty($_POST['termscondition']) ? $_POST['termscondition'] : false;
    $ClientsObj->termsconditionarabic = !empty($_POST['termsconditionarabic']) ? $_POST['termsconditionarabic'] : false;
    $ClientsObj->pricefornonoab = !empty($_POST['pricefornonoab']) ? $_POST['pricefornonoab'] : false;
    $ClientsObj->priceforoab = !empty($_POST['priceforoab']) ? $_POST['priceforoab'] : false;
    $ClientsObj->actualprice = !empty($_POST['actualprice']) ? $_POST['actualprice'] : false;
    $ClientsObj->pricecurrency = !empty($_POST['pricecurrency']) ? $_POST['pricecurrency'] : false;
    $ClientsObj->currencycode = !empty($_POST['currencycode']) ? $_POST['currencycode'] : false;
    $ClientsObj->campaign_id = !empty($_POST['campaign_id']) ? $_POST['campaign_id'] : false;
    $ClientsObj->campaign_name = !empty($_POST['campaign_name']) ? $_POST['campaign_name'] : false;
    $ClientsObj->discount = !empty($_POST['discount']) ? $_POST['discount'] : 0;
    $ClientsObj->cardbutton1 = !empty($_POST['cardbutton1']) ? $_POST['cardbutton1'] : false;
    $ClientsObj->cardbutton2 = !empty($_POST['cardbutton2']) ? $_POST['cardbutton2'] : false;
    $ClientsObj->cardbutton2arabic = !empty($_POST['cardbutton2arabic']) ? $_POST['cardbutton2arabic'] : false;
    
 if($_FILES['image']['name']!=""){


        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/product/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->image = $newfilename_1;
            

    }

    if($_FILES['featuredimage']['name']!=""){


        $file_name = $_FILES['featuredimage']['name'];
        $file_size = $_FILES['featuredimage']['size'];
        $file_tmp = $_FILES['featuredimage']['tmp_name'];
        $file_type = $_FILES['featuredimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['featuredimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/product/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->featuredimage = $newfilename_1;
            

    }
    $ClientsObj->create();
}

if($_REQUEST['action'] == 'update_Clients') {
    $ClientsObj = new Product($db);

    $ClientsObj->id =!empty($_POST['user_id']) ? $_POST['user_id'] : false;
    $ClientsObj->categoryid = !empty($_POST['categoryid']) ? $_POST['categoryid'] : false;
    $ClientsObj->cardname = !empty($_POST['cardname']) ? $_POST['cardname'] : false;
    $ClientsObj->cardnamearabic = !empty($_POST['cardnamearabic']) ? $_POST['cardnamearabic'] : false;
    $ClientsObj->termscondition = !empty($_POST['termscondition']) ? $_POST['termscondition'] : false;
    $ClientsObj->termsconditionarabic = !empty($_POST['termsconditionarabic']) ? $_POST['termsconditionarabic'] : false;
    $ClientsObj->pricefornonoab = !empty($_POST['pricefornonoab']) ? $_POST['pricefornonoab'] : false;
    $ClientsObj->priceforoab = !empty($_POST['priceforoab']) ? $_POST['priceforoab'] : false;
    $ClientsObj->actualprice = !empty($_POST['actualprice']) ? $_POST['actualprice'] : false;
    $ClientsObj->pricecurrency = !empty($_POST['pricecurrency']) ? $_POST['pricecurrency'] : false;
    $ClientsObj->currencycode = !empty($_POST['currencycode']) ? $_POST['currencycode'] : false;
    $ClientsObj->campaign_id = !empty($_POST['campaign_id']) ? $_POST['campaign_id'] : false;
    $ClientsObj->campaign_name = !empty($_POST['campaign_name']) ? $_POST['campaign_name'] : false;
    
    $ClientsObj->discount = !empty($_POST['discount']) ? $_POST['discount'] : 0;
    
    $ClientsObj->cardbutton1 = !empty($_POST['cardbutton1']) ? $_POST['cardbutton1'] : false;
    $ClientsObj->cardbutton2 = !empty($_POST['cardbutton2']) ? $_POST['cardbutton2'] : false;
    $ClientsObj->cardbutton2arabic = !empty($_POST['cardbutton2arabic']) ? $_POST['cardbutton2arabic'] : false;
    


     if($_FILES['image']['name']!=""){


        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/product/'.$newfilename_1);
            // $image='uploads/jobs'.$file_name;
            // $image= $newfilename_1;
            $ClientsObj->image = $newfilename_1;
            

    }
    else{
         $ClientsObj->image = !empty($_POST['imgsrc']) ? $_POST['imgsrc'] : false;
    }

    //featured iamge
    if($_FILES['featuredimage']['name']!=""){


        $file_name = $_FILES['featuredimage']['name'];
        $file_size = $_FILES['featuredimage']['size'];
        $file_tmp = $_FILES['featuredimage']['tmp_name'];
        $file_type = $_FILES['featuredimage']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['featuredimage']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,dirname(dirname(dirname(__FILE__))).'/img/product/'.$newfilename_1);
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
    $ClientsObj = new Product($db);
    $ClientsObj->deleteById($id);
}

?>