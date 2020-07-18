<?php
include_once('../includes/dbcon.php');


	$sql = "select * from students";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			sendmessage($row['mobileno']);
		}
	}


	function sendmessage($send_msg){
		// Authorisation details.
			$username = "jatingangwani500@gmail.com";
			$hash = "80959010c1286a86f0e6200dca87a5cd51d83f1f9ded5b49d158a6c7fe516018";

			// Config variables. Consult http://api.textlocal.in/docs for more info.
			$test = "0";

			// Data for text message. This is the text message data.
			$sender = "TXTLCL"; // This is who the message appears to be from.
			$numbers = $send_msg; // A single number or a comma-seperated list of numbers
			$message = "This is a test message send by jatin gangwani.";
			// 612 chars or less
			// A single number or a comma-seperated list of numbers
			$message = urlencode($message);
			$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
			$ch = curl_init('http://api.textlocal.in/send/?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch); // This is the result from the API
			curl_close($ch);
	}


?>