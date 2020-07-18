<?php
 include_once('../created/headerwithoutloading.php'); 
?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<?php 
$sid = $_COOKIE["user_id"];

$sql = "select * from settings limit 1";
$rs1=$conn->query($sql);
if($rs1->num_rows > 0){
  $settings = $rs1->fetch_assoc();
  if($settings['logs']=="true"){
    date_default_timezone_set('Asia/Kolkata');
    $timestamp = date('Y/m/d h:i:s a', time());
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $IP = $_SERVER["HTTP_CLIENT_IP"];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $IP = $_SERVER['REMOTE_ADDR'];
    }
    $mycomputername = gethostbyaddr($IP); 
    $sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Clicked Dashboard','$timestamp')";
    $conn->query($sql);
  }
  if($settings['tracking']=="true"){
    $sql = "update students set page='Dashboard' where sid='$sid'";
    $conn->query($sql);
  }
}
 ?>

      <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
      </div>
<!--       <div class="content">
        <div class="row"> -->
<!--           <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Score(Mains)</h5>
                <h4 class="card-title">Physics</h4>
                
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExampleWithNumbers"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                </div>
              </div>
            </div>
          </div> -->
<!--           <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Score(Mains)</h5>
                <h4 class="card-title">Chemistry</h4>
                
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExampleWithNumbersAndGrid"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  
                </div>
              </div>
            </div>
          </div> -->
<!--           <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Score(Mains)</h5>
                <h4 class="card-title">Maths</h4>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExampleformaths"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  
                </div>
              </div>
            </div>
          </div> -->
<!--         </div>
        <br> -->
      

<?php 

    $cid = $sid;

$sql = "select * from results where cid='$cid' order by rid desc limit 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$qindex = $row['qindex'];
$examname = $row['examname'];

$sql2 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname'";
$result2 = $conn->query($sql2);

$sql3 = "select * from results where cid='$cid' and qindex='$qindex' and examname='$examname'";
$result3 = $conn->query($sql3);
 ?>

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


.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 0px solid #ccc;
    border-top: none;
}


@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
  #customers{
    width:100%;
  }
  .statdigit{
    font-size:15px;
  }
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:landscape) {
  #customers{
    width:100%;
  }
    .statdigit{
    font-size:15px;
  }
}
</style>

 <!-- <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css"> -->
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/css/util.css">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->



  <script>
    $('.js-pscroll').each(function(){
      var ps = new PerfectScrollbar(this);

      $(window).on('resize', function(){
        ps.update();
      })
    });
      
    
  </script>
<!--===============================================================================================-->
  <!-- <script src="assets/js/main2.js"></script> -->


     
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
          <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">

                <div class="container-fluid">
                  <div class="row">
                    <div class="col-xl-3 col-md-3 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <!-- <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div> -->
                                        <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                                        <div class="stat-content dib">
                                          <?php $sql5 = "select * from results where examname='$examname' and cid='$cid'";
                                          $result5 = $conn->query($sql5);
                                          $totalstudents = $result5->num_rows;

                                           ?>
                                            <div class="stat-text">Total Students</div>
                                            <div class="stat-digit"><?php echo $totalstudents ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <div class="col-xl-3 col-md-3 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                                        <div class="stat-content dib">
                                          <?php 
                                            $sql5 = "select * from results where examname='$examname' and qindex='$qindex' and cid='$cid'";
                                            $result5 = $conn->query($sql5);
                                            if($result5->num_rows > 0){
                                              $row5=$result5->fetch_assoc();
                                              $resultid = $row5['rid'];

                                              if($resultid!=""){
                                                $sql55= "select * from resultrank where resultid='$resultid'";
                                                $result55 = $conn->query($sql55);
                                                if($result55->num_rows > 0){
                                                  $row55 = $result55->fetch_assoc();
                                                  $rank = $row55['rank'];
                                                }else{
                                                  $rank = "Null";                                                
                                                }
                                              }else{
                                                $rank = "Null";
                                              }
                                            }else{
                                              $rank = "Null";
                                            }
                                           ?>
                                            <div class="stat-text">Rank Obtained</div>
                                            <div class="stat-digit"><?php echo $rank; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                           <div class="col-xl-3 col-md-3 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-stats-up text-success"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Marks Obtained</div>
                                            <div class="stat-digit"><?php echo $row['mymarks']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-3 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-pulse text-info border-info"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Percentile Obtained</div>
                                            <div class="stat-digit"><?php echo $row['mypercentile']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="row">
                                            <div class="col-xl-3 col-md-3 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><ion-icon style="font-size:50px;" name="checkmark-circle-outline" class="border-success text-success"></ion-icon></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Correct Answers</div>
                                            <div class="stat-digit"><?php echo $row['correctquestions']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><ion-icon style="font-size:50px;" name="close-circle-outline" class="border-danger text-danger"></ion-icon></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Incorrect Answers</div>
                                            <div class="stat-digit"><?php echo $row['incorrectquestions']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
      
                        <div class="col-xl-3 col-md-3 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><ion-icon style="font-size:50px;" name="square-outline" class="border-info text-info"></ion-icon></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Blank Answers</div>
                                            <div class="stat-digit"><?php echo $row['blank']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="col-xl-3 col-md-3 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib">
                                            <ion-icon style="font-size:50px;" name="clock" class="border-warning text-warning"></ion-icon>
                                        </div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">
                                                Time Taken
                                            </div>
                                            <div class="stat-digit">
                                                <?php echo $row['mytime']; ?> <span style="font-size:13px">Sec!!!</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                  </div>
                </div>

