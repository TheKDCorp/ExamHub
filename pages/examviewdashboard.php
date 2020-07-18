 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<script type="text/javascript">
  history.pushState(null,null,null);
  window.addEventListener('popstate',function(){
    history.pushState(null,null,null);
  });
</script>

 <?php 

$sid =$_COOKIE["user_id"];

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
    $sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Clicked Original Test Results > Exam Attempts > Exam Report','$timestamp')";
    $conn->query($sql);
  }
  if($settings['tracking']=="true"){
    $sql = "update students set page='Reports' where sid='$sid'";
    $conn->query($sql);
  }
}
 ?>

<?php 
    $cid = $sid;
    $qindex=addslashes(htmlspecialchars($_GET['qindex'],ENT_QUOTES));
    $examname=addslashes(htmlspecialchars($_GET['examname'],ENT_QUOTES));

if($examname=="" || $qindex=="" || $cid==""){
    ?>
    <script type="text/javascript">
  window.location.href = "../";
</script> 
    <?php
    exit();
}

$sql = "select * from questionpaper";
  $result=$conn->query($sql);
  if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
          if(md5($row['name'])==$examname){
              $examname = $row['name'];
          }
      }
  }else{

      exit();
  }

$sql = "select * from results where cid='$cid' and examname='$examname'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
  if(md5($row['qindex']) == $qindex){
    $qindex = $row['qindex'];
  }
}
$sql = "select * from results where cid='$cid' and qindex='$qindex' and examname='$examname'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql2 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname'";
$result2 = $conn->query($sql2);

$sql3 = "select * from results where cid='$cid' and qindex='$qindex' and examname='$examname'";
$result3 = $conn->query($sql3);
 ?>

<script>
  function updatepage(){
      var mysid=<?php echo $sid; ?>;
      var page="Reports";
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: "updatepage='true'&page='"+page+"'&examname=''&sid='"+mysid+"'",
        success: function(data) {
        }
      });
    }

    $(document).ready(function() {
      setInterval(function(){ 
         updatepage();
      }, 3000);
    });  
</script>

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
                                    <td class="cell100 column1">My Percentage</td>
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
                              <a onclick="refreshpage()" style="float:right;color:white;" class="btn btn-info">Refresh Page</a>
                              <a onclick="openinnewtab()" style="float:right;color:white;" class="btn btn-warning">Open in New Tab</a>
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

          function openinnewtab(){
            var mylink="studentexamview.php?cid=<?php echo $cid; ?>&qindex=<?php echo $qindex; ?>&examname=<?php echo $row['examname']; ?>";
            window.open(mylink, '_blank');
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

  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
