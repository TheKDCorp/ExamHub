<?php  
    include 'Connection.php';

$name=$_POST['username'];
$mobile=$_POST['password'];
$email=$_POST['email'];
	
$sql="insert into register(name,mobile)values('$name','$mobile')";
$conn->query($sql);

$response=array();
$response['error']="false";
$response['message']="Record Submitted done!!!";

echo json_encode($response);
?>