<?php

include 'classes/classDatabase.php';



session_start();

$error = '';



if (isset($_POST["login"])) {
    
    $username = mysqli_real_escape_string($db, $_POST['username']);
    
    $pswd = mysqli_real_escape_string($db, $_POST['password']);
    
    
    
    $sql = "SELECT id,user_role,user_name FROM login_master where user_name = '$username' and password = '$pswd' and isactive=1  ";
    
    $query = $db->query($sql);
    
    
    
    if ($query->num_rows > 0) {
        
        $Row = $query->fetch_assoc();
        
        $_SESSION['login_user'] = $Row['id'];
        
        $_SESSION['user_name'] = $Row['user_name'];
        
        $_SESSION['user_role'] = $Row['user_role'];
        
        header("location: index.php");
        
    }
    
    else {
        
        $error = "Your Login Name or Password is invalid";
        
    }
    
}

?>

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>OAB | Log in</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <!-- iCheck -->

  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition login-page">

<div class="login-box">

  <div class="login-logo">

    <a class="ml-color" href="/login.php" style="font-weight: bold; font-size: 48px;color: #ffffff !important;" >OAB</a>

  </div>

  <!-- /.login-logo -->

  <div class="login-box-body">

    <p class="login-box-msg">Sign in to start your session</p>



    <form action="" method="post">

     <?php
if (!empty($error)) {
?>

                  <div class="alert alert-danger" role="alert">

                    <strong>Sorry</strong> Your username or password is wrong.

                  </div>

                <?php
}
?>

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Username" id="username" name="username">

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Password" id="password" name="password">

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row">

        <div class="col-xs-12">

          <div class="col-xs-12 text-center">

            <button name="login" class="btn btn-primary btn-raised" type="submit">Login</button>

          </div>

        </div>

        <!-- /.col -->

      </div>

    </form>



  </div>

  <!-- /.login-box-body -->

</div>

<!-- /.login-box -->



<!-- jQuery 3 -->

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- iCheck -->

<script src="plugins/iCheck/icheck.min.js"></script>

<script>

  $(function () {

    $('input').iCheck({

      checkboxClass: 'icheckbox_square-blue',

      radioClass: 'iradio_square-blue',

      increaseArea: '20%' // optional

    });

  });

</script>

</body>

</html>