<?php 
include 'Connection.php';
$response = array();


$name=$_GET['name'];
$mobile=$_GET['mobile'];

$sql="insert into register(name,mobile)values('$name','$mobile')";
$conn->query($sql);

$response['name'] = $name;
$response['mobile'] = $mobile;
$response['message'] = "Record Added Successfully";
$response['error'] = "false";


echo json_encode($response);

 ?>