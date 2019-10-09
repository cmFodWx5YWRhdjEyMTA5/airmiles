<!DOCTYPE html>
<html lang="en">
<head>
  <title>Card Wise Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
	
.demo-2 .main h1 {
	margin: 1em 0 0.5em 0;
	font-weight: 600;
	font-family: 'Titillium Web', sans-serif;
	position: relative;  
	font-size: 36px;
	line-height: 40px;
	padding: 15px 15px 15px 15%;
	color: #355681;
	box-shadow: 
		inset 0 0 0 1px rgba(53,86,129, 0.4), 
		inset 0 0 5px rgba(53,86,129, 0.5),
		inset -285px 0 35px white;
	border-radius: 0 10px 0 10px;
	background: #fff url(../images/bartoszkosowski.jpg) no-repeat center left;
}

.demo-2 .main h2 {
	margin: 1em 0 0.5em 0;
	font-weight: normal;
	position: relative;
	text-shadow: 0 -1px rgba(0,0,0,0.6);
	font-size: 28px;
	line-height: 40px;
	background: #355681;
	background: rgba(53,86,129, 0.8);
	border: 1px solid #fff;
	padding: 5px 15px;
	color: white;
	border-radius: 0 10px 0 10px;
	box-shadow: inset 0 0 5px rgba(53,86,129, 0.5);
	font-family: 'Muli', sans-serif;
}

.demo-2 .main h3 {
	margin: 1em 0 0.5em 0;
	font-weight: 600;
	font-family: 'Titillium Web', sans-serif;
	position: relative;
	text-shadow: 0 -1px 1px rgba(0,0,0,0.4);
	font-size: 22px;
	line-height: 40px;
	color: #355681;
	text-transform: uppercase;
	border-bottom: 1px solid rgba(53,86,129, 0.3);
}

.demo-2 .main h4 {
	margin: 1em 0 0.5em 0;
	font-weight: 600;
	font-family: 'Titillium Web', sans-serif;
	position: relative;
	font-size: 18px;
	line-height: 20px;
	color: #788699;
	font-family: 'Muli', sans-serif;
}
	
</style>
</head>
  <body>
  <div class="container">
  	<div class="row" style="margin-top: 5%;">
  		<div class="col-md-12">
  			<h1 style="text-align: center;">Card Wise Report</h1>
  		</div>
  	</div>
  	
  	
  	<div class="row" style="margin-top: 5%;">
  		<div class="col-md-12">
  			<table  class="table table-bordered">
<thead class="thead-light">
	<tr>
<th>
Sr#
</th>	
<th>
Card Id
</th>
<th>
Card Name
</th>	

	
	<th>
Price
	</th>		
		
<th>
Category
</th>				
					
<th>
No Of Activations(OAB) 
</th>	
		
<th>
No Of Activations(Non OAB) 
</th>		
		
<th>
Shared
</th>		
				
		
	</tr>
</thead>
	
<tbody>	



<?php
	$sr =1;
include("connection.php");
$query = Run("Select * from product where isactive=1");
while($getdata = myfetch($query))
{
$productid = $getdata['id'];	
$categoryid = $getdata['categoryid'];
	
	
$catn = Run("Select * from appcategory where id = '".$categoryid."'");
$ft = myfetch($catn);	
$fname = $ft['name'];	
	
	
$oabq = Run("Select * from paymenthistory where productid = '".$productid."' and isoab='1'  and cardactive='1'");	
$countoab = rcount($oabq);	

$oabq1 = Run("Select * from paymenthistory where productid = '".$productid."' and isoab='0' and cardactive='1'");	
$countnonoab = rcount($oabq1);	
	
	
$sharingtimes = Run("SELECT SUM(isshared) as shared FROM paymenthistory where productid='".$productid."' and cardactive='1' and isshared='1'");	
$getsharings = myfetch($sharingtimes);
$shared = $getsharings['shared'];	
if($shared=="")
{
$shared =0;
}
	
	
	
if($countoab>0 || $countnonoab>0 || $shared>0)	
{
	
	
?>
<tr>
<td><?php echo $sr; ?></td>	
<td><?php echo $productid; ?></td>	

<td><?php echo $getdata['cardname']; ?></td>

<td><?php echo $getdata['actualprice']; ?> - <?php echo $getdata['pricecurrency']; ?></td>	
	
			
<td><?php echo $fname; ?></td>	
	
<td  > <a href="javascript:;" onClick="loadcountoab('<?php echo $productid; ?>','OAB Users')" style="color:<?php if($countoab>0){ echo "red"; } ?>"> <?php echo $countoab; ?></a> </td>	
<td><a href="javascript:;" onClick="loadcountnonoab('<?php echo $productid; ?>','Non OAB Users')" style="color:<?php if($countnonoab>0){ echo "red"; } ?>"><?php echo $countnonoab; ?></td>	
<td><a href="javascript:;" onClick="loadcountshared('<?php echo $productid; ?>','Shared')" style="color:<?php if($shared>0){ echo "red"; } ?>"><?php echo $shared; ?></td>	
	
</tr>	
	
	
	
	

	
<?php	
	$sr++;
}
}





?>

</tbody>
</table>
  		</div>
  	</div>
  	
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h2 class="modal-title" id="exampleModalLongTitle" style="text-align: center;"></h2>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" id="modalbdyin">

</div>
<div class="modal-footer" style="text-align: center">
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	</div>
  </body>
</html>

<script>
function loadcountoab(pid,description)
{
document.getElementById('modalbdyin').innerHTML ="Loading...";
document.getElementById('exampleModalLongTitle').innerHTML=description;
javascript:$('#exampleModalCenter').modal('show', {backdrop: 'static'});
$.post("loadcountoab.php",{pid:pid},function(data){
$("#modalbdyin").html(data);});
}


function loadcountnonoab(pid,description)
{
document.getElementById('modalbdyin').innerHTML ="Loading...";
document.getElementById('exampleModalLongTitle').innerHTML=description;
javascript:$('#exampleModalCenter').modal('show', {backdrop: 'static'});
$.post("loadcountnonoab.php",{pid:pid},function(data){
$("#modalbdyin").html(data);});
}

function loadcountshared(pid,description)
{
document.getElementById('modalbdyin').innerHTML ="Loading...";
document.getElementById('exampleModalLongTitle').innerHTML=description;
javascript:$('#exampleModalCenter').modal('show', {backdrop: 'static'});
$.post("loadcountshared.php",{pid:pid},function(data){
$("#modalbdyin").html(data);});
}
</script>

