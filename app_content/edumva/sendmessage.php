<?php
	$username = "jatingangwani500@gmail.com";
	$hash = "80959010c1286a86f0e6200dca87a5cd51d83f1f9ded5b49d158a6c7fe516018";

	$test = "0";

	$sender = "MVA-JT";
	$numbers = "9171972593";
	$message = "This is a test message send by jatin gangwani";
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
?>