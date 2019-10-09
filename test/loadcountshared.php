
	<table  class="table table-bordered">
<thead class="thead-light">
<tr>
<th>Sr#</th>	
<th>Name</th>	
<th>GSM</th>	
<th>Activation Date</th>	

</tr>
	
		
		</thead>	

<tbody>

<?php
	$sr =1;
include('connection.php');
$pid = $_POST['pid'];
$oabq = Run("Select * from paymenthistory where productid = '".$pid."' and isshared='1'  and cardactive='1'");	
while($loaders = myfetch($oabq))
{
$userid = $loaders['userid'];	
$sql = Run("select * from usermaster where userid= '" . $userid . "'");       
$row = myfetch($sql);
$name = $row['firstname']." ".$row['lastname'];
$gsm = $row['gsm'];
	
/////Created date////
$crr = "Select * from paymenthistory where productid = '".$pid."' and isshared='1'  and cardactive='1' and userid = '".$userid."'";
$oabq1 = Run($crr);	
$getpayments = myfetch($oabq1);
$activationdate = 	date("d M Y h:ia",strtotime($getpayments['createdtime']));			
	
?>	
<tr>
<td><?php echo $sr; ?></td>	
<td><?php echo $name; ?></td>	
<td><?php echo $gsm; ?></td>	
<td><?php echo $activationdate; ?></td>	
	
</tr>	
	
	
	
<?php	
$sr++;	
}

?>

</tbody>
</table>
