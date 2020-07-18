<?php

require_once "../../dompdf/autoload.inc.php";

// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();

include('../includes/dbcon.php');

$sql = "select * from questionpaper";
$result=$conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}else{
  echo "No. Record Found!!!";
  exit();
}

$output = '<table class="table table-striped table-bordered" style="width:100%;">
    <thead class="text-primary">
      <tr>
          <th>Q.P. ID</th>
          <th>Name</th>
          <th>Total Marks</th>
          <th>No. Of Que</th>
          <th>Subject</th>
          <th>No. Of Parts</th>
        </tr>
    </thead>
    <tbody>';
	  $output .= "<tr><td>" . $row['qpid'] . "</td>" ."<td>" . $row['name'] . "</td>" ."<td>" . $row['totalmarks'] . "</td>" ."<td>" . $row['totalquestions'] . "</td>" ."<td>" . $row['subject'] . "</td>" ."<td>" . $row['noofparts'] . "</td><tr>";
    ?>
    
<?php
$output .= '</tbody></table>';

// echo $output;

$document->loadHtml($output);

//set page size and orientation

$document->setPaper('A4', 'landscape');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Webslesson", array("Attachment"=>0));
//1  = Download
//0 = Preview


?>