<?php 


include '../includes/dbcon.php';


for ($i=1; $i <= 100; $i++) { 
	if(($i>=1)&&($i<=9)){
		$sql = "insert into students(sid,name,username,password,role,class,loggedin,updated,oldpassword,batch,active)values(DEFAULT,'000".$i."','000".$i."@gmail.com','000".$i."','student','Class 1','false','true','000".$i."','NEET','yes')";
	}elseif(($i>=10)&&($i<=99)){
		$sql = "insert into students(sid,name,username,password,role,class,loggedin,updated,oldpassword,batch,active)values(DEFAULT,'00".$i."','00".$i."@gmail.com','00".$i."','student','Class 1','false','true','00".$i."','NEET','yes')";
	}elseif(($i>=100)&&($i<=999)){
		$sql = "insert into students(sid,name,username,password,role,class,loggedin,updated,oldpassword,batch,active)values(DEFAULT,'0".$i."','0".$i."@gmail.com','0".$i."','student','Class 1','false','true','0".$i."','NEET','yes')";
	}
	echo $sql ."<br>";
	$conn->query($sql);
}

 ?>