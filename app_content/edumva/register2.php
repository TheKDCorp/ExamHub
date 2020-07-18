<?php  
include 'Connection.php';

$output = array();


if($_GET['method']=="getdata"){
		// $tablename = $_GET['tablename'];
		// $fieldname = $_GET['fieldname'];

		// $sql = "select * from $tablename";
		// $result = $conn->query($sql);

		// if($result->num_rows > 0){
	 //      $row = $result->fetch_assoc();
	 //      echo $output['resultfield']=$row[$fieldname];
	 //      echo $output['resultfields']="jtain";
	 //    }else{
	 //      echo $output['resultfields']="jtains";

	 //    }
		// echo $output['rstlfiel']="return data";
	$output['jatin']="jatin";
}

echo json_encode($output);
?>