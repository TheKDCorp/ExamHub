<?php 

include_once('../includes/dbcon.php');

function pingAddress($ip) {
    exec("ping -n 3 $ip", $output, $status);
    if (strpos($output[0], 'Destination host unreachable.') !== false) {
    	$mystatus = "dead";
	    echo $mystatus;
	}elseif (strpos($output[1], 'Destination host unreachable.') !== false) {
    	$mystatus = "dead";
	    echo $mystatus;
	}elseif (strpos($output[2], 'Destination host unreachable.') !== false) {
    	$mystatus = "dead";
	    echo $mystatus;
	}elseif (strpos($output[3], 'Destination host unreachable.') !== false) {
    	$mystatus = "dead";
	    echo $mystatus;
	}elseif (strpos($output[4], 'Destination host unreachable.') !== false) {
    	$mystatus = "dead";
	    echo $mystatus;
	}elseif (strpos($output[5], 'Destination host unreachable.') !== false) {
    	$mystatus = "dead";
	    echo $mystatus;
	}elseif (strpos($output[6], 'Destination host unreachable.') !== false) {
    	$mystatus = "dead";
	    echo $mystatus;
	}elseif (strpos($output[7], 'Destination host unreachable.') !== false) {
    	$mystatus = "dead";
	    echo $mystatus;
	}else{
	    if ($status == "0") {
	        $mystatus = "alive";
	    } else {
	        $mystatus = "dead";
	    }
	    echo $mystatus;
	}
}


if(!empty($_POST['checkactiveness'])){
	pingAddress("www.google.com");
}

if(!empty($_POST['updateanswer'])){
    $qid = $_POST['qid'];
    $cid = $_POST['cid'];
    $myanswer = $_POST['myanswer'];
    $examname = $_POST['examname'];
    $type = $_POST['examtype'];
    $qindex = $_POST['myqindex'];
    $clickstatus = $_POST['clickstatus'];

    $sql = "UPDATE answers_new SET choosedoption=$myanswer,clickstatus=$clickstatus WHERE cid=$cid and qid=$qid and qindex=$qindex and examtype=$type and examname=$examname";
    $conn->query($sql);        

}

if(!empty($_POST['updatepage'])){
    $page = $_POST['page'];
    $examname = $_POST['examname'];
    $sid = $_POST['sid'];

    $sql = "UPDATE students SET loggedin='true',page=$page,examname=$examname WHERE sid=$sid";
    $conn->query($sql);        
}

if(!empty($_POST['updatepagenew'])){
    $page = $_POST['page'];
    $examname = $_POST['examname'];
    $sid = $_POST['sid'];

    $sql = "UPDATE students SET loggedin='true',page=$page,examname=$examname WHERE sid=$sid";
    $conn->query($sql);        
}

if(!empty($_POST['updateanswer1'])){
    $qid = $_POST['qid'];
    $cid = $_POST['cid'];
    $myanswer = $_POST['myanswer'];
    $examname = $_POST['examname'];
    $type = $_POST['examtype'];
    $qindex = $_POST['myqindex'];
    $clickstatus = $_POST['clickstatus'];

    $sql = "select * from answers_new where cid=$cid and qid=$qid and qindex=$qindex and examtype=$type and examname=$examname";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row['clickstatus']==""){
            $sql = "UPDATE answers_new SET choosedoption=$myanswer,clickstatus=$clickstatus WHERE cid=$cid and qid=$qid and qindex=$qindex and examtype=$type and examname=$examname";
            $conn->query($sql);        
        }else{

        }
    }else{
        $sql = "UPDATE answers_new SET choosedoption=$myanswer,clickstatus=$clickstatus WHERE cid=$cid and qid=$qid and qindex=$qindex and examtype=$type and examname=$examname";
        $conn->query($sql);  
    }

    

}

if(!empty($_POST['updatetime'])){
    $studentid = $_POST['studentid'];
    $examid = $_POST['examid'];
    $examname = $_POST['examname'];
    $examtype = $_POST['examtype'];
    $qindex = $_POST['qindex'];
    $continuetime = $_POST['continuetime'];

    $sql = "UPDATE testcontinue SET continuetime=$continuetime WHERE studentid=$studentid and qindex=$qindex and examtype=$examtype and examname=$examname and examid=$examid";
    $conn->query($sql);        

}


if(!empty($_POST['generateqindex'])){
    $examname = $_POST['examname'];

    $sql      = "select * from answers_new where examname=$examname order by aid desc limit 1";
    $rts      = $conn->query($sql);
    if ($rts->num_rows > 0) {
        $row    = $rts->fetch_assoc();
        $qindex = $row['qindex'] + 1;
    } else {
        $qindex = 1;
    }
    echo $qindex;
}

