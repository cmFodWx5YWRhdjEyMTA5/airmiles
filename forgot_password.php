<?php 

include 'header.php';

?>

 
<div class="forgot_password-wp">

	
  <form id="loginForm" name="loginForm" method="POST">
    <div class="form-group">

      <input type="hidden" name="user" id="user" value="<?php echo preg_replace('/\s+/', '+', $_GET['user']);?>">
      <input id="myPassword" name="myPassword" type="password" class="form-control" placeholder="Password" required="required">
    </div>
    <div class="form-group">
      <input id="myConfirmPassword" name="myConfirmPassword" type="password" class="form-control" placeholder="Verify Password" required="required">
    </div>
     <input type="button" class="btn btn-info" name="frmsubmit" id="frmsubmit" value="Submit" onClick="validatePassword();" disabled="disabled" >
 </form>
    <div id="errors" class="well"></div>

</div>


<style type="text/css">
body {
  background-color: #f5f5f5;
}
.forgot_password-wp {
  background-image: url(images/bg1.jpg);
  max-width: 580px;
  margin: 0 auto;
  padding: 50px 30px;
  box-shadow: 0 0 10px 0 #ccc;
  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  -moz-transform: translateY(-50%);
-webkit-transform: translateY(-50%);
-o-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
}
.forgot_password-wp .form-control {
  border: 0;
  width: 100%;
  padding: 10px 10px;
  font-size: 14px;
  color: #000;
  box-shadow: none;
  border-radius: 0;
  height: 40px;
}
.btn.btn-info {
  background-color: #C64498;
  border: 0;
  border-radius: 0;
  font-size: 16px;
  text-transform: uppercase;
  letter-spacing: 0.4px;
  padding: 8px 20px;
}
 .forgot_password-wp .well {
  min-height: auto;
  padding: 0;
  border: 0;
  margin: 0;
}
.forgot_password-wp pre {
    background-color: #4b4d4e;
    color: #fff;
    border: 1px solid #fff;
    font-size: 16px;
    line-height: 21px;
    margin: 20px 0 0;
    overflow: inherit;
    height: 100%;
    white-space: inherit;
    word-break: inherit;
}


</style>

<?php include 'footer.php'; ?>