<?php 

$sql5 = "select * from results where examname='$examname' and qindex='$qindex' and cid='$cid'";
  $result5 = $conn->query($sql5);
  if($result5->num_rows > 0){
    $row5=$result5->fetch_assoc();
    $generateresult = $row5['generateresult'];
  }else{
    $generateresult = "";
  }
 ?>

  

                  <div class="card">
                    <div class="card-body">
                      <center>
                      <ul class="pagination">
                        <li class="page-item"><a class="page-link tabs" onclick="openCity(event,'reportcard')">Report Card</a></li>
                        <li class="page-item"><a class="page-link tabs" onclick="openCity(event,'subjectdetails')">Subject Details</a></li>
                        <li class="page-item"><a class="page-link tabs" onclick="openCity(event,'leveldetails')">Level Wise Details</a></li>
                        <?php if($generateresult=="true"){
                          ?>
                          <li class="page-item"><a class="page-link tabs" onclick="openCity(event,'checkanswers')">Check Answers</a></li>
                          <?php
                        } ?>
                        
                      </ul>
                      </center>
                      <hr>
                    </div>
                  </div>

                      <div id="reportcard" class="tabcontent">
                        <center><h4>Report Card</h4></center>
                        <hr>
                        <div class="card">
                          <div class="card-body">
                            <div class="table100-body js-pscroll">
                              <table>
                                <tbody>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Exam Name</td>
                                    <td class="cell100 column2"><?php echo $row['examname']; ?></td>
                                    <td class="cell100 column3">Date</td>
                                    <td class="cell100 column4"><?php echo $row['date']; ?></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Total Marks</td>
                                    <td class="cell100 column2"><?php echo $row['totalmarks']; ?></td>
                                    <td class="cell100 column3">Total Questions</td>
                                    <td class="cell100 column4"><?php echo $row['totalquestions']; ?></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Total time</td>
                                    <td class="cell100 column2"><?php echo $row['totaltime']; ?> Minutes!!!</td>
                                    <td class="cell100 column3">Total Percentile</td>
                                    <td class="cell100 column4">100%</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                            <div class="table100-body js-pscroll">
                              <table>
                                <tbody>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">My Percentile</td>
                                    <td class="cell100 column2"><?php echo $row['mypercentile']; ?></td>
                                    <td class="cell100 column3">Time Taken</td>
                                    <td class="cell100 column4"><?php echo $row['mytime']; ?> Minutes!!!</td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Marks Obtained</td>
                                    <td class="cell100 column2"><?php echo $row['mymarks']; ?></td>
                                    <td class="cell100 column3">Attempted</td>
                                    <td class="cell100 column4"><?php echo $row['attempted']; ?></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Correct Answers</td>
                                    <td class="cell100 column2"><?php echo $row['correctquestions']; ?></td>
                                    <td class="cell100 column3">Correct Marks</td>
                                    <td class="cell100 column4"><?php echo $row['correctmarks']; ?></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Incorrect Answers</td>
                                    <td class="cell100 column2"><?php echo $row['incorrectquestions']; ?></td>
                                    <td class="cell100 column3">Incorrect Marks</td>
                                    <td class="cell100 column4"><?php echo $row['incorrectmarks']; ?></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Blank Answers</td>
                                    <td class="cell100 column2"><?php echo $row['blank']; ?></td>
                                    <td class="cell100 column3">Blank Marks</td>
                                    <td class="cell100 column4">0</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div> <!-- .card -->
                        <div class="card">
                          <div class="card-body">
                            <div class="table100-body js-pscroll">
                              <table>
                                <tbody>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Beginner's Questions</td>
                                    <td class="cell100 column2"><?php echo $row['level1correctquestions']; ?>/<?php echo $row['level1questions']; ?></td>
                                    <td class="cell100 column3">Beginner's Marks</td>
                                    <td class="cell100 column4"><?php echo $row['level1correctmarks']; ?>/<?php echo $row['level1totalmarks']; ?></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Intermediate Questions</td>
                                    <td class="cell100 column2"><?php echo $row['level2correctquestions']; ?>/<?php echo $row['level2questions']; ?></td>
                                    <td class="cell100 column3">Intermediate Marks</td>
                                    <td class="cell100 column4"><?php echo $row['level2correctmarks']; ?>/<?php echo $row['level2totalmarks']; ?></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Advanced Questions</td>
                                    <td class="cell100 column2"><?php echo $row['level3correctquestions']; ?>/<?php echo $row['level3questions']; ?></td>
                                    <td class="cell100 column3">Advanced Marks</td>
                                    <td class="cell100 column4"><?php echo $row['level3correctmarks']; ?>/<?php echo $row['level3totalmarks']; ?></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div> <!-- .card -->
                      </div>


                        <div id="subjectdetails" class="tabcontent">
                          <center><h4>Subject Report</h4></center>
                          <hr>
                          <?php while($row2=$result2->fetch_assoc()){ ?>
                          <div class="card">
                            <div class="card-body">
                              <div class="table100-body js-pscroll">
                                <table>
                                <tbody>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Subject Name</td>
                                    <td class="cell100 column2"><?php echo $row2['partname']; ?></td>
                                    <td class="cell100 column3">Attempted</td>
                                    <td class="cell100 column4"><?php echo $row2['attempted']; ?></td>
                                    <td class="cell100 column5"></td>
                                    <td class="cell100 column6"></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Total Marks</td>
                                    <td class="cell100 column2"><?php echo $row2['totalmarks']; ?></td>
                                    <td class="cell100 column3">Obtained Marks</td>
                                    <td class="cell100 column4"><?php echo $row2['mymarks']; ?></td>
                                    <td class="cell100 column5"></td>
                                    <td class="cell100 column6"></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Correct Questions</td>
                                    <td class="cell100 column2"><?php echo $row2['questionscorrect']; ?></td>
                                    <td class="cell100 column3">Correct Marks</td>
                                    <td class="cell100 column4"><?php echo $row2['markspositive']; ?></td>
                                    <td class="cell100 column5"></td>
                                    <td class="cell100 column6"></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Incorrect Questions</td>
                                    <td class="cell100 column2"><?php echo $row2['questionsincorrect']; ?></td>
                                    <td class="cell100 column3">Incorrect Marks</td>
                                    <td class="cell100 column4"><?php echo $row2['marksnegative']; ?></td>
                                    <td class="cell100 column5"></td>
                                    <td class="cell100 column6"></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Beginner's Marks</td>
                                    <td class="cell100 column2"><?php echo $row2['level1marks']; ?></td>
                                    <td class="cell100 column3">Intermediate Marks</td>
                                    <td class="cell100 column4"><?php echo $row2['level2marks']; ?></td>
                                    <td class="cell100 column5">Advanced Marks</td>
                                    <td class="cell100 column6"><?php echo $row2['level3marks']; ?></td>
                                  </tr>
                                </tbody>
                              </table>
                              </div>
                            </div>
                          </div>
                                  <?php } ?>

                        </div>

                        <div id="leveldetails" class="tabcontent">
                          <center><h4>Level Wise Report</h4></center>
                          <hr>
                          <?php while($row2=$result3->fetch_assoc()){ ?>
                          <div class="card">
                            <div class="card-body">
                              <div class="table100-body js-pscroll">
                                <table>
                                  <tbody>
                                    <tr class="row100 body">
                                      <td class="cell100 column1">Beginner's Questions</td>
                                      <td class="cell100 column2"><?php echo $row['level1questions']; ?></td>
                                      <td class="cell100 column3">Beginner's Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level1marks']; ?>/<?php echo $row['level1totalmarks']; ?></td>
                                    </tr>
                                    <tr class="row100 body">
                                      <td class="cell100 column1">Beginner's Correct Questions</td>
                                      <td class="cell100 column2"><?php echo $row['level1correctquestions']; ?>/<?php echo $row['level1questions']; ?></td>
                                      <td class="cell100 column3">Beginner's Correct Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level1correctmarks']; ?>/<?php echo $row['level1totalmarks']; ?></td>
                                    </tr>
                                    <tr class="row100 body">
                                      <td class="cell100 column1">Beginner's InCorrect Questions</td>
                                      <td class="cell100 column2"><?php echo $row['level1incorrectquestions']; ?>/<?php echo $row['level1questions']; ?></td>
                                      <td class="cell100 column3">Beginner's InCorrect Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level1incorrectmarks']; ?>/<?php echo $row['level1totalmarks']; ?></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div> <!-- .card -->
                          <div class="card">
                            <div class="card-body">
                              <div class="table100-body js-pscroll">
                                <table>
                                  <tbody>
                                    <tr class="row100 body">
                                      <td class="cell100 column1">Intermediate Questions</td>
                                      <td class="cell100 column2"><?php echo $row['level2questions']; ?></td>
                                      <td class="cell100 column3">Intermediate Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level2marks']; ?>/<?php echo $row['level2totalmarks']; ?></td>
                                    </tr>
                                    <tr class="row100 body">
                                      <td class="cell100 column1">Intermediate Correct Questions</td>
                                      <td class="cell100 column2"><?php echo $row['level2correctquestions']; ?>/<?php echo $row['level2questions']; ?></td>
                                      <td class="cell100 column3">Intermediate Correct Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level2correctmarks']; ?>/<?php echo $row['level2totalmarks']; ?></td>
                                    </tr>
                                    <tr class="row100 body">
                                      <td class="cell100 column1">Intermediate InCorrect Questions</td>
                                      <td class="cell100 column2"><?php echo $row['level2incorrectquestions']; ?>/<?php echo $row['level2questions']; ?></td>
                                      <td class="cell100 column3">Intermediate InCorrect Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level2incorrectmarks']; ?>/<?php echo $row['level2totalmarks']; ?></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div> <!-- .card -->
                          <div class="card">
                            <div class="card-body">
                              <div class="table100-body js-pscroll">
                                <table>
                                  <tbody>
                                    <tr class="row100 body">
                                      <td class="cell100 column1">Advanced Questions</td>
                                      <td class="cell100 column2"><?php echo $row['level3questions']; ?></td>
                                      <td class="cell100 column3">Advanced Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level3marks']; ?>/<?php echo $row['level3totalmarks']; ?></td>
                                    </tr>
                                    <tr class="row100 body">
                                      <td class="cell100 column1">Advanced Correct Questions</td>
                                      <td class="cell100 column2"><?php echo $row['level3correctquestions']; ?>/<?php echo $row['level3questions']; ?></td>
                                      <td class="cell100 column3">Advanced Correct Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level3correctmarks']; ?>/<?php echo $row['level3totalmarks']; ?></td>
                                    </tr>
                                    <tr class="row100 body">
                                      <td class="cell100 column1">Advanced InCorrect Questions</td>
                                      <td class="cell100 column2"><?php echo $row['level3incorrectquestions']; ?>/<?php echo $row['level3questions']; ?></td>
                                      <td class="cell100 column3">Advanced InCorrect Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level3incorrectmarks']; ?>/<?php echo $row['level3totalmarks']; ?></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div> <!-- .card -->

                                  <?php } ?>

                        </div>
                        <?php if($generateresult=="true"){
                          ?>
                            <div id="checkanswers" class="tabcontent">
                              <center><h4>Check Answers</h4></center>
                              <hr>
                              <a onclick="refreshpage()" style="float:right" class="btn btn-info">Refresh Page</a>
                              <br>
                              <br>
                              <iframe id="iframe" src="studentexamview.php?cid=<?php echo $cid; ?>&qindex=<?php echo $qindex; ?>&examname=<?php echo $row['examname']; ?>" style="width:100%; border:0px;height:1000px"></iframe>
                            </div>
                          <?php
                        } ?>

                        


              </div>
            </div>
          </div>
        </div>
      </div>


        <script type="text/javascript">
          function refreshpage(){
            document.getElementById("iframe").src="studentexamview.php?cid=<?php echo $cid; ?>&qindex=<?php echo $qindex; ?>&examname=<?php echo $row['examname']; ?>";
          }

          function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tabs");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
            refreshpage();
        }
        document.getElementById("reportcard").style.display = "block";
        </script>


