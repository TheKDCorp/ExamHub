<?php 
include_once('../includes/dbcon.php');

	$question = addslashes(htmlspecialchars($_POST['qquestion'],ENT_QUOTES));
	$option1 = addslashes(htmlspecialchars($_POST['qoption1'],ENT_QUOTES));
	$option2 = addslashes(htmlspecialchars($_POST['qoption2'],ENT_QUOTES));
	$option3 = addslashes(htmlspecialchars($_POST['qoption3'],ENT_QUOTES));
	$option4 = addslashes(htmlspecialchars($_POST['qoption4'],ENT_QUOTES));
	$correctoption = addslashes(htmlspecialchars($_POST['qcorrectanswer'],ENT_QUOTES));
	$questionid = addslashes(htmlspecialchars($_POST['questionid'],ENT_QUOTES));
	$queno = addslashes(htmlspecialchars($_POST['queno'],ENT_QUOTES));
	$solution = addslashes(htmlspecialchars($_POST['qsolution'],ENT_QUOTES));
	
	$qpname = $_POST['name'];
	$qpid = $_POST['qpid'];
	$part = $_POST['part'];
	$level = $_POST['level'];
	$positivemarks = $_POST['positivemarks'];
	$negativemarks = $_POST['negativemarks'];

	if($negativemarks == ""){
		$negativemarks="0";
	};

	$img = "true";

	$sql = "select * from questionentry where qid='$questionid'";
	$result=$conn->query($sql);
		$imgid=$result->num_rows;
		
		if ($imgid=="0"){
			$imgid=1;
		}else{
			$imgid=$imgid+1;
		}

		$myqueimg = "";
		$myopt1img = "";
		$myopt2img = "";
		$myopt3img = "";
		$myopt4img = "";

		if(isset($_FILES["quefile"]) && !empty($_FILES["quefile"])) {
			$target_file = "../uploads/questions/" .md5($qpid."_".$queno) .".jpg";
			if(move_uploaded_file($_FILES["quefile"]["tmp_name"], $target_file)){
				$myqueimg = $qpid."_".$queno;
				echo $myqueimg;
			}
			
		}
		if(isset($_FILES["opt1file"]) && !empty($_FILES["opt1file"])) {
			$opt1img = "true";
			$target_file1 = "../uploads/questions/options/" .md5($qpid."_".$queno."_1") .".jpg";
			if(move_uploaded_file($_FILES["opt1file"]["tmp_name"], $target_file1)){
				$myopt1img = $qpid."_".$queno."_1";
			}
		}else{
			$opt1img = "false";
		}

		if(isset($_FILES["opt2file"]) && !empty($_FILES["opt2file"])) {
			$opt2img = "true";
			$target_file1 = "../uploads/questions/options/" .md5($qpid."_".$queno."_2") .".jpg";
			if(move_uploaded_file($_FILES["opt2file"]["tmp_name"], $target_file1)){
				$myopt2img = $qpid."_".$queno."_2";
			}
		}else{
			$opt2img = "false";
		}

		if(isset($_FILES["opt3file"]) && !empty($_FILES["opt3file"])) {
			$opt3img = "true";
			$target_file1 = "../uploads/questions/options/" .md5($qpid."_".$queno."_3") .".jpg";
			if(move_uploaded_file($_FILES["opt3file"]["tmp_name"], $target_file1)){
				$myopt3img = $qpid."_".$queno."_3";
			}
		}
		else{
			$opt3img = "false";
		}

		if(isset($_FILES["opt4file"]) && !empty($_FILES["opt4file"])) {
			$opt4img = "true";
			$target_file1 = "../uploads/questions/options/" .md5($qpid."_".$queno."_4") .".jpg";
			if(move_uploaded_file($_FILES["opt4file"]["tmp_name"], $target_file1)){
				$myopt4img = $qpid."_".$queno."_4";
			}
		}else{
			$opt4img = "false";
		}

		if(isset($_FILES["mysolutionfile"]) && !empty($_FILES["mysolutionfile"])) {
			$mysolution = "true";
			$target_file1 = "../uploads/answers/" .md5($qpid."_".$imgid) .".jpg";
			if(move_uploaded_file($_FILES["mysolutionfile"]["tmp_name"], $target_file1)){
				$mysolutionfile = $qpid."_".$imgid;
			}
		}else{
			$mysolution = "false";
		}

	$sql = "UPDATE questionentry set question='$question',option1='$option1',option2='$option2',option3='$option3',option4='$option4',correctoption='$correctoption',imgid='$myqueimg',positivemarks='$positivemarks',negativemarks='$negativemarks',part='$part',solution='$solution'";
	if($opt1img == "true"){
		$sql = $sql . ",opt1img='".$myopt1img."'";
	}
	if($opt2img == "true"){
		$sql = $sql . ",opt2img='".$myopt2img."'";
	}
	if($opt3img == "true"){
		$sql = $sql . ",opt3img='".$myopt3img."'";
	}
	if($opt4img == "true"){
		$sql = $sql . ",opt4img='".$myopt4img."'";
	}
	if($mysolution == "true"){
		$sql = $sql . ",solutionimg='".$mysolutionfile."'";
	}
	$sql = $sql . ",level='".$level."' where qid='".$questionid."'";

	$conn->query($sql);

	header("Location: questionentryedit.php?id=".$questionid);
 ?>