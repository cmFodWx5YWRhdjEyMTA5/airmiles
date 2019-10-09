<?php
include 'header.php';
?>
<style type="text/css">
.info-box-text {
    font-size: 20px;
    margin-top: 26px;
}
.info-box a {
    display: inline-block;
    height: 100%;
    width: 100%;
}
@media (max-width: 1199px) and (min-width: 991px) {
 .col-md-3 {
 width: 50%;
}
}
@media (max-width: 1199px) and (min-width: 768px) {
 .info-box-text {
 font-size: 18px;
 margin-top: 26px;
}
}
</style>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper"> 
  
  <!-- Content Header (Page header) -->
  
  <section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
      <li><a><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <?php
	if($userRole != 'reports')
	{
	?>
  <section class="content"> 
    
    <!-- Info boxes -->
    
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box"> <a href="index.php"> <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>
          <div class="info-box-content"> <span class="info-box-text">Dashboard</span> </div>
          </a> 
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box"> <a href="admin.php"> <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>
          <div class="info-box-content"> <span class="info-box-text">Admin</span> </div>
          </a> 
        </div>
      </div>
      
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box"> <a href="homeslider.php"> <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>
          <div class="info-box-content"> <span class="info-box-text">Home Slider</span> </div>
          </a> 
        </div>
      </div>
      
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box"> <a href="category.php"> <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>
          <div class="info-box-content"> <span class="info-box-text">Category</span> </div>
          </a> 
        </div>
      </div>
      
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box"> <a href="product.php"> <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>
          <div class="info-box-content"> <span class="info-box-text">Gift Cards</span> </div>
          </a> 
        </div>
      </div>
 
      <!-- fix for small devices only -->
      
      <div class="clearfix visible-sm-block"></div>
    </div>
  </section>
  
  <!-- /.content --> 
  <?php
	}
	
	?>
</div>

<!-- /.content-wrapper -->

<?php
include 'footer.php';
?>