if(!empty($_POST['submitmyanswer'])){
	$qid = $_POST['qid'];
	$part = $_POST['partno'];
	$level = $_POST['level'];
	$cid = $_POST['cid'];
	$myanswer = $_POST['myanswer'];
	$examname = $_POST['examname'];
	$type = $_POST['examtype'];
    $uname = $_POST['studentname'];
	$qindex = $_POST['myqindex'];

	$date = date("Y/m/d");

    $sql1    = "select * from questionentry where qid=$qid";
    $result1 = $conn->query($sql1);
    if($result1->num_rows > 0){
        $row1 = $result1->fetch_assoc();
        $originalcorrectoption = $row1['correctoption'];

        if($myanswer==$row1['correctoption']){
            $status="correct";
        }else{
            $status="incorrect";
        }
    }

    if($level=="beginner"){
        $mylevel = "1";
    }elseif($level=="intermediate"){
        $mylevel = "2";
    }elseif($level=="advanced"){
        $mylevel = "3";
    }

    $sql  = "INSERT INTO answers_new(aid,correctoption,cid,qid,examname,qindex,part,studentname,level,status,examtype,choosedoption) VALUES (DEFAULT,'$originalcorrectoption',$cid,$qid,$examname,$qindex,$part,$uname,$level,'incorrect',$type,$myanswer)";
    $conn->query($sql);        

}


