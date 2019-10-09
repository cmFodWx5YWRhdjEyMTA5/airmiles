<table border="1">
<thead>
<tr>
<th>
Sr#
</th>	
<th>
Campaign ID</th>
<th>Card Name</th>
<th>Status</th>	
</tr>
</thead>
	
<tbody>	



<?php
	$sr =1;
include("connection.php");
	$json = array();
  $k = 0;
$query = Run("Select campaign_id from product where isactive='1' group by campaign_id");
while($getdata = myfetch($query))
{
$campaign_id = $getdata['campaign_id'];	
$sql = Run("select cardname from product where campaign_id= '" . $campaign_id . "'");       
$row = myfetch($sql);
$cardname = $row['cardname'];
?>
<tr>
<td><?php echo $sr; ?></td>	
<td><?php echo $campaign_id; ?></td>	
<td><?php echo $cardname; ?></td>
<td></td>	
	
</tr>
<?php

	
	
	
	
	$sr++;
	
	
	
	
	
	
}

?>	

</tbody>
</table>

