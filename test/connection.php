<?php
	function Run($qst)
	{
	$dbh = new PDO('mysql:host=giftiproductiondatabase.c83lu4ctkfw7.ap-south-1.rds.amazonaws.com;dbname=Gifti_Data', 'giftiproduction', 'GsKXN~T$^Pv?V?Kw');
	$qst=$dbh->query($qst) or die(print_r($dbh->errorInfo()));
	return $qst;
	}	

	function rcount($qst)
	{
	$qst = $qst->rowCount();
	return $qst;
    }




function myfetch($var)
{
	$var = $var->fetch();
	return $var;
	
}


?>