if(!empty($_POST['examsubmit'])){
	$cid = $_POST['cid'];
    $examname = $_POST['examname'];
    $type = $_POST['examtype'];
    $qindex = $_POST['myqindex'];
    $totaltimeinmins = $_POST['mytotaltime'];
    $uname = $_POST['studentname'];

    $blank = "0";
$incorrect = "0";
$attempted = "0";
$correct = "0";

$level1corr = "0";
$level2corr = "0";
$level3corr = "0";
$level1incorr = "0";
$level2incorr = "0";
$level3incorr = "0";


$correct = "0";
$totalattempted = "0";
$correctmarks = "0";
$totalmarks = "0";

$part1marks = "0";
$part1attempted = "0";
$part1correct = "0";
$part1correctmarks = "0";
$part1level1correct = "0";
$part1level2correct = "0";
$part1level3correct = "0";

$part2marks = "0";
$part2attempted = "0";
$part2correct = "0";
$part2correctmarks = "0";
$part2level1correct = "0";
$part2level2correct = "0";
$part2level3correct = "0";

$part3marks = "0";
$part3attempted = "0";
$part3correct = "0";
$part3correctmarks = "0";
$part3level1correct = "0";
$part3level2correct = "0";
$part3level3correct = "0";

$part4marks = "0";
$part4attempted = "0";
$part4correct = "0";
$part4correctmarks = "0";
$part4level1correct = "0";
$part4level2correct = "0";
$part4level3correct = "0";

$part5marks = "0";
$part5attempted = "0";
$part5correct = "0";
$part5correctmarks = "0";
$part5level1correct = "0";
$part5level2correct = "0";
$part5level3correct = "0";

$part6marks = "0";
$part6attempted = "0";
$part6correct = "0";
$part6correctmarks = "0";
$part6level1correct = "0";
$part6level2correct = "0";
$part6level3correct = "0";

$part7marks = "0";
$part7attempted = "0";
$part7correct = "0";
$part7correctmarks = "0";
$part7level1correct = "0";
$part7level2correct = "0";
$part7level3correct = "0";

$part8marks = "0";
$part8attempted = "0";
$part8correct = "0";
$part8correctmarks = "0";
$part8level1correct = "0";
$part8level2correct = "0";
$part8level3correct = "0";

$part9marks = "0";
$part9attempted = "0";
$part9correct = "0";
$part9correctmarks = "0";
$part9level1correct = "0";
$part9level2correct = "0";
$part9level3correct = "0";

$part10marks = "0";
$part10attempted = "0";
$part10correct = "0";
$part10correctmarks = "0";
$part10level1correct = "0";
$part10level2correct = "0";
$part10level3correct = "0";

$level1correct = "0";
$level2correct = "0";
$level3correct = "0";

$blank = "0";

$part1blank = "0";
$part2blank = "0";
$part3blank = "0";
$part4blank = "0";
$part5blank = "0";
$part6blank = "0";
$part7blank = "0";
$part8blank = "0";
$part9blank = "0";
$part10blank = "0";

$level1blank="0";
$level2blank="0";
$level3blank="0";

$incorrect = "0";
$incorrectmarks = "0";

$part1incorrect="0";
$part1incorrectmarks="0";
$part1level1incorrect="0";
$part1level2incorrect="0";
$part1level3incorrect="0";

$part2incorrect="0";
$part2incorrectmarks="0";
$part2level1incorrect="0";
$part2level2incorrect="0";
$part2level3incorrect="0";

$part3incorrect="0";
$part3incorrectmarks="0";
$part3level1incorrect="0";
$part3level2incorrect="0";
$part3level3incorrect="0";

$part4incorrect="0";
$part4incorrectmarks="0";
$part4level1incorrect="0";
$part4level2incorrect="0";
$part4level3incorrect="0";

$part5incorrect="0";
$part5incorrectmarks="0";
$part5level1incorrect="0";
$part5level2incorrect="0";
$part5level3incorrect="0";

$part6incorrect="0";
$part6incorrectmarks="0";
$part6level1incorrect="0";
$part6level2incorrect="0";
$part6level3incorrect="0";

$part7incorrect="0";
$part7incorrectmarks="0";
$part7level1incorrect="0";
$part7level2incorrect="0";
$part7level3incorrect="0";

$part8incorrect="0";
$part8incorrectmarks="0";
$part8level1incorrect="0";
$part8level2incorrect="0";
$part8level3incorrect="0";

$part9incorrect="0";
$part9incorrectmarks="0";
$part9level1incorrect="0";
$part9level2incorrect="0";
$part9level3incorrect="0";

$part10incorrect="0";
$part10incorrectmarks="0";
$part10level1incorrect="0";
$part10level2incorrect="0";
$part10level3incorrect="0";

$level1incorrect = "0";
$level2incorrect = "0";
$level3incorrect = "0";

$totalnoofquestions = "0";
$totalnoofmarks = "0";
$level1correctmarks = "0";
$level2correctmarks = "0";
$level3correctmarks = "0";
$level1incorrectmarks = "0";
$level2incorrectmarks = "0";
$level3incorrectmarks = "0";

$part1 = "0";
$part2 = "0";
$part3 = "0";


$part1totalmarks  = "";
$part2totalmarks  = "";
$part3totalmarks  = "";
$part4totalmarks  = "";
$part5totalmarks  = "";
$part6totalmarks  = "";
$part7totalmarks  = "";
$part8totalmarks  = "";
$part9totalmarks  = "";
$part10totalmarks = "";

$level1totalmarks = "";
$level2totalmarks = "";
$level3totalmarks = "";
$mytotaltime = "";
$timetaken = "";

    $sql    = "select * from answers_new where cid=$cid and qindex=$qindex and examname=$examname";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row=$result->fetch_assoc()){
            
            $totalnoofquestions = $totalnoofquestions + 1;
            $jjqidd = $row['qid'];
            $sql11 = "select * from questionentry where qid='$jjqidd'";
            $result11 = $conn->query($sql11);
            if($result11->num_rows > 0){
                $row11 = $result11->fetch_assoc();
                $totalnoofmarks = $totalnoofmarks + $row11['positivemarks'];
            }else{
                echo "No Question Found!!!";
            }


           if($row['status']=="correct"){

                $jjqid = $row['qid'];
                $sql1 = "select * from questionentry where qid='$jjqid'";
                $result1 = $conn->query($sql1);
                if($result1->num_rows > 0){
                    $row1 = $result1->fetch_assoc();
                }else{
                    echo "No Question Found!!!";
                }

                $correct = $correct + 1;
                $totalattempted = $totalattempted + 1;
                $correctmarks = $correctmarks + $row1['positivemarks'];
                $totalmarks = $totalmarks + $row1['positivemarks'];


                if ($row['part'] == "1") {
                    $part1totalmarks = $part1totalmarks + $row1['positivemarks'];
                    $part1marks        = $part1marks + $row1['positivemarks'];
                    $part1attempted    = $part1attempted + 1;
                    $part1correct      = $part1correct + 1;
                    $part1correctmarks = $part1correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part1level1correct = $part1level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part1level2correct = $part1level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part1level3correct = $part1level3correct + 1;
                    }
                } elseif ($row['part'] == "2") {
                    $part2totalmarks = $part2totalmarks + $row1['positivemarks'];
                    $part2marks        = $part2marks + $row1['positivemarks'];
                    $part2attempted    = $part2attempted + 1;
                    $part2correct      = $part2correct + 1;
                    $part2correctmarks = $part2correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part2level1correct = $part2level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part2level2correct = $part2level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part2level3correct = $part2level3correct + 1;
                    }
                } elseif ($row['part'] == "3") {
                    $part3totalmarks = $part3totalmarks + $row1['positivemarks'];
                    $part3marks        = $part3marks + $row1['positivemarks'];
                    $part3attempted    = $part3attempted + 1;
                    $part3correct      = $part3correct + 1;
                    $part3correctmarks = $part3correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part3level1correct = $part3level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part3level2correct = $part3level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part3level3correct = $part3level3correct + 1;
                    }
                } elseif ($row['part'] == "4") {
                    $part4totalmarks = $part4totalmarks + $row1['positivemarks'];
                    $part4marks        = $part4marks + $row1['positivemarks'];
                    $part4attempted    = $part4attempted + 1;
                    $part4correct      = $part4correct + 1;
                    $part4correctmarks = $part4correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part4level1correct = $part4level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part4level2correct = $part4level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part4level3correct = $part4level3correct + 1;
                    }
                } elseif ($row['part'] == "5") {
                    $part5totalmarks = $part5totalmarks + $row1['positivemarks'];
                    $part5marks        = $part5marks + $row1['positivemarks'];
                    $part5attempted    = $part5attempted + 1;
                    $part5correct      = $part5correct + 1;
                    $part5correctmarks = $part5correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part5level1correct = $part5level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part5level2correct = $part5level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part5level3correct = $part5level3correct + 1;
                    }
                } elseif ($row['part'] == "6") {
                    $part6totalmarks = $part6totalmarks + $row1['positivemarks'];
                    $part6marks        = $part6marks + $row1['positivemarks'];
                    $part6attempted    = $part6attempted + 1;
                    $part6correct      = $part6correct + 1;
                    $part6correctmarks = $part6correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part6level1correct = $part6level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part6level2correct = $part6level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part6level3correct = $part6level3correct + 1;
                    }
                } elseif ($row['part'] == "7") {
                    $part7totalmarks = $part7totalmarks + $row1['positivemarks'];
                    $part7marks        = $part7marks + $row1['positivemarks'];
                    $part7attempted    = $part7attempted + 1;
                    $part7correct      = $part7correct + 1;
                    $part7correctmarks = $part7correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part7level1correct = $part7level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part7level2correct = $part7level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part7level3correct = $part7level3correct + 1;
                    }
                } elseif ($row['part'] == "8") {
                    $part8totalmarks = $part8totalmarks + $row1['positivemarks'];
                    $part8marks        = $part8marks + $row1['positivemarks'];
                    $part8attempted    = $part8attempted + 1;
                    $part8correct      = $part8correct + 1;
                    $part8correctmarks = $part8correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part8level1correct = $part8level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part8level2correct = $part8level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part8level3correct = $part8level3correct + 1;
                    }
                } elseif ($row['part'] == "9") {
                    $part9totalmarks = $part9totalmarks + $row1['positivemarks'];
                    $part9marks        = $part9marks + $row1['positivemarks'];
                    $part9attempted    = $part9attempted + 1;
                    $part9correct      = $part9correct + 1;
                    $part9correctmarks = $part9correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part9level1correct = $part9level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part9level2correct = $part9level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part9level3correct = $part9level3correct + 1;
                    }
                } elseif ($row['part'] == "10") {
                    $part10totalmarks = $part10totalmarks + $row1['positivemarks'];
                    $part10marks        = $part10marks + $row1['positivemarks'];
                    $part10attempted    = $part10attempted + 1;
                    $part10correct      = $part10correct + 1;
                    $part10correctmarks = $part10correctmarks + $row1['positivemarks'];
                    if($row['level']=="1"){
                        $part10level1correct = $part10level1correct + 1;
                    }elseif($row['level']=="2"){
                        $part10level2correct = $part10level2correct + 1;
                    }elseif($row['level']=="3"){
                        $part10level3correct = $part10level3correct + 1;
                    }
                }

                if($row['level']=="1"){
                    $level1totalmarks = $level1totalmarks + $row1['positivemarks'];
                    $level1correct = $level1correct + 1;
                    $level1correctmarks = $level1correctmarks + $row1['positivemarks'];
                }elseif($row['level']=="2"){
                    $level2totalmarks = $level2totalmarks + $row1['positivemarks'];
                    $level2correct = $level2correct + 1;
                    $level2correctmarks = $level2correctmarks + $row1['positivemarks'];
                }elseif($row['level']=="3"){
                    $level3totalmarks = $level3totalmarks + $row1['positivemarks'];
                    $level3correct = $level3correct + 1;
                    $level3correctmarks = $level3correctmarks + $row1['positivemarks'];
                }


           }elseif($row['status']=="incorrect"){
                if($row['choosedoption']==""){

                    $jjqid = $row['qid'];
                    $sql1 = "select * from questionentry where qid='$jjqid'";
                    $result1 = $conn->query($sql1);
                    if($result1->num_rows > 0){
                        $row1 = $result1->fetch_assoc();
                    }else{
                        echo "No Question Found!!!";
                    }


                    $blank = $blank + 1;
                    if ($row['part'] == "1") {
                        $part1totalmarks = $part1totalmarks + $row1['positivemarks'];
                        $part1blank    = $part1blank + 1;
                    } elseif ($row['part'] == "2") {
                        $part2totalmarks = $part2totalmarks + $row1['positivemarks'];
                        $part2blank    = $part2blank + 1;
                    } elseif ($row['part'] == "3") {
                        $part3totalmarks = $part3totalmarks + $row1['positivemarks'];
                        $part3blank    = $part3blank + 1;
                    } elseif ($row['part'] == "4") {
                        $part4totalmarks = $part4totalmarks + $row1['positivemarks'];
                       $part4blank    = $part4blank + 1;
                    } elseif ($row['part'] == "5") {
                        $part5totalmarks = $part5totalmarks + $row1['positivemarks'];
                       $part5blank    = $part5blank + 1;
                    } elseif ($row['part'] == "6") {
                        $part6totalmarks = $part6totalmarks + $row1['positivemarks'];
                        $part6blank    = $part6blank + 1;
                    } elseif ($row['part'] == "7") {
                        $part7totalmarks = $part7totalmarks + $row1['positivemarks'];
                        $part7blank    = $part7blank + 1;
                    } elseif ($row['part'] == "8") {
                        $part8totalmarks = $part8totalmarks + $row1['positivemarks'];
                        $part8blank    = $part8blank + 1;
                    } elseif ($row['part'] == "9") {
                        $part9totalmarks = $part9totalmarks + $row1['positivemarks'];
                        $part9blank    = $part9blank + 1;
                    } elseif ($row['part'] == "10") {
                        $part10totalmarks = $part10totalmarks + $row1['positivemarks'];
                        $part10blank    = $part10blank + 1;
                    }

                   

                    if($row['level']=="1"){
                        $level1totalmarks = $level1totalmarks + $row1['positivemarks'];
                        $level1blank = $level1blank + 1;
                    }elseif($row['level']=="2"){
                        $level2totalmarks = $level2totalmarks + $row1['positivemarks'];
                        $level2blank = $level2blank + 1;
                    }elseif($row['level']=="3"){
                        $level3totalmarks = $level3totalmarks + $row1['positivemarks'];
                        $level3blank = $level3blank + 1;
                    }
                }else{
                    $jjqid = $row['qid'];
                    $sql1 = "select * from questionentry where qid = '$jjqid'";
                    $result1 = $conn->query($sql1);
                    if($result1->num_rows > 0){
                        $row1 = $result1->fetch_assoc();
                    }else{
                        echo "No Question Found!!!";
                    }

                    $incorrect = $incorrect + 1;
                    $totalattempted = $totalattempted + 1;
                    $incorrectmarks = $incorrectmarks + $row1['negativemarks'];
                    $totalmarks = $totalmarks - $row1['negativemarks'];

                    if ($row['part'] == "1") {
                        $part1totalmarks = $part1totalmarks + $row1['positivemarks'];
                        $part1marks        = $part1marks - $row1['negativemarks'];
                        $part1attempted    = $part1attempted + 1;
                        $part1incorrect      = $part1incorrect + 1;
                        $part1incorrectmarks = $part1incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part1level1incorrect = $part1level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part1level2incorrect = $part1level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part1level3incorrect = $part1level3incorrect + 1;
                        }
                    } elseif ($row['part'] == "2") {

                        $part2totalmarks = $part2totalmarks + $row1['positivemarks'];
                        $part2marks        = $part2marks - $row1['negativemarks'];
                        $part2attempted    = $part2attempted + 1;
                        $part2incorrect      = $part2incorrect + 1;
                        $part2incorrectmarks = $part2incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part2level1incorrect = $part2level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part2level2incorrect = $part2level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part2level3incorrect = $part2level3incorrect + 1;
                        }
                    } elseif ($row['part'] == "3") {
                        $part3totalmarks = $part3totalmarks + $row1['positivemarks'];
                        $part3marks        = $part3marks - $row1['negativemarks'];
                        $part3attempted    = $part3attempted + 1;
                        $part3incorrect      = $part3incorrect + 1;
                        $part3incorrectmarks = $part3incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part3level1incorrect = $part3level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part3level2incorrect = $part3level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part3level3incorrect = $part3level3incorrect + 1;
                        }
                    } elseif ($row['part'] == "4") {
                        $part4totalmarks = $part4totalmarks + $row1['positivemarks'];
                        $part4marks        = $part4marks - $row1['negativemarks'];
                        $part4attempted    = $part4attempted + 1;
                        $part4incorrect      = $part4incorrect + 1;
                        $part4incorrectmarks = $part4incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part4level1incorrect = $part4level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part4level2incorrect = $part4level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part4level3incorrect = $part4level3incorrect + 1;
                        }
                    } elseif ($row['part'] == "5") {
                        $part5totalmarks = $part5totalmarks + $row1['positivemarks'];
                        $part5marks        = $part5marks - $row1['negativemarks'];
                        $part5attempted    = $part5attempted + 1;
                        $part5incorrect      = $part5incorrect + 1;
                        $part5incorrectmarks = $part5incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part5level1incorrect = $part5level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part5level2incorrect = $part5level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part5level3incorrect = $part5level3incorrect + 1;
                        }
                    } elseif ($row['part'] == "6") {
                        $part6totalmarks = $part6totalmarks + $row1['positivemarks'];
                        $part6marks        = $part6marks - $row1['negativemarks'];
                        $part6attempted    = $part6attempted + 1;
                        $part6incorrect      = $part6incorrect + 1;
                        $part6incorrectmarks = $part6incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part6level1incorrect = $part6level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part6level2incorrect = $part6level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part6level3incorrect = $part6level3incorrect + 1;
                        }
                    } elseif ($row['part'] == "7") {
                        $part7totalmarks = $part7totalmarks + $row1['positivemarks'];
                        $part7marks        = $part7marks - $row1['negativemarks'];
                        $part7attempted    = $part7attempted + 1;
                        $part7incorrect      = $part7incorrect + 1;
                        $part7incorrectmarks = $part7incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part7level1incorrect = $part7level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part7level2incorrect = $part7level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part7level3incorrect = $part7level3incorrect + 1;
                        }
                    } elseif ($row['part'] == "8") {
                        $part8totalmarks = $part8totalmarks + $row1['positivemarks'];
                        $part8marks        = $part8marks - $row1['negativemarks'];
                        $part8attempted    = $part8attempted + 1;
                        $part8incorrect      = $part8incorrect + 1;
                        $part8incorrectmarks = $part8incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part8level1incorrect = $part8level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part8level2incorrect = $part8level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part8level3incorrect = $part8level3incorrect + 1;
                        }
                    } elseif ($row['part'] == "9") {
                        $part9totalmarks = $part9totalmarks + $row1['positivemarks'];
                        $part9marks        = $part9marks - $row1['negativemarks'];
                        $part9attempted    = $part9attempted + 1;
                        $part9incorrect      = $part9incorrect + 1;
                        $part9incorrectmarks = $part9incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part9level1incorrect = $part9level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part9level2incorrect = $part9level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part9level3incorrect = $part9level3incorrect + 1;
                        }
                    } elseif ($row['part'] == "10") {
                        $part10totalmarks = $part10totalmarks + $row1['positivemarks'];
                        $part10marks        = $part10marks - $row1['negativemarks'];
                        $part10attempted    = $part10attempted + 1;
                        $part10incorrect      = $part10incorrect + 1;
                        $part10incorrectmarks = $part10incorrectmarks + $row1['negativemarks'];

                        if($row['level']=="1"){
                            $part10level1incorrect = $part10level1incorrect + 1;
                        }elseif($row['level']=="2"){
                            $part10level2incorrect = $part10level2incorrect + 1;
                        }elseif($row['level']=="3"){
                            $part10level3incorrect = $part10level3incorrect + 1;
                        }
                    }

                    if($row['level']=="1"){
                        $level1totalmarks = $level1totalmarks + $row1['positivemarks'];
                        $level1incorrect = $level1incorrect + 1;
                        $level1incorrectmarks = $level1incorrectmarks + $row1['negativemarks'];
                    }elseif($row['level']=="2"){
                        $level2totalmarks = $level2totalmarks + $row1['positivemarks'];
                        $level2incorrect = $level2incorrect + 1;
                        $level2incorrectmarks = $level2incorrectmarks + $row1['negativemarks'];
                    }elseif($row['level']=="3"){
                        $level3totalmarks = $level3totalmarks + $row1['positivemarks'];
                        $level3incorrect = $level3incorrect + 1;
                        $level3incorrectmarks = $level3incorrectmarks + $row1['negativemarks'];
                    }
                }
           }
        }
    }

    $percentage = (($totalmarks / $totalnoofmarks) * 100);

    $level1marks = $level1correctmarks - $level1incorrectmarks;
    $level2marks = $level2correctmarks - $level2incorrectmarks;
    $level3marks = $level3correctmarks - $level3incorrectmarks;

    // $level1totalmarks = $level1correctmarks + $level1incorrectmarks;
    // $level2totalmarks = $level2correctmarks + $level2incorrectmarks;
    // $level3totalmarks = $level3correctmarks + $level3incorrectmarks;

    $level1questions = $level1correct + $level1incorrect + $level1blank;
    $level2questions = $level2correct + $level2incorrect + $level2blank;
    $level3questions = $level3correct + $level3incorrect + $level3blank;

    $part1level1marks = $part1level1correct - $part1level1incorrect;
    $part2level1marks = $part2level1correct - $part2level1incorrect;
    $part3level1marks = $part3level1correct - $part3level1incorrect;
    $part4level1marks = $part4level1correct - $part4level1incorrect;
    $part5level1marks = $part5level1correct - $part5level1incorrect;
    $part6level1marks = $part6level1correct - $part6level1incorrect;
    $part7level1marks = $part7level1correct - $part7level1incorrect;
    $part8level1marks = $part8level1correct - $part8level1incorrect;
    $part9level1marks = $part9level1correct - $part9level1incorrect;
    $part10level10marks = $part10level1correct - $part10level1incorrect;

    $part1level2marks = $part1level2correct - $part1level2incorrect;
    $part2level2marks = $part2level2correct - $part2level2incorrect;
    $part3level2marks = $part3level2correct - $part3level2incorrect;
    $part4level2marks = $part4level2correct - $part4level2incorrect;
    $part5level2marks = $part5level2correct - $part5level2incorrect;
    $part6level2marks = $part6level2correct - $part6level2incorrect;
    $part7level2marks = $part7level2correct - $part7level2incorrect;
    $part8level2marks = $part8level2correct - $part8level2incorrect;
    $part9level2marks = $part9level2correct - $part9level2incorrect;
    $part10level2marks = $part10level2correct - $part10level2incorrect;

    $part1level3marks = $part1level3correct - $part1level3incorrect;
    $part2level3marks = $part2level3correct - $part2level3incorrect;
    $part3level3marks = $part3level3correct - $part3level3incorrect;
    $part4level3marks = $part4level3correct - $part4level3incorrect;
    $part5level3marks = $part5level3correct - $part5level3incorrect;
    $part6level3marks = $part6level3correct - $part6level3incorrect;
    $part7level3marks = $part7level3correct - $part7level3incorrect;
    $part8level3marks = $part8level3correct - $part8level3incorrect;
    $part9level3marks = $part9level3correct - $part9level3incorrect;
    $part10level3marks = $part10level3correct - $part10level3incorrect;


