<?php 
include_once('../includes/dbcon.php');

	$question = addslashes(htmlspecialchars($_POST['qquestion'],ENT_QUOTES));
	$option1 = addslashes(htmlspecialchars($_POST['qoption1'],ENT_QUOTES));
	$option2 = addslashes(htmlspecialchars($_POST['qoption2'],ENT_QUOTES));
	$option3 = addslashes(htmlspecialchars($_POST['qoption3'],ENT_QUOTES));
	$option4 = addslashes(htmlspecialchars($_POST['qoption4'],ENT_QUOTES));
	$correctoption = addslashes(htmlspecialchars($_POST['qcorrectanswer'],ENT_QUOTES));
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

	$sql = "select * from questionentry where qpname='$qpname'";
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
			$target_file = "../uploads/questions/" .md5($qpid."_".$imgid) .".jpg";
			if(move_uploaded_file($_FILES["quefile"]["tmp_name"], $target_file)){
				$myqueimg = $qpid."_".$imgid;
				echo $myqueimg;
			}
			
		}else{
			echo 'No image';
		}
		
		if(isset($_FILES["opt1file"]) && !empty($_FILES["opt1file"])) {
			$target_file1 = "../uploads/questions/options/" .md5($qpid."_".$imgid."_1") .".jpg";
			if(move_uploaded_file($_FILES["opt1file"]["tmp_name"], $target_file1)){
				$myopt1img = $qpid."_".$imgid."_1";
			}
		}

		if(isset($_FILES["opt2file"]) && !empty($_FILES["opt2file"])) {
			$target_file1 = "../uploads/questions/options/" .md5($qpid."_".$imgid."_2") .".jpg";
			if(move_uploaded_file($_FILES["opt2file"]["tmp_name"], $target_file1)){
				$myopt2img = $qpid."_".$imgid."_2";
			}
		}

		if(isset($_FILES["opt3file"]) && !empty($_FILES["opt3file"])) {
			$target_file1 = "../uploads/questions/options/" .md5($qpid."_".$imgid."_3") .".jpg";
			if(move_uploaded_file($_FILES["opt3file"]["tmp_name"], $target_file1)){
				$myopt3img = $qpid."_".$imgid."_3";
			}
		}

		if(isset($_FILES["opt4file"]) && !empty($_FILES["opt4file"])) {
			$target_file1 = "../uploads/questions/options/" .md5($qpid."_".$imgid."_4") .".jpg";
			if(move_uploaded_file($_FILES["opt4file"]["tmp_name"], $target_file1)){
				$myopt4img = $qpid."_".$imgid."_4";
			}
		}

		if(isset($_FILES["mysolutionfile"]) && !empty($_FILES["mysolutionfile"])) {
			$target_file1 = "../uploads/answers/" .md5($qpid."_".$imgid) .".jpg";
			if(move_uploaded_file($_FILES["mysolutionfile"]["tmp_name"], $target_file1)){
				$mysolutionfile = $qpid."_".$imgid;
			}
		}
	
	$sql = "INSERT INTO questionentry(qid,question,option1,option2,option3,option4,correctoption,imgid,qpname,qpid,positivemarks,negativemarks,part,opt1img,opt2img,opt3img,opt4img,level,solution,solutionimg) VALUES (DEFAULT,'$question','$option1','$option2','$option3','$option4','$correctoption','$myqueimg','$qpname','$qpid','$positivemarks','$negativemarks','$part','$myopt1img','$myopt2img','$myopt3img','$myopt4img','$level','$solution','$mysolutionfile')";
	$conn->query($sql);

	header("Location: questionentryaddnew2.php?qpname=".$qpname."&qpid=".$qpid."&partno=".$part."&posmarks=".$positivemarks."&negmarks=".$negativemarks);
 ?>