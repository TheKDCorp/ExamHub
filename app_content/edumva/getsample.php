<?php 

include 'Connection.php';

$response = array();

$sql = "SELECT * FROM details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // while($row = $result->fetch_assoc()) {
	$row = $result->fetch_assoc();
        $response['name'] = $row["name"];
        $response['capital'] = $row["name"];
        $response['alpha2'] = $row["name"];
        $response['alpha3'] = $row["name"];
        $response['region'] = $row["name"];
        $response['subregion'] = $row["name"];
    // }
} else {
    echo "0 results";
}


echo json_encode($response);

 ?>