<?php

include 'header.php';



function set_value($key,$value){

    global $db;

    $sql = "UPDATE `content` SET `option_value` = '".addslashes($value)."' where `option_key`='".$key."'";

    $res = $db->query($sql);

    if(mysqli_fetch_assoc($res)){

        return true;

    }else{

        return false;    

    }

    

}



// require_once 'classDatabase.php';

// require_once '../classes/classDatabase.php';

$sql = "SELECT * FROM content where appid='riyadh' ";

$res = $db->query($sql);

// $res_result = mysqli_fetch_assoc($res);



$arr = array();



while($row = mysqli_fetch_assoc($res)) {

    $arr[] = $row;

}




  if(isset($_REQUEST['aboutblocksubmit'])){
  set_value('aboutenglish',$_REQUEST['aboutenglish']);
  set_value('aboutarabic',$_REQUEST['aboutarabic']);
  } 
   if(isset($_REQUEST['welcomeblocksubmit'])){
  set_value('welcomeenglish',$_REQUEST['welcomeenglish']);
  set_value('welcomearabic',$_REQUEST['welcomearabic']);
  set_value('welcometitlearabic',$_REQUEST['welcometitlearabic']);
  set_value('welcometitleenglish',$_REQUEST['welcometitleenglish']);
  } 

  if(isset($_REQUEST['enduseragreementsubmit'])){
  set_value('enduseragreementenglish',$_REQUEST['enduseragreementenglish']);
  set_value('enduseragreementarabic',$_REQUEST['enduseragreementarabic']);
  }

  if(isset($_REQUEST['supportsubmit'])){
  set_value('calltitle',$_REQUEST['calltitle']);
  set_value('calltitlearabic',$_REQUEST['calltitlearabic']);
  set_value('calltext',$_REQUEST['calltext']);
  set_value('calltextarabic',$_REQUEST['calltextarabic']);
  set_value('callnumber',$_REQUEST['callnumber']);
  set_value('emailtitle',$_REQUEST['emailtitle']);
  set_value('emailtitlearabic',$_REQUEST['emailtitlearabic']);
  set_value('emailtext',$_REQUEST['emailtext']);
  set_value('whatsapptitle',$_REQUEST['whatsapptitle']);
  set_value('whatsapptitlearabic',$_REQUEST['whatsapptitlearabic']);
  set_value('whatsapptext',$_REQUEST['whatsapptext']);
  set_value('whatsappsharingtext',$_REQUEST['whatsappsharingtext']);
  set_value('whatsappsharingtextarabic',$_REQUEST['whatsappsharingtextarabic']);
  } 

  if(isset($_REQUEST['termsconditionsubmit'])){
  set_value('termsconditiontextenglish',$_REQUEST['termsconditiontextenglish']);
  set_value('termsconditiontextarabic',$_REQUEST['termsconditiontextarabic']);

  } 

if(isset($_REQUEST['imagesubmit'])){

    if($_FILES['image']['name']!=""){


        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $newfilename_1 = round(microtime(true)) . '.' . $file_ext;

            move_uploaded_file($file_tmp,'../img/product/'.$newfilename_1);
            set_value('image',$newfilename_1);
            
            

    }
  
  } 