if ($examname == "") {
    }else{
        $sql3    = "select * from questionpaper where name = $examname";
        $result3 = $conn->query($sql3);
        if ($result3->num_rows > 0) {
            $row3           = $result3->fetch_assoc();

            $part1name      = $row3['part1name'];
            $part2name      = $row3['part2name'];
            $part3name      = $row3['part3name'];
            $part4name      = $row3['part4name'];
            $part5name      = $row3['part5name'];
            $part6name      = $row3['part6name'];
            $part7name      = $row3['part7name'];
            $part8name      = $row3['part8name'];
            $part9name      = $row3['part9name'];
            $part10name     = $row3['part10name'];
            

            
        } else {

        }
    }


    if ($part1name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part1name . " : " . $part1 . " / " . $part1marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part1name','$part1totalmarks','$part1correctmarks',$cid,$qindex,$examname,'$part1correct','$part1incorrect','$part1incorrectmarks','$part1attempted','$part1marks','$part1level1marks','$part1level2marks','$part1level3marks',$type)";
        $conn->query($sql6);
    }
    if ($part2name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part2name . " : " . $part2 . " / " . $part2marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part2name','$part2totalmarks','$part2correctmarks',$cid,$qindex,$examname,'$part2correct','$part2incorrect','$part2incorrectmarks','$part2attempted','$part2marks','$part2level1marks','$part2level2marks','$part2level3marks',$type)";
        $conn->query($sql6);
    }
    if ($part3name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part3name . " : " . $part3 . " / " . $part3marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part3name','$part3totalmarks','$part3correctmarks',$cid,$qindex,$examname,'$part3correct','$part3incorrect','$part3incorrectmarks','$part3attempted','$part3marks','$part3level1marks','$part3level2marks','$part3level3marks',$type)";
        $conn->query($sql6);
    }
    if ($part4name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part4name . " : " . $part4 . " / " . $part4marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part4name','$part4totalmarks','$part4correctmarks',$cid,$qindex,$examname,'$part4correct','$part4incorrect','$part4incorrectmarks','$part4attempted','$part4marks','$part4level1marks','$part4level2marks','$part4level3marks',$type)";
        $conn->query($sql6);
    }
    if ($part5name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part5name . " : " . $part5 . " / " . $part5marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part5name','$part5totalmarks','$part5correctmarks',$cid,$qindex,$examname,'$part5correct','$part5incorrect','$part5incorrectmarks','$part5attempted','$part5marks','$part5level1marks','$part5level2marks','$part5level3marks',$type)";
        $conn->query($sql6);
    }
    if ($part6name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part6name . " : " . $part6 . " / " . $part6marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part6name','$part6totalmarks','$part6correctmarks',$cid,$qindex,$examname,'$part6correct','$part6incorrect','$part6incorrectmarks','$part6attempted','$part6marks','$part6level1marks','$part6level2marks','$part6level3marks',$type)";
        $conn->query($sql6);
    }
    if ($part7name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part7name . " : " . $part7 . " / " . $part7marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part7name','$part7totalmarks','$part7correctmarks',$cid,$qindex,$examname,'$part7correct','$part7incorrect','$part7incorrectmarks','$part7attempted','$part7marks','$part7level1marks','$part7level2marks','$part7level3marks',$type)";
        $conn->query($sql6);
    }
    if ($part8name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part8name . " : " . $part8 . " / " . $part8marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part8name','$part8totalmarks','$part8correctmarks',$cid,$qindex,$examname,'$part8correct','$part8incorrect','$part8incorrectmarks','$part8attempted','$part8marks','$part8level1marks','$part8level2marks','$part8level3marks',$type)";
        $conn->query($sql6);
    }
    if ($part9name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part9name . " : " . $part9 . " / " . $part9marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part9name','$part9totalmarks','$part9correctmarks',$cid,$qindex,$examname,'$part9correct','$part9incorrect','$part9incorrectmarks','$part9attempted','$part9marks','$part9level1marks','$part9level2marks','$part9level3marks',$type)";
        $conn->query($sql6);
    }
    if ($part10name != "") {
        // echo "<div style='display:block;'><center> <h3>" . $part10name . " : " . $part10 . " / " . $part10marks . "<br></center></div>";
        $sql6 = "INSERT INTO partsresult_new(pid,partname,totalmarks,markspositive,cid,qindex,examname,questionscorrect,questionsincorrect,marksnegative,attempted,mymarks,level1marks,level2marks,level3marks,examtype)VALUES(DEFAULT,'$part10name','$part10totalmarks','$part10correctmarks',$cid,$qindex,$examname,'$part10correct','$part10incorrect','$part10incorrectmarks','$part10attempted','$part10marks','$part10level1marks','$part10level2marks','$part10level3marks',$type)";
        $conn->query($sql6);
    }




    $percentage2 = number_format($percentage, 0) . "%";
    $mypercentage = number_format($percentage, 0);

    $date = date("Y/m/d");

    $sql5 = "INSERT into results_new(rid,cid,qindex,totalmarks,correctquestions,incorrectquestions,blank,attempted,totalquestions,mymarks,examname,date,totaltime,timeleft,mypercentile,mytime,correctmarks,incorrectmarks,studentname,level1marks,level2marks,level3marks,apppercent,level1correctmarks,level1incorrectmarks,level2correctmarks,level2incorrectmarks,level3correctmarks,level3incorrectmarks,level1questions,level1correctquestions,level1incorrectquestions,level2questions,level2correctquestions,level2incorrectquestions,level3questions,level3correctquestions,level3incorrectquestions,level1totalmarks,level2totalmarks,level3totalmarks,examtype) VALUES (DEFAULT,$cid,$qindex,'$totalnoofmarks','$correct','$incorrect','$blank','$totalattempted','$totalnoofquestions','$totalmarks',$examname,'$date',$totaltimeinmins,'$mytotaltime','$percentage2','$timetaken','$correctmarks','$incorrectmarks',$uname,'$level1marks','$level2marks','$level3marks','$mypercentage','$level1correctmarks','$level1incorrectmarks','$level2correctmarks','$level2incorrectmarks','$level3correctmarks','$level3incorrectmarks','$level1questions','$level1correct','$level1incorrect','$level2questions','$level2correct','$level2incorrect','$level3questions','$level3correct','$level3incorrect','$level1totalmarks','$level2totalmarks','$level3totalmarks',$type)";
    echo $sql5;
    $conn->query($sql5);

}

 ?>