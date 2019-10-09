<html>
	<head>
    	<link href="../css/payments-inter.css" rel="stylesheet" type="text/css">
	    <style>
		    .clr {
		        overflow: hidden;
		    }
		    .mer-logo-wrap {
		        text-align: left;
		        padding-left: 35px;
		    }
		    .header-table {
		        width: 100%;
		    }
		    .header-table td {
		        vertical-align: middle;
		        width: 49.9%;
		    }
		    .mer-logo-wrap > img {
		        max-height: 75px;
		    }
		    .payz-logo-wrap {
		        text-align: right;
		        padding-right: 35px;
		    }
		    .norm-hd {
		        padding: 15px 0;
		        position: relative;
		        z-index: 1000;
		        border-bottom: 1px solid #e5e5e5;
		    }
		    
		    .success-info {
    			background: none repeat scroll 0 0 #dff2de;
    			border: 2px solid #468847;
    			color: #B94A48;
			}
			.success-info font{
				color: green;
			}
			.failure-info font{
				color: red;
			}
		</style>
		
	<?php 
	
	   include ("../libFiles/iPayOabPipe.php");
		$result = -1;
		$myObj = new iPayOabPipe();
	   try {
			
		$resourcePath = "/var/www/html/oabpayment/cgnFiles/24/";
			$aliasName = "GIFTI2019";
			// use "oabcardprofile01" as alias name for oab cards


			$myObj->setResourcePath(trim($resourcePath));
			$myObj->setKeystorePath(trim($resourcePath));
			$myObj->setAlias(trim($aliasName));
			$trandata = isset($_GET['trandata']) ? $_GET['trandata'] : $_POST['trandata'];
			$result = $myObj->parseEncryptedRequest($trandata);
		} catch(Exception $e) {
			echo 'Message: ' .$e->getFile();
	  		echo 'Message1 : ' .$e->getCode();
		}
include ("../../admin/classes/classDatabase.php");
include ("../../admin/classes/classDashboard.php");
	    $ClientsObj = new Dashboard( $db );
  
    
if($result == 0 && $myObj->getresult() != "CAPTURED"){ 
    $ClientsObj->errorcode =$myObj->getresult() ;
    $ClientsObj->transactionstatus = '';
    $ClientsObj->transactionrefid = $myObj->gettrackId();   
    $ClientsObj->transactionid = '';
    $ClientsObj->paymentid = '';
}else{

$ClientsObj->errorcode = '';

if($myObj->getresult() != null){$ClientsObj->transactionstatus = $myObj->getresult();}
   if($myObj->gettransId() != null){ $ClientsObj->transactionid = $myObj->gettransId();}
   if($myObj->getpaymentId() != null){ $ClientsObj->paymentid = $myObj->getpaymentId();}
       $ClientsObj->transactionrefid = $myObj->gettrackId();   
}
 

    
    $response = $ClientsObj->updatetransaction();
 	$var1 = json_decode($response);

  	if($var1->status && $myObj->gettransId() != null && $myObj->getpaymentId() != null && $myObj->getresult() == "CAPTURED"){
  		
echo "<script>window.location.href='http://gifticms.meritincentives.com/thankyou.html'</script>";

  	}else{
  				
echo "<script>window.location.href='http://gifticms.meritincentives.com/error.html'</script>";
  	}
	?>	
		
	</head>
	<body>
        <div class="wrap" id="detect-iframe">
			<form name="formACS" id="formACS" action="../" method="POST" target="_parent" style="display: none;">
        	<table <?php if($result == 0 && $myObj->getresult() != "CAPTURED"){ ?> class="info failure-info"  <?php }else{ ?> class="info success-info" <?php } ?> >
				<tr>
					<td>
						<table align="center">
							<tr>
								<td colspan="2" align="center">
									<h2><B>Transaction Details   </B></h2>
								</td>
							</tr>
							<?php if($result == 0){
								if($myObj->geterror() != null && $myObj->geterror() != ""){ ?>
									<tr>	
										<td>Error</td> <td> &nbsp;&nbsp;<b><font size="2" color="red"><?php echo $myObj->geterror()?></font></b></td>
									</tr>
									<tr>	
										<td>Error Text</td> <td> &nbsp;&nbsp;<b><font size="2" color="red"><?php echo $myObj->geterror_text()?></font></b></td>
									</tr>
							<?php } else { ?>
									<tr>
										<td>Transaction Status</td><td> &nbsp;&nbsp;<b><font size="2" color="red"><?php echo $myObj->getresult()?></font></b></td>
									</tr>
									<?php  if($myObj->getDate() != null){ ?>
									<tr>
										<td>Post Date</td><td> &nbsp;&nbsp;<?php echo $myObj->getDate()?></td>
									</tr>
									<?php  } if($myObj->getref() != null){ ?>
									<tr>
										<td>Transaction Reference ID</td><td>&nbsp;&nbsp;<?php echo $myObj->getref()?></td>
									</tr>
									<?php  } if($myObj->gettrackId() != null){ ?>
									<tr>
										<td>Mrch Track ID</td><td>&nbsp;&nbsp;<?php echo $myObj->gettrackId()?></td>
									</tr>
									<?php  } if($myObj->gettransId() != null){ ?>
									<tr>
										<td><b>Transaction ID</b></td><td>&nbsp;&nbsp;<?php echo $myObj->gettransId()?></td>
									</tr>
									<?php  } if($myObj->getamt() != null){ ?>
									<tr>
										<td>Transaction Amount</td><td>&nbsp;&nbsp;<?php echo $myObj->getamt()?></td>
									</tr>
									<?php  } if($myObj->getUdf1() != null){ ?>
									<tr>
										<td>UDF1</td><td>&nbsp;&nbsp;<?php echo $myObj->getUdf1()?></td>
									</tr>
									<?php  } if($myObj->getUdf2() != null){ ?>
									<tr>
										<td>UDF2</td><td>&nbsp;&nbsp;<?php echo $myObj->getUdf2()?></td>
									</tr>
									<?php  } if($myObj->getUdf3() != null){ ?>
									<tr>
										<td>UDF3</td><td>&nbsp;&nbsp;<?php echo $myObj->getUdf3()?></td>
									</tr>
									<?php  } if($myObj->getUdf4() != null){ ?>
									<tr>
										<td>UDF4</td><td>&nbsp;&nbsp;<?php echo $myObj->getUdf4()?></td>
									</tr>
									<?php  } if($myObj->getUdf5() != null){ ?>
									<tr>
										<td>UDF5</td><td>&nbsp;&nbsp;<?php echo $myObj->getUdf5()?></td>
									</tr>
									<?php  } if($myObj->getpaymentId() != null){ ?>
									<tr>
										<td>Payment ID</td><td>&nbsp;&nbsp;<?php echo $myObj->getpaymentId()?></td>
									</tr>
									<?php } 
								}
							}?>								
							</table>
						</td>
					</tr>
				</table>
			<br>
        </form>
            <p class="no-re-warn return-flkp succ"><a class="btn btn-danger" onclick="document.getElementById('formACS').submit();" target="_parent">Click here</a> for go to Home page </p>
        </div>
        <script>
            if (!(self === window.top)) {
                var el = document.getElementById('detect-iframe');
                if (el) {
                    el.className += ' iframe';
                }
            }
        </script>

	</body>
</html>