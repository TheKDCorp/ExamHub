<style type="text/css">
	#customers {
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    border-collapse: collapse;
	    width: 100%;
	}

	#customers td, #customers th {
	    border: 1px solid #ddd;
	    padding: 8px;
	}

	#customers tr:nth-child(even){background-color: #f2f2f2;}

	#customers tr:hover {background-color: #ddd;}

	#customers th {
	    padding-top: 12px;
	    padding-bottom: 12px;
	    text-align: left;
	    background-color: #4CAF50;
	    color: white;
	}
</style>

<?php 
	include_once('../includes/dbcon.php');

	$id = stripslashes(trim(mysqli_real_escape_string($conn,$_GET['qpid'])));

	$settingssql = "select * from questionpaper where qpid='$id'";
	$settingsresult = $conn->query($settingssql);
	if($settingsresult->num_rows > 0){
	  $settingsrow = $settingsresult->fetch_assoc();
	  $srnotype = $settingsrow['srnotype'];
	}

	$sql = "select * from questionentry where qpid='$id'";

	if($id==""){
	    header('Location: ../');
	    exit();
	}

	$sql = "select * from questionentry where qpid = $id";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
	    $row = $result->fetch_assoc();
	}else{
	    exit();
	}

	$sql1= "select * from questionpaper where qpid='$id'";
    $result1=$conn->query($sql1);
    if($result1->num_rows > 0){
    $row1=$result1->fetch_assoc();
    for ($i=1; $i <= $row1['noofparts']; $i++){ 
    	 
	    } 
	}

?>

		<?php 
		if($result1->num_rows > 0){
	        for($j=1;$j<$i;$j++){
	        	echo '<table style="width:100%;" id="customers">';

	        	$sql99= "select * from questionpaper where qpid='$id'";
			    $result99=$conn->query($sql99);
			    if($result99->num_rows > 0){
				    $row99=$result99->fetch_assoc();
				    $partname = $row99['part'.$j.'name'];
			    }
	        	echo '<thead><tr><td colspan="10" style="align:center;"><strong>'.$partname.': </strong></tr>';
	        	?>
	        	<tr>
	        		<td><strong>Que</strong></td>
	        		<td><strong>Corr. Ans</strong></td>
	        		<td><strong>Que</strong></td>
	        		<td><strong>Corr. Ans</strong></td>
	        		<td><strong>Que</strong></td>
	        		<td><strong>Corr. Ans</strong></td>
	        		<td><strong>Que</strong></td>
	        		<td><strong>Corr. Ans</strong></td>
	        		<td><strong>Que</strong></td>
	        		<td><strong>Corr. Ans</strong></td>
	        	</tr>
	        	<?php
	        	echo '</thead>';
	        	echo '<tbody>';
	        	$ano = 0;
	        	$uno = 0;
		        $sql2 = "select * from questionentry where qpid='$id' and part='$j'";
		        $result2=$conn->query($sql2);
		        if($result2->num_rows > 0){
		        	echo '<tr style="border:1px solid black;">';
		            while($row2=$result2->fetch_assoc()){
		            	if(($uno%5)==0){
		            		echo '</tr>';
		            		echo '<tr style="">';
		            	}
		            	$ano = $ano +1;
		            	echo '<td style="">Que '.$ano.'</td>';
		            	$ans = $row2['correctoption'];

                            $sql = "select * from settings limit 1";
                            $rs1=$conn->query($sql);
                            if($rs1->num_rows > 0){
                              $settings = $rs1->fetch_assoc();
                            }

                            if($srnotype=="alphabets"){
                                if($ans == "1"){
				            		$myans = "A";
				            	}elseif($ans=="2"){
				            		$myans = "B";
				            	}elseif($ans=="3"){
				            		$myans = "C";
				            	}elseif($ans=="4"){
				            		$myans = "D";
				            	}
                            }else{
                                if($ans == "1"){
				            		$myans = "1";
				            	}elseif($ans=="2"){
				            		$myans = "2";
				            	}elseif($ans=="3"){
				            		$myans = "3";
				            	}elseif($ans=="4"){
				            		$myans = "4";
				            	}
                            }

		            	
						echo '<td style="">'.$myans.'</td>';
						$uno = $uno + 1;
		       		}
		       		echo '</tr></tbody>';
		       	}
		       	echo '</table>';
		       	echo '<br>';
		       	echo '<br>';
		    }
		    
		}   
		?>
	<tr>
	</tr>
</table>