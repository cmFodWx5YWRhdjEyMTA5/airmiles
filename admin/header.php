<?php

require_once 'classes/classDatabase.php';

session_start();

if(!isset($_SESSION['login_user'])){

header("location:login.php");

}

$userRole = $_SESSION['user_role'];



date_default_timezone_set("Asia/Kolkata");

$url=explode("/", $_SERVER['REQUEST_URI']);

function get_value($key){

global $db;

$sql = "SELECT `option_value` FROM content where option_key='".$key."'";

$res = $db->query($sql);

return htmlspecialchars_decode(mysqli_fetch_assoc($res)['option_value']);

}


$userRole = $_SESSION['user_role'];
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">


<title>OAB | Dashboard</title>

<!-- Tell the browser to be responsive to screen width -->

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- toastr css-->

<link type="text/css" rel="stylesheet" href="bower_components/toastr/toastr.css?1425466569" />

<!-- Bootstrap 3.3.7 -->

<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

<!-- Font Awesome -->

<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">

<!-- Ionicons -->

<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

<!-- jvectormap -->

<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">

<!-- DataTables -->

<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- Theme style -->

<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

<!-- AdminLTE Skins. Choose a skin from the css/skins

folder instead of downloading all of them to reduce the load. -->

<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


<!-- Google Font -->

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</head>

<body class="hold-transition skin-black-light sidebar-mini">

<div class="wrapper">



<header class="main-header">

<!-- Logo -->

<a href="index.php" class="logo">

<!-- mini logo for sidebar mini 50x50 pixels -->

<span class="logo-mini ml-color" style="font-weight: bold;">OAB
</span>

<!-- logo for regular state and mobile devices -->

<span class="logo-lg ml-color" style="font-weight: bold;">OAB</span>

</a>



<!-- Header Navbar: style can be found in header.less -->

<nav class="navbar navbar-static-top">

<!-- Sidebar toggle button-->

<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

<span class="sr-only">Toggle navigation</span>

</a>

<!-- Navbar Right Menu -->

<div class="navbar-custom-menu">

<ul class="nav navbar-nav">

<li class="dropdown user user-menu">

<a href="logout.php">

<span class="hidden-xs">Sign Out</span>

</a>

</li>

</ul>

</div>



</nav>

</header>

<!-- Left side column. contains the logo and sidebar -->

<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->

<section class="sidebar">

<!-- Sidebar user panel -->

<div class="user-panel">

<div class="pull-left image">

<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

</div>

<div class="pull-left info">

<p><?php echo $_SESSION['user_name'];  ?></p>

<a href="#"><i class="fa fa-circle text-success"></i> Online</a>

</div>

</div>



<!-- sidebar menu: : style can be found in sidebar.less -->



<ul class="sidebar-menu" data-widget="tree">

<li class="header">MAIN NAVIGATION</li>


<li <?php if($url[2]=='index.php'){ ?> class="active" <?php } ?>><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>

<?php
if($userRole=='superadmin')
{
?>
<li <?php if($url[2]=='admin.php'){ ?> class="active" <?php } ?>><a href="admin.php"><i class="fa fa-user-circle-o"></i><span>User Management</span> </a></li>	
<?php	
}
	
	
?>	

<?php 
if($userRole=='superadmin' || $userRole=='reports')
{
	
?>
<li><a><i class="fa fa-bar-chart"></i><span>Reports</span> </a>

<ul class="sub-menu">
<li <?php if($url[2]=='oabcard.php'){ ?> class="active" <?php } ?>><a href="oabcard.php"><span>OAB Card</span></a></li>
<li <?php if($url[2]=='creategiftcard.php'){ ?> class="active" <?php } ?>><a href="creategiftcard.php"><span>Failed Transaction</span></a></li>
   <li <?php if($url[2]=='reportforsuccessfull.php'){ ?> class="active" <?php } ?>><a href="reportforsuccessfull.php"><span>Successful Transactions</span></a></li>

<li <?php if($url[2]=='support.php'){ ?> class="active" <?php } ?>><a href="support.php"><span>Support Requests</span></a></li>

</ul>

</li>
<?php
}	
if($userRole !='reports')
{
?>	


<li><a><i class="fa fa-pencil"></i><span>Content Management</span> </a>
<ul class="sub-menu">
<li <?php if($url[2]=='content.php'){ ?> class="active" <?php } ?>><a href="content.php"><span>About Message</span></a></li>
<li <?php if($url[2]=='homeslider.php'){ ?> class="active" <?php } ?>><a href="homeslider.php"></i><span>Home Slider</span></a></li>
<li <?php if($url[2]=='category.php'){ ?> class="active" <?php } ?>><a href="category.php"><span>Category</span></a></li>
<li <?php if($url[2]=='profilenationality.php'){ ?> class="active" <?php } ?>><a href="profilenationality.php"><span>Profile Nationality</span></a></li>
<li <?php if($url[2]=='loginslider.php'){ ?> class="active" <?php } ?>><a href="loginslider.php"><span>Login Slider</span></a></li>
<li <?php if($url[2]=='howtotutorial.php'){ ?> class="active" <?php } ?>><a href="howtotutorial.php"><span>How to Tutorial</span></a></li>
<li <?php if($url[2]=='faq.php'){ ?> class="active" <?php } ?>><a href="faq.php"><span>FAQ</span></a></li>


</ul>

</li>



<li><a><i class="fa fa-gift"></i><span>Offers</span> </a>
<ul class="sub-menu">

<li <?php if($url[2]=='product.php'){ ?> class="active" <?php } ?>><a href="product.php"><span>Gift Cards</span></a></li>
<li <?php if($url[2]=='referralcards.php'){ ?> class="active" <?php } ?>><a href="referralcards.php"><span>Referral Cards</span></a></li>




</ul>

</li>
<?php
 
 	}
 ?>
</ul>

</section>

<!-- /.sidebar -->

</aside>


<script>
$(document).ready(function(){
$(".drop-menu").click(function(){
$(".sub-menu").toggle();
});
});
</script>

<script type="text/javascript">


</script>


<style type="text/css">
.sub-menu {
margin: 0 0 0px;
padding-left: 36px;
}
.sub-menu li a {
font-size: 14px !important;
color: #333 !important;
font-weight: 400;
text-transform: capitalize !important;
}
.sub-menu li {
list-style: none;
margin-bottom: 2px;
}
.sub-menu li i {
margin-right: 6px;
}
.drop-menu {
font-size: 20px;
position: absolute;
right: 5px;
}
.skin-black-light .sidebar a {
color: #000 !important;
font-size: 15px;
text-transform: uppercase;
}
.sub-menu a {
padding: 2px 0 !important;
display: table;
}

</style>

