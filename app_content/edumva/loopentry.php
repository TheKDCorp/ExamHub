<?php  
    include 'Connection.php';

for ($year=2018; $year<=2020 ; $year++) { 
	for ($i=1; $i <=12; $i++) { 
		for($j=1;$j<=31;$j++){
			// $sql = "INSERT INTO food(fid,breakfast,lunch,refreshment,dinner,date,month,year,breakfast_img,lunch_img,refreshment_img,dinner_img)VALUES(DEFAULT,'breakfast".$j."','lunch".$j."','refreshment".$j."','dinner".$j."','".$j."','".$i."','".$year."','1_1.jpg','1_2.jpg','1_3.jpg','1_4.jpg')";
			$sql = "INSERT INTO calender_events(eventid,details,date,month,year)VALUES(DEFAULT,'Macro_Vision_Academy_Dance/nMacro_Vision_Func/nMacro_Vision_New".$j."','".$j."','".$i."','".$year."')";
			$conn->query($sql);
			echo $sql."<br>";
		}	
	}
}


?>