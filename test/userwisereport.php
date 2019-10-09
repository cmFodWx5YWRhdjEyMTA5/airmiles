<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Wise Report</title>
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
  			<h1 style="text-align: center;">User Wise Report</h1>
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
Name</th>
<th>GSM</th>

<th>Referral Code</th>	
<th>Successfull Referral</th>

<th>Referral Names</th>	
<th>Referral GSM</th>	
<th>Referral Date</th>	
	
			
<th>Rewarded Card </th>	
				
<th>Rewarded Card Amount</th>	
<th>Rewarded Card Activation Date</th>	
		
	</tr>
</thead>
	
<tbody>	



<?php
	
include("connection.php");
	$sr =1;
$query = Run("Select * from usermaster order by userid  desc");
while($getdata = myfetch($query))
{
$id = $getdata['userid'];	
$sql = Run("select myrefcode from usermaster where userid= '" . $id . "'");       
$row = myfetch($sql);
$myreferralcode = $row['myrefcode'];

	
	
	
	
	
$sql = Run("select count(referralcode) as referralcodes from usermaster where referralcode= '" . $myreferralcode . "'");
$row = myfetch($sql);
$referralcodecount = $row['referralcodes'];
	
	
	//echo $referralcode;
        $sql = Run("select * from referralcards order by referralcount asc");
          
        while ($row = myfetch($sql)) {
            $a= $row['referralcount'];
            if($referralcodecount >= $a ){
                $active = 1;
            }
            else{
                 $active = 0;
            }

          
               
			if($referralcodecount>3 && $active=1)
			{
				
				
$nams = "";	
				$phones="";
				$dates="";
$sql23 = Run("select * from usermaster where referralcode= '" . $myreferralcode . "'");
while($rowas = myfetch($sql23))
{
$nams = $nams."<br/>".$rowas['firstname'];
$phones = $phones."<br/>".$rowas['gsm'];
$dates = $dates ."<br/>".date("d M Y h:ia",strtotime($rowas['createddate']));

}
				
$nm = ltrim($nams,"<br/>");				
				
$ph = ltrim($phones,"<br/>");				
$dt = ltrim($dates,"<br/>");				
				
				
				
				
				
				
	////////////////////Rewarded Card Activation Date
				
$paym = Run("Select * from paymenthistory where userid = '".$getdata['userid']."' AND referralproductid = '".$row['id']."'");				
$details = myfetch($paym);
$activationdate = 	date("d M Y h:ia",strtotime($details['createdtime']));			
				
				
				
				
				
?>
          <tr>
<td><?php echo $sr; ?></td>	
<td><?php echo $getdata['firstname']; ?></td>	
<td><?php echo $getdata['gsm']; ?></td>	

<td><?php echo $myreferralcode; ?></td>	
<td><?php echo $referralcodecount; ?></td>	


<td><?php echo $nm; ?></td>	
<td><?php echo $ph; ?></td>	

<td><?php echo $dt; ?></td>	



<td><?php echo $row['cardname']; ?></td>	

<td><?php echo $row['actualprice']; ?> - <?php echo $row['pricecurrency']; ?></td>	
<td><?php echo $activationdate; ?></td>	

</tr>
          <?php

          $sr++;
        }
		
		
		
		}	
	
	
}

?>	

</tbody>
</table>
  		</div>
  	</div>
  	
  	</div>
  </body>
</html>



