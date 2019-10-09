<?php
require_once '../classes/classContent.php';

error_reporting(0);
ini_set('display_errors', 1);


if($_POST['action'] == 'get_content' ) {

    $ContentObj = new Content($db);
    $ContentObj->key = !empty($_POST['key']) ? $_POST['key'] : false;
    $ContentObj->appid = !empty($_POST['appid']) ? $_POST['appid'] : false;
    $ContentObj->getdata();
    
}
if($_POST['action'] == 'get_contentwelcome' ) {

    $ContentObj = new Content($db);
    $ContentObj->title = !empty($_POST['title']) ? $_POST['title'] : false;
    $ContentObj->text = !empty($_POST['text']) ? $_POST['text'] : false;
    $ContentObj->appid = !empty($_POST['appid']) ? $_POST['appid'] : false;
    $ContentObj->get_contentwelcome();
    
}


?>