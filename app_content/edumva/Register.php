<?php  
	date_default_timezone_set("Asia/Calcutta");

    include 'Connection.php';

$output = array();

// $output['returnmsg']="done";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
}else{
	if($_GET['method']=="checkupdate"){
    	$sql = "select * from appupdate";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$message = str_replace(" ","_",$row['message']);
			$output["message"] = $message;
		}else{
			$output['message'] = "no_record_found";
		}
	echo json_encode($output);
	}

	if($_GET['method']=="login"){
		$inputuser = $_GET["inputuser"];
		$username= $_GET["username"];
	    $password= $_GET["password"];
	
		if($inputuser == "student"){
	    	$sql = "select * from students where username='$username' and password='$password' and role='student'";
			$result = $conn->query($sql);
			
			if($result->num_rows > 0){
				$output['response'] = "false";
				$output['gotopage'] = "no_record_found";
				$output['studentid'] = "no_record_found";
				$output['studentname'] = "no_record_found";
				$output['studentusername'] = "no_record_found";
				$output['studentclass'] = "no_record_found";
				$output['studentsection'] = "no_record_found";
				$output['studentfathersname'] = "no_record_found";
				$output['studentmothersname'] = "no_record_found";
				$output['studentmobileno'] = "no_record_found";
				$output['studentdob'] = "no_record_found";
				$output['studentemail'] = "no_record_found";
				$output['studentaddress'] = "no_record_found";

				$row = $result->fetch_assoc();
				$output["response"] = "true";
				$output["gotopage"] = $row["sid"];

				$output["studentid"] = $row["sid"];

				$name = str_replace(" ","_",$row['name']);
				$output["studentname"] = $name;

				$username = str_replace(" ","_",$row['username']);
				$output["studentusername"] = $username;

				$class = str_replace(" ","_",$row['class']);
				$output["studentclass"] = $class;

				$section = str_replace(" ","_",$row['section']);
				$output["studentsection"] = $section;

				$fathersname = str_replace(" ","_",$row['fathersname']);
				$output["studentfathersname"] = $fathersname;

				$mothersname = str_replace(" ","_",$row['mothersname']);
				$output["studentmothersname"] = $mothersname;

				$mobileno = str_replace(" ","_",$row['mobileno']);
				$output["studentmobileno"] = $mobileno;

				$dob = str_replace(" ","_",$row['dob']);
				$output["studentdob"] = $dob;

				$email = str_replace(" ","_",$row['email']);
				$output["studentemail"] = $email;

				$address = str_replace(" ","_",$row['address']);
				$output["studentaddress"] = $address;
			}else{
				$output['response'] = "false";
				$output['gotopage'] = "no_record_found";
				$output['studentid'] = "no_record_found";
				$output['studentname'] = "no_record_found";
				$output['studentusername'] = "no_record_found";
				$output['studentclass'] = "no_record_found";
				$output['studentsection'] = "no_record_found";
				$output['studentfathersname'] = "no_record_found";
				$output['studentmothersname'] = "no_record_found";
				$output['studentmobileno'] = "no_record_found";
				$output['studentdob'] = "no_record_found";
				$output['studentemail'] = "no_record_found";
				$output['studentaddress'] = "no_record_found";
			}
	    }elseif($inputuser == "parent"){
	    	$sql = "select * from students where username='$username' and password='$password' and role='parent' limit 1";
			$result = $conn->query($sql);

			if($result->num_rows > 0){
				$row = $result->fetch_assoc();
				$output['response'] = "true";
				$output['gotopage'] = $row['sid'];
			}else{
				$output['response'] = "false";
				$output['gotopage'] = "no_record_found";
			}
	    }
	echo json_encode($output);
	}

	if($_GET['method']=="getdata"){
		$tablename = $_GET['tablename'];
		$fieldname = $_GET['fieldname'];
		if(isset($_GET['condition'])){
			$condition = $_GET['condition'];
		}else{
			$condition = "";
		}

		if($condition==""){
			$sql = "select * from $tablename";
		}else{
			$sql = "select * from $tablename where $condition";			
		}
		$result = $conn->query($sql);

		if($result->num_rows > 0){
	      $row = $result->fetch_assoc();
	      $output['resultfield']=$row[$fieldname];	
	    }else{
	      $output['resultfield']="no_record_found!!!";
	    }
	echo json_encode($output);
	}

	if($_GET['method']=="calendergetfood"){
		$tablename = $_GET['tablename'];

		if(isset($_GET['condition'])){
			$condition = $_GET['condition'];
		}else{
			$condition = "";
		}
		// echo $condition."<br>";
		if($condition==""){
			$sql = "select * from $tablename";
		}else{
			$sql = "select * from $tablename where $condition";			
		}
		$result = $conn->query($sql);
		// echo $sql."<br>";

		if($result->num_rows > 0){
	      $row = $result->fetch_assoc();

	      $output['resultfield1']="no_record_found!!!";
	      $output['resultfield2']="no_record_found!!!";
	      $output['resultfield3']="no_record_found!!!";
	      $output['resultfield4']="no_record_found!!!";
	      $output['resultfield5']="no_record_found!!!";
	      $output['resultfield6']="no_record_found!!!";
	      $output['resultfield7']="no_record_found!!!";
	      $output['resultfield8']="no_record_found!!!";

	      $output['resultfield1']=$row['breakfast'];	
	      $output['resultfield2']=$row['lunch'];	
	      $output['resultfield3']=$row['refreshment'];	
	      $output['resultfield4']=$row['dinner'];	
	      $output['resultfield5']=$row['breakfastdescription'];	
	      $output['resultfield6']=$row['lunchdescription'];	
	      $output['resultfield7']=$row['refreshmentdescription'];	
	      $output['resultfield8']=$row['dinnerdescription'];	
	    }else{
	      $output['resultfield1']="no_record_found!!!";
	      $output['resultfield2']="no_record_found!!!";
	      $output['resultfield3']="no_record_found!!!";
	      $output['resultfield4']="no_record_found!!!";
	      $output['resultfield5']="no_record_found!!!";
	      $output['resultfield6']="no_record_found!!!";
	      $output['resultfield7']="no_record_found!!!";
	      $output['resultfield8']="no_record_found!!!";
	    }

	    $sql1 = "select * from calender_events where $condition";
		$result1 = $conn->query($sql1);
		if($result1->num_rows > 0){
			$output['resultfield9'] = "no_record_found!!!";
			$output['resultfield10'] = "no_record_found!!!";
			$output['resultfield11'] = "no_record_found!!!";
			$output['resultfield12'] = "no_record_found!!!";
			$output['resultfield13'] = "no_record_found!!!";

			$kk = 9;
			while($row1 = $result1->fetch_assoc()){
				// if($kk == "14"){
				// 	exit();
				// }
		        $output['resultfield'.$kk]=$row1['details'];
		        $kk = $kk +1;
			}
		}else{
	      $output['resultfield9']="no_record_found!!!";			
	      $output['resultfield10']="no_record_found!!!";			
	      $output['resultfield11']="no_record_found!!!";			
	      $output['resultfield12']="no_record_found!!!";			
	      $output['resultfield13']="no_record_found!!!";			
		}

	echo json_encode($output);
	}

	if($_GET['method']=="calenderevents"){
		$tablename = $_GET['tablename'];
		$fieldname1 = $_GET['fieldname1'];
		if(isset($_GET['condition'])){
			$condition = $_GET['condition'];
		}else{
			$condition = "";
		}
		// echo $condition."<br>";
		if($condition==""){
			$sql = "select * from $tablename";
		}else{
			$sql = "select * from $tablename where $condition";			
		}
		$result = $conn->query($sql);
		// echo $sql."<br>";

		if($result->num_rows > 0){
	      $row = $result->fetch_assoc();
	      $output['resultfield1']=$row[$fieldname1];	
	    }else{
	      $output['resultfield1']="no_record_found!!!";
	    }

	echo json_encode($output);
	}

	if($_GET['method']=="getfooditems"){
		$tablename = $_GET['tablename'];
		$fieldname1 = $_GET['fieldname1'];
		$fieldname2 = $_GET['fieldname2'];
		$fieldname3 = $_GET['fieldname3'];
		$fieldname4 = $_GET['fieldname4'];
		if(isset($_GET['condition'])){
			$condition = $_GET['condition'];
		}else{
			$condition = "";
		}
		if($condition==""){
			$sql = "select * from $tablename";
		}else{
			$sql = "select * from $tablename where $condition";			
		}
		$result = $conn->query($sql);

		if($result->num_rows > 0){
	      $row = $result->fetch_assoc();
	      $output['resultfield1']="no_record_found!!!";
	      $output['resultfield2']="no_record_found!!!";
	      $output['resultfield3']="no_record_found!!!";
	      $output['resultfield4']="no_record_found!!!";

	      $output['resultfield1']=$row[$fieldname1];	
	      $output['resultfield2']=$row[$fieldname2];	
	      $output['resultfield3']=$row[$fieldname3];	
	      $output['resultfield4']=$row[$fieldname4];
	
	    }else{
	      $output['resultfield1']="no_record_found!!!";
	      $output['resultfield2']="no_record_found!!!";
	      $output['resultfield3']="no_record_found!!!";
	      $output['resultfield4']="no_record_found!!!";

	    }
	echo json_encode($output);
	}


	if($_GET['method']=="getresults"){
		$tablename = $_GET['tablename'];
		$fieldname1 = $_GET['fieldname1'];
		$fieldname2 = $_GET['fieldname2'];
		$fieldname3 = $_GET['fieldname3'];
		$fieldname4 = $_GET['fieldname4'];
		$fieldname5 = $_GET['fieldname5'];
		$fieldname6 = $_GET['fieldname6'];
		$fieldname7 = $_GET['fieldname7'];
		$fieldname8 = $_GET['fieldname8'];
		$fieldname9 = $_GET['fieldname9'];
		$fieldname10 = $_GET['fieldname10'];
		$fieldname11 = $_GET['fieldname11'];
		$fieldname12 = $_GET['fieldname12'];
		$fieldname13 = $_GET['fieldname13'];
		$fieldname14 = $_GET['fieldname14'];
		$getallparts = $_GET['getallparts'];
		$instruction = $_GET['instruction'];

		if($instruction=="getlastqindex"){
			$instruction = "order by rid desc";
		}

		if(isset($_GET['condition'])){
			$condition = $_GET['condition'];
		}else{
			$condition = "";
		}
		if($condition==""){
			$sql = "select * from $tablename $instruction";
		}else{
			$sql = "select * from $tablename where $condition $instruction";			
		}
		$result = $conn->query($sql);

		if($result->num_rows > 0){
	      $row = $result->fetch_assoc();


	      if($getallparts=="true"){
	      	$cid = $row['cid'];
	      	$qindex = $row['qindex'];

	      	$output['part1name']="_";
	      	$output['part1totalmarks']="_";
	      	$output['part1marks']="_";
	      	$output['part2name']="_";
	      	$output['part2marks']="_";
	      	$output['part2totalmarks']="_";
	      	$output['part3name']="_";
	      	$output['part3marks']="_";
	      	$output['part3totalmarks']="_";
	      	$output['part4name']="_";
	      	$output['part4marks']="_";
	      	$output['part4totalmarks']="_";
	      	$output['part5name']="_";
	      	$output['part5marks']="_";
	      	$output['part5totalmarks']="_";
	      	$output['part6name']="_";
	      	$output['part6marks']="_";
	      	$output['part6totalmarks']="_";
	      	$output['part7name']="_";
	      	$output['part7marks']="_";
	      	$output['part7totalmarks']="_";
	      	$output['part8name']="_";
	      	$output['part8marks']="_";
	      	$output['part8totalmarks']="_";
	      	$output['part9name']="_";
	      	$output['part9marks']="_";
	      	$output['part9totalmarks']="_";
	      	$output['part10name']="_";
	      	$output['part10marks']="_";
	      	$output['part10totalmarks']="_";


	      $output['resultfield1']="no_record_found!!!";
	      $output['resultfield2']="no_record_found!!!";
	      $output['resultfield3']="no_record_found!!!";
	      $output['resultfield4']="no_record_found!!!";
	      $output['resultfield5']="no_record_found!!!";
	      $output['resultfield6']="no_record_found!!!";
	      $output['resultfield7']="no_record_found!!!";
	      $output['resultfield8']="no_record_found!!!";
	      $output['resultfield9']="no_record_found!!!";
	      $output['resultfield10']="no_record_found!!!";
	      $output['resultfield11']="no_record_found!!!";
	      $output['resultfield12']="no_record_found!!!";
	      $output['resultfield13']="no_record_found!!!";
	      $output['resultfield14']="no_record_found!!!";

	      	$sql11 = "select * from partsresult where cid='$cid' and qindex='$qindex'";
	      	$result11 = $conn->query($sql11);
	      	if($result11->num_rows > 0){
	      		$jid = 0;
	      		while($row11 = $result11->fetch_assoc()){
	      			$jid = $jid + 1;
	      			$output['part'.$jid.'name'] = $row11['partname'];
	      			$output['part'.$jid.'marks'] = $row11['mymarks'];
	      			$output['part'.$jid.'totalmarks'] = $row11['totalmarks'];
	      		}
	      	}
	      	$vv = $result11->num_rows;
	      	$output['noofparts']=''.$vv.'';
	      }


	      $field1 = str_replace(" ","_",$row[$fieldname1]);
	      $output['resultfield1']=$field1;	
	      $field2 = str_replace(" ","_",$row[$fieldname2]);
	      $output['resultfield2']=$field2;	
	      $field3 = str_replace(" ","_",$row[$fieldname3]);
	      $output['resultfield3']=$field3;	
	      $field4 = str_replace(" ","_",$row[$fieldname4]);
	      $output['resultfield4']=$field4;
	      $field5 = str_replace(" ","_",$row[$fieldname5]);
	      $output['resultfield5']=$field5;
	      $field6 = str_replace(" ","_",$row[$fieldname6]);
	      $output['resultfield6']=$field6;	
	      $field7 = str_replace(" ","_",$row[$fieldname7]);
	      $output['resultfield7']=$field7;	
	      $field8 = str_replace(" ","_",$row[$fieldname8]);
	      $output['resultfield8']=$field8;	
	      $field9 = str_replace(" ","_",$row[$fieldname9]);
	      $output['resultfield9']=$field9;	
	      $field10 = str_replace(" ","_",$row[$fieldname10]);
	      $output['resultfield10']=$field10;
	      $field11 = str_replace(" ","_",$row[$fieldname11]);
	      $output['resultfield11']=$field11;
	      $field12 = str_replace(" ","_",$row[$fieldname12]);
	      $output['resultfield12']=$field12;
	      $field13= str_replace(" ","_",$row[$fieldname13]);
	      $output['resultfield13']=$field13;	
	      $field14 = str_replace(" ","_",$row[$fieldname14]);
	      $output['resultfield14']=$field14;	

	    }else{
	      $output['resultfield1']="no_record_found!!!";
	      $output['resultfield2']="no_record_found!!!";
	      $output['resultfield3']="no_record_found!!!";
	      $output['resultfield4']="no_record_found!!!";
	      $output['resultfield5']="no_record_found!!!";
	      $output['resultfield6']="no_record_found!!!";
	      $output['resultfield7']="no_record_found!!!";
	      $output['resultfield8']="no_record_found!!!";
	      $output['resultfield9']="no_record_found!!!";
	      $output['resultfield10']="no_record_found!!!";
	      $output['resultfield11']="no_record_found!!!";
	      $output['resultfield12']="no_record_found!!!";
	      $output['resultfield13']="no_record_found!!!";
	      $output['resultfield14']="no_record_found!!!";
	    }
	echo json_encode($output);
	}

	if($_GET['method']=="checknoofnotifications"){
		$sql = "select * from notifications";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	      $row = $result->fetch_assoc();
	      $output['noofnotifications']=$result->num_rows;	
	    }else{
	      $output['noofnotifications']=$result->num_rows;
	    }
	echo json_encode($output);
	}

	if($_GET['method']=="getnotifications"){
		$recordno = $_GET['recordno'];
		$sql = "select * from notifications limit $recordno,1";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	      $row = $result->fetch_assoc();
	      $output['noofnotifications']=$row['message'];
	    }else{
	      $output['noofnotifications']="no_record_found";
	    }
	echo json_encode($output);
	}

	if($_GET['method']=="getimage"){
	    $output['imagelink']="10.1.1.32/edumva/Bird.jpg";
		echo json_encode($output);
	}

}

?>