?>

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

     

            <section class="content-header">

                <h1>Content Edit</h1>

                <ol class="breadcrumb">

                    <li><a><i class="fa fa-dashboard"></i> Home</a></li>

                    <li class="active">Content Edit</li>

                </ol>

            </section>

            <!-- Main content -->

            <section class="content">

                <div class="box">


                    <div class="box-body">

                        <!-- /.box-header -->

                        <div class="box-body">

                            <div class="nav-tabs-custom">

                                <ul class="nav nav-tabs">

                                  <li class="active"><a href="#About" data-toggle="tab"> About</a></li>
                                  <li class=""><a href="#welcome" data-toggle="tab"> Apply for Oab Card</a></li>
                                  <li class=""><a href="#enduseragreement" data-toggle="tab" style="display: none;"> End User Agreement</a></li>
                                  <li class=""><a href="#support" data-toggle="tab">Support</a></li>
                                  <li class=""><a href="#termscondition" data-toggle="tab" >Terms & Condition</a></li>
                                  <!--<li class=""><a href="#image" data-toggle="tab"> Main Image</a></li>-->
                              
                                </ul>

                                <div class="tab-content">

                                  <div class="tab-pane active" id="About">

                                       <form method="POST" enctype="multipart/form-data">

                                            <div class="row">

                                              

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>About Gifti Text English</label>

                                                  <textarea class="form-control textareahight" name="aboutenglish" ><?php echo stripslashes(get_value('aboutenglish')); ?></textarea>

                                                    </div>

                                                </div>
                                                 <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>About Gifti Text Arabic</label>

                                                    <textarea class="form-control textareahight" name="aboutarabic" ><?php echo stripslashes(get_value('aboutarabic')); ?></textarea>

                                                    </div>

                                                </div>
                                             
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <input type="submit" class="btn btn-primary" name="aboutblocksubmit" value="Save">

                                                    </div>

                                                </div>

                                              </div>

                                            </form>

                                    </div>
                                    <div class="tab-pane" id="welcome">

                                       <form method="POST" enctype="multipart/form-data">

                                            <div class="row">

                                              
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Apply For Oab Card Title English</label>
                                                        <input type="Text" class="form-control" name="welcometitleenglish" id="welcometitleenglish" value="<?php echo stripslashes(get_value('welcometitleenglish')); ?>">    

                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Apply For Oab Card Title Arabic</label>
                                                        <input type="Text" class="form-control" name="welcometitlearabic" id="welcometitlearabic" value="<?php echo stripslashes(get_value('welcometitlearabic')); ?>">    
                                                       
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Apply For Oab Card Text English</label>

                                                  <textarea class="form-control textareahight" name="welcomeenglish" ><?php echo stripslashes(get_value('welcomeenglish')); ?></textarea>

                                                    </div>

                                                </div>
                                                 <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Apply For Oab Card Text Arabic</label>

                                                    <textarea class="form-control textareahight" name="welcomearabic" ><?php echo stripslashes(get_value('welcomearabic')); ?></textarea>

                                                    </div>

                                                </div>
                                             
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <input type="submit" class="btn btn-primary" name="welcomeblocksubmit" value="Save">

                                                    </div>

                                                </div>

                                              </div>

                                            </form>

                                    </div>


                                    <div class="tab-pane" id="enduseragreement">

                                       <form method="POST" enctype="multipart/form-data">

                                            <div class="row">

                                              
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>End User Agreement Text Eglish</label>
                                        
                                                        <textarea class="form-control textareahight" name="enduseragreementenglish" ><?php echo stripslashes(get_value('enduseragreementenglish')); ?></textarea>   

                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>End User Agreement Text Arabic</label>
                                                        <textarea class="form-control textareahight" name="enduseragreementarabic" ><?php echo stripslashes(get_value('enduseragreementarabic')); ?></textarea>     
                                                       
                                                    </div>

                                                </div>
                                                
                                             
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <input type="submit" class="btn btn-primary" name="enduseragreementsubmit" value="Save">

                                                    </div>

                                                </div>

                                              </div>

                                            </form>

                                    </div>


                                    <div class="tab-pane" id="support">

                                       <form method="POST" enctype="multipart/form-data">

                                            <div class="row">

                                              
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Call Title</label>
                                                          <input type="Text" class="form-control" name="calltitle" id="calltitle" value="<?php echo stripslashes(get_value('calltitle')); ?>">

                                                    </div>

                                                </div>

                                                 <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Call Title Arabic</label>
                                                          <input type="Text" class="form-control" name="calltitlearabic" id="calltitlearabic" value="<?php echo stripslashes(get_value('calltitlearabic')); ?>">

                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Call Text</label>
                                                        <input type="Text" class="form-control" name="calltext" id="calltext" value="<?php echo stripslashes(get_value('calltext')); ?>">     
                                                       
                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Call Text Arabic</label>
                                                        <input type="Text" class="form-control" name="calltextarabic" id="calltextarabic" value="<?php echo stripslashes(get_value('calltextarabic')); ?>">     
                                                       
                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Call Number</label>
                                                        <input type="Text" class="form-control" name="callnumber" id="callnumber" value="<?php echo stripslashes(get_value('callnumber')); ?>">     
                                                       
                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Email Title</label>
                                                        <input type="Text" class="form-control" name="emailtitle" id="emailtitle" value="<?php echo stripslashes(get_value('emailtitle')); ?>">     
                                                       
                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Email Title Arabic</label>
                                                        <input type="Text" class="form-control" name="emailtitlearabic" id="emailtitlearabic" value="<?php echo stripslashes(get_value('emailtitlearabic')); ?>">     
                                                       
                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Email Text</label>
                                                        <input type="Text" class="form-control" name="emailtext" id="emailtext" value="<?php echo stripslashes(get_value('emailtext')); ?>">     
                                                       
                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Whatsapp Title</label>
                                                        <input type="Text" class="form-control" name="whatsapptitle" id="whatsapptitle" value="<?php echo stripslashes(get_value('whatsapptitle')); ?>">     
                                                       
                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Whatsapp Title Arabic</label>
                                                        <input type="Text" class="form-control" name="whatsapptitlearabic" id="whatsapptitlearabic" value="<?php echo stripslashes(get_value('whatsapptitlearabic')); ?>">     
                                                       
                                                    </div>

                                                </div>

                                                 <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Whatsapp Number</label>
                                                        <input type="Text" class="form-control" name="whatsapptext" id="whatsapptext" value="<?php echo stripslashes(get_value('whatsapptext')); ?>">     
                                                       
                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Whatsapp Sharing Text</label>
                                                        <textarea class="form-control textareahight" name="whatsappsharingtext" ><?php echo stripslashes(get_value('whatsappsharingtext')); ?></textarea>     
                                                       
                                                    </div>

                                                </div>

                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Whatsapp Sharing Text Arabic</label>
                                                        <textarea class="form-control textareahight" name="whatsappsharingtextarabic" ><?php echo stripslashes(get_value('whatsappsharingtextarabic')); ?></textarea>     
                                                       
                                                    </div>

                                                </div>
                                                
                                             
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <input type="submit" class="btn btn-primary" name="supportsubmit" value="Save">

                                                    </div>

                                                </div>

                                              </div>

                                            </form>

                                    </div>


                                    <div class="tab-pane" id="termscondition">

                                       <form method="POST" enctype="multipart/form-data">

                                            <div class="row">

                                              
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Terms & Condition Text English</label>
                                        
                                                        <textarea class="form-control textareahight" name="termsconditiontextenglish" ><?php echo stripslashes(get_value('termsconditiontextenglish')); ?></textarea>   

                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Terms & Condition Text Arabic</label>
                                                        <textarea class="form-control textareahight" name="termsconditiontextarabic" ><?php echo stripslashes(get_value('termsconditiontextarabic')); ?></textarea>     
                                                       
                                                    </div>

                                                </div>
                                                
                                             
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <input type="submit" class="btn btn-primary" name="termsconditionsubmit" value="Save">

                                                    </div>

                                                </div>

                                              </div>

                                            </form>

                                    </div>


                                    <!--<div class="tab-pane" id="image">

                                       <form method="POST" enctype="multipart/form-data">

                                            <div class="row">

                                              
                                               
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <label>Image</label>
                                                        <img src="<?php echo '../img/product/'.get_value('image'); ?>">
                                                        <input type="file" name="image" id="image" required="required">

                                                    </div>

                                                </div>
                                                
                                             
                                                <div class="col-sm-12 col-md-12">

                                                    <div class="form-group">

                                                        <input type="submit" class="btn btn-primary" name="imagesubmit" value="Save">

                                                    </div>

                                                </div>

                                              </div>

                                            </form>

                                    </div>-->
                                </div>

                                <!-- /.tab-content -->

                            </div>

                        </div>

                    </div>

                </div>

            </section>

       

    </div>

<?php

include 'footer.php';

?>

