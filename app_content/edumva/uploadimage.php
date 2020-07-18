<?php

$output = array();

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$userId = $_POST["userId"];

$output['firstname'] =  $firstName;
$output['lastname'] =  $lastName;
$output['userid'] =  $userId;

$target_dir = "./image";
if(!file_exists($target_dir))
{
mkdir($target_dir, 0777, true);

$output['direct'] = "directorymade<br>";

}

$target_dir = $target_dir . "/" . basename($_FILES["file"]["name"]);

$output['targetdir'] = $target_dir;
$output['tempn'] = $_FILES["file"]["tmp_name"];

move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir);

echo json_encode($output);

?>
