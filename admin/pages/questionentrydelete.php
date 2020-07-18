<?php 
	include_once('../includes/dbcon.php');
	$id = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['id']))));

	if(isset($_GET['qpid'])){
		$qpid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['qpid']))));	
	}else{
		$qpid="";
	}
	
	$sql = "DELETE FROM questionentry WHERE qid='$id'";
	$conn->query($sql);

	if($qpid!=""){
		header("Location: questionentryforexam.php?qpid=".$qpid);	
		echo "ht";
	}else{
		header("Location: questionentry.php");
		echo "jt";
	}


 ?>