<script>
    $(document).ready(function() {
      
      demo.initDashboardPageCharts();

    });
</script>

<script type="text/javascript">
  demo = {
  initPickColor: function() {
    $('.pick-class-label').click(function() {
      var new_class = $(this).attr('new-class');
      var old_class = $('#display-buttons').attr('data-class');
      var display_div = $('#display-buttons');
      if (display_div.length) {
        var display_buttons = display_div.find('.btn');
        display_buttons.removeClass(old_class);
        display_buttons.addClass(new_class);
        display_div.attr('data-class', new_class);
      }
    });
  },

  initDocChart: function() {
    chartColor = "#FFFFFF";

    // General configuration for the charts with Line gradientStroke
    gradientChartOptionsConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      tooltips: {
        bodySpacing: 4,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
        xPadding: 10,
        yPadding: 10,
        caretPadding: 10
      },
      responsive: true,
      scales: {
        yAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 15,
          bottom: 15
        }
      }
    };

    ctx = document.getElementById('lineChartExample').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

    myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Active Users",
          borderColor: "#f96332",
          pointBorderColor: "#FFF",
          pointBackgroundColor: "#f96332",
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 1,
          pointRadius: 4,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 630]
        }]
      },
      options: gradientChartOptionsConfiguration
    });
  },

  initDashboardPageCharts: function() {

    chartColor = "#FFFFFF";

    // General configuration for the charts with Line gradientStroke
    gradientChartOptionsConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      tooltips: {
        bodySpacing: 4,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
        xPadding: 10,
        yPadding: 10,
        caretPadding: 10
      },
      responsive: 1,
      scales: {
        yAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 15,
          bottom: 15
        }
      }
    };

    gradientChartOptionsConfigurationWithNumbersAndGrid = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      tooltips: {
        bodySpacing: 4,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
        xPadding: 10,
        yPadding: 10,
        caretPadding: 10
      },
      responsive: true,
      scales: {
        yAxes: [{
          gridLines: 0,
          gridLines: {
            zeroLineColor: "transparent",
            drawBorder: false
          }
        }],
        xAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 25,
          top: 15,
          bottom: 15
        }
      }
    };

    var ctx = document.getElementById('bigDashboardChart').getContext("2d");

    var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [' ',' ',<?php
            $cid5 = $sid;
            $sql5 = "select * from results where cid='$cid5' and examtype='originaltest'";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $tdate5 = "";
              while($row5 = $results5->fetch_assoc()){
                $mydate5 = date("d-m-Y", strtotime($row5['date']));
                $tdate5 = $tdate5 . '"'.$mydate5.'",';
              }
              $tdate5 = substr(trim($tdate5), 0, -1);
              echo $tdate5;
            }else{
              
            }
          ?>
          ],
        datasets: [{
          label: "Total Marks",
          borderColor: chartColor,
          pointBorderColor: chartColor,
          pointBackgroundColor: "#1e3d60",
          pointHoverBackgroundColor: "#1e3d60",
          pointHoverBorderColor: chartColor,
          pointBorderWidth: 1,
          pointHoverRadius: 7,
          pointHoverBorderWidth: 2,
          pointRadius: 5,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data: [0,0,<?php
            $cid5 = $sid;
            $sql5 = "select * from results where cid='$cid5' and examtype='originaltest'";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $tdate5 = "";
              while($row5 = $results5->fetch_assoc()){
                $mydate5 = $row5['mymarks'];
                $tdate5 = $tdate5 . '"'.$mydate5.'",';
              }
              $tdate5 = substr(trim($tdate5), 0, -1);
              echo $tdate5;
            }else{
              
            }
          ?>]
        }]
      },
      options: {
        layout: {
          padding: {
            left: 20,
            right: 20,
            top: 0,
            bottom: 0
          }
        },
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: '#fff',
          titleFontColor: '#333',
          bodyFontColor: '#666',
          bodySpacing: 4,
          xPadding: 12,
          mode: "nearest",
          intersect: 0,
          position: "nearest"
        },
        legend: {
          position: "bottom",
          fillStyle: "#FFF",
          display: false
        },
        scales: {
          yAxes: [{
            ticks: {
              fontColor: "rgba(255,255,255,0.4)",
              fontStyle: "bold",
              beginAtZero: true,
              maxTicksLimit: 5,
              padding: 10
            },
            gridLines: {
              drawTicks: true,
              drawBorder: false,
              display: true,
              color: "rgba(255,255,255,0.1)",
              zeroLineColor: "transparent"
            }

          }],
          xAxes: [{
            gridLines: {
              zeroLineColor: "transparent",
              display: false,

            },
            ticks: {
              padding: 10,
              fontColor: "rgba(255,255,255,0.4)",
              fontStyle: "bold"
            }
          }]
        }
      }
    });

    var cardStatsMiniLineColor = "#fff",
      cardStatsMiniDotColor = "#fff";

    ctx = document.getElementById('lineChartExampleWithNumbersAndGrid').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

    myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      data: {
        labels: [' ',' ',

    <?php
            $cid5 = $sid;
            $sql5 = "select * from results where cid='$cid5' and examtype='originaltest'";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $tdate5 = "";
              while($row5 = $results5->fetch_assoc()){
                $mydate5 = date("d-m-Y", strtotime($row5['date']));
                $tdate5 = $tdate5 . '"'.$mydate5.'",';
              }
              $tdate5 = substr(trim($tdate5), 0, -1);
              echo $tdate5;
            }else{
              
            }
          ?>

  ],
        datasets: [{
          label: "Chemistry",
          borderColor: "#f96332",
          pointBorderColor: "#FFF",
          pointBackgroundColor: "#f96332",
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 1,
          pointRadius: 4,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data: ["0","0",
          <?php
            $cid = $sid;
            $sql = "select * from results where cid='$cid' and examtype='originaltest'";
            $results = $conn->query($sql);
            if($results->num_rows > 0){
              $tmarks = "";
              while($row = $results->fetch_assoc()){
                $qindex = $row['qindex'];
                $cid = $row['cid'];
                $examname = $row['examname'];
                $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='chemistry' and examtype='originaltest'";
                $results1 = $conn->query($sql1);
                if($results1->num_rows > 0){
                  $row1 = $results1->fetch_assoc();
                  $mymarks = $row1['mymarks'];
                  $tmarks = $tmarks . '"'.$mymarks.'",';
                }
              }
              $tmarks = substr(trim($tmarks), 0, -1);
              echo $tmarks;
            }else{
              
            }
          ?>
          ]
        }]
      },
      options: gradientChartOptionsConfigurationWithNumbersAndGrid
    });

    ctx = document.getElementById('lineChartExampleWithNumbers').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#18ce0f');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, hexToRGB('#18ce0f', 0.4));

    myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      data: {
        labels: [' ',' ',
        <?php
            $cid5 = $sid;
            $sql5 = "select * from results where cid='$cid5' and examtype='originaltest'";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $tdate5 = "";
              while($row5 = $results5->fetch_assoc()){
                $mydate5 = date("d-m-Y", strtotime($row5['date']));
                $tdate5 = $tdate5 . '"'.$mydate5.'",';
              }
              $tdate5 = substr(trim($tdate5), 0, -1);
              echo $tdate5;
            }else{
              
            }
          ?>

        ],
        datasets: [{
          label: "Physics",
          borderColor: "#18ce0f",
          pointBorderColor: "#FFF",
          pointBackgroundColor: "#18ce0f",
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 1,
          pointRadius: 4,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data: [0,0,
          <?php
            $cid = $sid;
            $sql = "select * from results where cid='$cid' and examtype='originaltest'";
            $results = $conn->query($sql);
            if($results->num_rows > 0){
              $tmarks = "";
              while($row = $results->fetch_assoc()){
                $qindex = $row['qindex'];
                $cid = $row['cid'];
                $examname = $row['examname'];
                $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='physics' and examtype='originaltest'";
                $results1 = $conn->query($sql1);
                if($results1->num_rows > 0){
                  $row1 = $results1->fetch_assoc();
                  $mymarks = $row1['mymarks'];
                  $tmarks = $tmarks . '"'.$mymarks.'",';
                }
              }
              $tmarks = substr(trim($tmarks), 0, -1);
              echo $tmarks;
            }else{
              
            }
          ?>
          ]
        }]
      },
      options: gradientChartOptionsConfigurationWithNumbersAndGrid
    });

        ctx = document.getElementById('lineChartExampleformaths').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#18ce0f');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

    myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      data: {
        labels: [' ',' ',
        <?php
            $cid5 = $sid;
            $sql5 = "select * from results where cid='$cid5' and examtype='originaltest'";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $tdate5 = "";
              while($row5 = $results5->fetch_assoc()){
                $mydate5 = date("d-m-Y", strtotime($row5['date']));
                $tdate5 = $tdate5 . '"'.$mydate5.'",';
              }
              $tdate5 = substr(trim($tdate5), 0, -1);
              echo $tdate5;
            }else{
              
            }
          ?>
          ],
        datasets: [{
          label: "Maths",
          backgroundColor: gradientFill,
          borderColor: "#2CA8FF",
          pointBorderColor: "#FFF",
          pointBackgroundColor: "#2CA8FF",
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 1,
          pointRadius: 4,
          fill: true,
          borderWidth: 1,
          data: [0,0,<?php
            $cid = $sid;
            $sql = "select * from results where cid='$cid' and examtype='originaltest'";
            $results = $conn->query($sql);
            if($results->num_rows > 0){
              $tmarks = "";
              while($row = $results->fetch_assoc()){
                $qindex = $row['qindex'];
                $cid = $row['cid'];
                $examname = $row['examname'];
                $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='maths' and examtype='originaltest'";
                $results1 = $conn->query($sql1);
                if($results1->num_rows > 0){
                  $row1 = $results1->fetch_assoc();
                  $mymarks = $row1['mymarks'];
                  $tmarks = $tmarks . '"'.$mymarks.'",';
                }
              }
              $tmarks = substr(trim($tmarks), 0, -1);
              echo $tmarks;
            }else{
             
            }
          ?>]
        }]
      },
      options: gradientChartOptionsConfigurationWithNumbersAndGrid
    });

    // var e = document.getElementById("barChartSimpleGradientsNumbers").getContext("2d");

    // gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    // gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    // gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

    // var a = {
    //   type: "bar",
    //   data: {
    //     labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    //     datasets: [{
    //       label: "Active Countries",
    //       backgroundColor: gradientFill,
    //       borderColor: "#2CA8FF",
    //       pointBorderColor: "#FFF",
    //       pointBackgroundColor: "#2CA8FF",
    //       pointBorderWidth: 2,
    //       pointHoverRadius: 4,
    //       pointHoverBorderWidth: 1,
    //       pointRadius: 4,
    //       fill: true,
    //       borderWidth: 1,
    //       data: [80, 99, 86, 96, 123, 85, 100, 75, 88, 90, 123, 155]
    //     }]
    //   },
    //   options: {
    //     maintainAspectRatio: false,
    //     legend: {
    //       display: false
    //     },
    //     tooltips: {
    //       bodySpacing: 4,
    //       mode: "nearest",
    //       intersect: 0,
    //       position: "nearest",
    //       xPadding: 10,
    //       yPadding: 10,
    //       caretPadding: 10
    //     },
    //     responsive: 1,
    //     scales: {
    //       yAxes: [{
    //         gridLines: 0,
    //         gridLines: {
    //           zeroLineColor: "transparent",
    //           drawBorder: false
    //         }
    //       }],
    //       xAxes: [{
    //         display: 0,
    //         gridLines: 0,
    //         ticks: {
    //           display: false
    //         },
    //         gridLines: {
    //           zeroLineColor: "transparent",
    //           drawTicks: false,
    //           display: false,
    //           drawBorder: false
    //         }
    //       }]
    //     },
    //     layout: {
    //       padding: {
    //         left: 0,
    //         right: 0,
    //         top: 15,
    //         bottom: 15
    //       }
    //     }
    //   }
    // };

    var viewsChart = new Chart(e, a);
  }

};
</script>

  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer2.php'); ?>
