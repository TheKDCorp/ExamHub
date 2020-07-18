
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');
?>
<div class="all" style="display:none">

<?php 
  $qpid=addslashes(htmlspecialchars($_GET['qpid'],ENT_QUOTES));

  $sql = "select * from questionpaper where qpid='$qpid'";
  $result=$conn->query($sql);
  if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $qpname=$row['name'];
    $qptype=$row['examtype'];
  }


  $sqll1 = "select * from results where examname='$qpname' and examtype='$qptype'";
  $resultl1=$conn->query($sqll1);
  if($resultl1->num_rows>0){
    while($rowl1=$resultl1->fetch_assoc()){
      $examname = $rowl1['examname'];
      $qindex = $rowl1['qindex'];
      $cid = $rowl1['cid'];
      $examtype = $rowl1['examtype'];
      $resultid = $rowl1['rid'];

      $sql1 = "select * from answers where cid='$cid' and qindex='$qindex' and examname='$examname' and examtype='$examtype'";
      $result1 = $conn->query($sql1);
      if($result1->num_rows > 0){
        while($row1=$result1->fetch_assoc()){
          $ai = $row1["choosedoption"];
          $qid = $row1['qid'];
          $aid = $row1['aid'];
          $sql2    = "select * from questionentry where qid='$qid'";
          $result2 = $conn->query($sql2);
          if($result2->num_rows > 0){
              $row2 = $result2->fetch_assoc();
              if($ai==""){
                $status="blank";
              }else{
                if($ai==$row2['correctoption']){
                      $status="correct";
                  }else{
                      $status="incorrect";
                  }
              }
          }
          
          $sql3="update answers set status='$status' where aid='$aid'";    
          $conn->query($sql3);
        }
      }

      
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

     $sql    = "select * from answers where cid='$cid' and qindex='$qindex' and examname='$examname'";
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
                $error = true;
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


           }elseif($row['status']=="blank"){
                $jjqid = $row['qid'];
                $sql1 = "select * from questionentry where qid='$jjqid'";
                $result1 = $conn->query($sql1);
                if($result1->num_rows > 0){
                    $row1 = $result1->fetch_assoc();
                }else{
                    echo "No Question Found!!!";
                    $myerror = true;
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
           }elseif($row['status']=="incorrect"){
                if($row['choosedoption']==""){
                    $jjqid = $row['qid'];
                    $sql1 = "select * from questionentry where qid='$jjqid'";
                    $result1 = $conn->query($sql1);
                    if($result1->num_rows > 0){
                        $row1 = $result1->fetch_assoc();
                    }else{
                        echo "No Question Found!!!";
                        $myerror = true;
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
        $sql3    = "select * from questionpaper where name = '$examname'";
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

      $sqlll1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and examtype='$examtype'";
      $resultll1 = $conn->query($sqlll1);
      if($resultll1->num_rows > 0){
        while($rowll1=$resultll1->fetch_assoc()){
          $mypartname = $rowll1["partname"];
          $mypartid = $rowll1['pid'];
          if ($part1name == $mypartname) {
              $sql6 = "UPDATE partsresult set markspositive='$part1correctmarks',questionscorrect='$part1correct',questionsincorrect='$part1incorrect',marksnegative='$part1incorrectmarks',attempted='$part1attempted',mymarks='$part1marks',level1marks='$part1level1marks',level2marks='$part1level2marks',level3marks='$part1level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }elseif ($part2name == $mypartname) {
              $sql6 = "UPDATE partsresult set markspositive='$part2correctmarks',questionscorrect='$part2correct',questionsincorrect='$part2incorrect',marksnegative='$part2incorrectmarks',attempted='$part2attempted',mymarks='$part2marks',level1marks='$part2level1marks',level2marks='$part2level2marks',level3marks='$part2level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }elseif ($part3name == $mypartname) {
              $sql6 = "UPDATE partsresult set markspositive='$part3correctmarks',questionscorrect='$part3correct',questionsincorrect='$part3incorrect',marksnegative='$part3incorrectmarks',attempted='$part3attempted',mymarks='$part3marks',level1marks='$part3level1marks',level2marks='$part3level2marks',level3marks='$part3level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }elseif ($part4name == $mypartname) {
              $sql6 = "UPDATE partsresult set markspositive='$part4correctmarks',questionscorrect='$part4correct',questionsincorrect='$part4incorrect',marksnegative='$part4incorrectmarks',attempted='$part4attempted',mymarks='$part4marks',level1marks='$part4level1marks',level2marks='$part4level2marks',level3marks='$part4level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }elseif ($part5name == $mypartname) {
              $sql6 = "UPDATE partsresult set markspositive='$part5correctmarks',questionscorrect='$part5correct',questionsincorrect='$part5incorrect',marksnegative='$part5incorrectmarks',attempted='$part5attempted',mymarks='$part5marks',level1marks='$part5level1marks',level2marks='$part5level2marks',level3marks='$part5level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }elseif ($part6name == $mypartname) {
              $sql6 = "UPDATE partsresult set markspositive='$part6correctmarks',questionscorrect='$part6correct',questionsincorrect='$part6incorrect',marksnegative='$part6incorrectmarks',attempted='$part6attempted',mymarks='$part6marks',level1marks='$part6level1marks',level2marks='$part6level2marks',level3marks='$part6level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }elseif ($part7name == $mypartname) {
              $sql6 = "UPDATE partsresult set markspositive='$part7correctmarks',questionscorrect='$part7correct',questionsincorrect='$part7incorrect',marksnegative='$part7incorrectmarks',attempted='$part7attempted',mymarks='$part7marks',level1marks='$part7level1marks',level2marks='$part7level2marks',level3marks='$part7level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }elseif ($part8name != "") {
              $sql6 = "UPDATE partsresult set markspositive='$part8correctmarks',questionscorrect='$part8correct',questionsincorrect='$part8incorrect',marksnegative='$part8incorrectmarks',attempted='$part8attempted',mymarks='$part8marks',level1marks='$part8level1marks',level2marks='$part8level2marks',level3marks='$part8level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }elseif ($part9name == $mypartname) {
              $sql6 = "UPDATE partsresult set markspositive='$part9correctmarks',questionscorrect='$part9correct',questionsincorrect='$part9incorrect',marksnegative='$part9incorrectmarks',attempted='$part9attempted',mymarks='$part9marks',level1marks='$part9level1marks',level2marks='$part9level2marks',level3marks='$part9level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }elseif ($part10name == $mypartname) {
              $sql6 = "UPDATE partsresult set markspositive='$part10correctmarks',questionscorrect='$part10correct',questionsincorrect='$part10incorrect',marksnegative='$part10incorrectmarks',attempted='$part10attempted',mymarks='$part10marks',level1marks='$part10level1marks',level2marks='$part10level2marks',level3marks='$part10level3marks' where pid='$mypartid'";
              $conn->query($sql6);
          }
         
        }
      }

    $percentage2 = number_format($percentage, 0) . "%";
    $mypercentage = number_format($percentage, 0);

date_default_timezone_set('Asia/Kolkata');
$timestamp = date('Y/m/d h:i:s a', time());


    $date = date("Y/m/d");


    $sql5="UPDATE results set totalmarks='$totalmarks',correctquestions='$correct',incorrectquestions='$incorrect',blank='$blank',attempted='$totalattempted',totalquestions='$totalnoofquestions',mymarks='$totalmarks',examname='$examname',mypercentile='$percentage2',correctmarks='$correctmarks',incorrectmarks='$incorrectmarks',level1marks='$level1marks',level2marks='$level2marks',level3marks='$level3marks',apppercent='$mypercentage',level1correctmarks='$level1correctmarks',level1incorrectmarks='$level1incorrectmarks',level2correctmarks='$level2correctmarks',level2incorrectmarks='$level2incorrectmarks',level3correctmarks='$level3correctmarks',level3incorrectmarks='$level3incorrectmarks',level1questions='$level1questions',level1correctquestions='$level1correct',level1incorrectquestions='$level1incorrect',level2questions='$level2questions',level2correctquestions='$level2correct',level2incorrectquestions='$level2incorrect',level3questions='$level3questions',level3correctquestions='$level3correct',level3incorrectquestions='$level3incorrect',level1totalmarks='$level1totalmarks',level2totalmarks='$level2totalmarks',level3totalmarks='$level3totalmarks' where rid='$resultid'";

    $conn->query($sql5);

    }
  }


  ?>

</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Recalculate Results");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3>Records Recalculated: <span style="color:green">Done!</span></h3>
              </div>
            </div>
          </div>
        </div>
      </div>

  <?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>
