<?php

include 'classes/classDatabase.php';

$filename = "user_data.csv";
$fp = fopen('php://output', 'w');

// $sql = "SELECT * FROM login_master where is_delete=0 ";
// $query = $db->query($sql);

// if($query->num_rows > 0 ) {
//     $Row = $query->fetch_assoc();
//     $_SESSION['login_user'] = $Row['id'];
//     $_SESSION['user_name'] = $Row['user_name'];
//     $_SESSION['user_role'] = $Row['user_role'];
//     header("location: index.php");
// }

// $query = "S";
// $result = mysql_query($query);
// print_r($result);
// echo "here";
// exit();
// // $sql = "SELECT * FROM login_master where is_delete=0 ";
// // $query = $db->query($sql);
$sqlqq = "select * from question_master qm where qm.is_delete=0";
 	$queryqq = $db->query($sqlqq);
 	if( mysqli_num_rows($queryqq) > 0) {
 		$q = 0;
 		$header[]='User Name';
 		$header[]='Email Id';
 		$header[]='Mobile No';
	 	while ($row = mysqli_fetch_assoc($queryqq)) {
			$header[] = strip_tags($row['question']);
		}	
	}
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

// $query = "SELECT * FROM toy";
// $result = mysql_query($query);
$sql = "SELECT * FROM drink_register where is_delete=0 ";
$query = $db->query($sql);
// $JSON = array();
$k = 0;
while($row = $query->fetch_assoc()) {
	$JSON = array();
	$JSON['reg_fname'] = $row['reg_fname'];
	$JSON['reg_email'] = $row['reg_email'];
	$JSON['reg_phone'] = $row['reg_phone'];
	// fputcsv($fp, $row);
	// 
	$sqlqq = "select * from question_master qm where qm.is_delete=0";
 	$queryqq = $db->query($sqlqq);
 	if( mysqli_num_rows($queryqq) > 0) {
 		$q = 0;
	 	while ($rowq = mysqli_fetch_assoc($queryqq)) {
	 		
	 		$sqla = "select * from answer_master am where am.question_id=".$rowq['id']." and am.user_id=".$row['id'];
 			$querya = $db->query($sqla);
 			$rowa = mysqli_fetch_assoc($querya);
 			// $JSON['q_a'][$q]['question'] = $rowq['question']; 
 			$JSON['answer'.$q] = $rowa['answer']; 
			    	// echo $rowa['answer'];
 			$q++;
	 	}
 	}
	
	// echo "<pre>";
	// print_r($JSON);
	// echo "</pre>";
	fputcsv($fp, $JSON);
	$k++;
}
// 	fputcsv($fp, $JSON);
exit;
?>