<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Examination System | Macro Vision Academy
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="../assets/fonts/myfont.css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
<script src="../assets/js/core/jquery.min.js"></script>
</head>

<style type="text/css">
#style-10::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  background-color: #F5F5F5;
  border-radius: 10px;
}

#style-10::-webkit-scrollbar
{
  width: 10px;
  background-color: #F5F5F5;
}

#style-10::-webkit-scrollbar-thumb
{
  background-color: #AAA;
  border-radius: 10px;
  background-image: -webkit-linear-gradient(90deg,
                                            rgba(0, 0, 0, .2) 25%,
                        transparent 25%,
                        transparent 50%,
                        rgba(0, 0, 0, .2) 50%,
                        rgba(0, 0, 0, .2) 75%,
                        transparent 75%,
                        transparent)
}
</style>

<script type="text/x-mathjax-config">  
  MathJax.HTML.Cookie.Set("menu",{});
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX","output/HTML-CSS"],
    "HTML-CSS": {
      availableFonts:[],
      styles: {".MathJax_Preview": {visibility: "hidden"}}
    }
  });
  MathJax.Hub.Register.StartupHook("HTML-CSS Jax Ready",function () {
    var FONT = MathJax.OutputJax["HTML-CSS"].Font;
    FONT.loadError = function (font) {
      MathJax.Message.Set("Can't load web font TeX/"+font.directory,null,2000);
      document.getElementById("noWebFont").style.display = "";
    };
    FONT.firefoxFontError = function (font) {
      MathJax.Message.Set("Firefox can't load web fonts from a remote host",null,3000);
      document.getElementById("ffWebFont").style.display = "";
    };
  });

(function (HUB) {
  
  var MINVERSION = {
    Firefox: 3.0,
    Opera: 9.52,
    MSIE: 6.0,
    Chrome: 0.3,
    Safari: 2.0,
    Konqueror: 4.0,
    Unknown: 10000.0 // always disable unknown browsers
  };
  
  if (!HUB.Browser.versionAtLeast(MINVERSION[HUB.Browser]||0.0)) {
    HUB.Config({
      jax: [],                   // don't load any Jax
      extensions: [],            // don't load any extensions
      "v1.0-compatible": false   // skip warning message due to no jax
    });
    setTimeout('document.getElementById("badBrowser").style.display = ""',0);
  }
  
})(MathJax.Hub);

MathJax.Hub.Register.StartupHook("End",function () {
  var HTMLCSS = MathJax.OutputJax["HTML-CSS"];
  if (HTMLCSS && HTMLCSS.imgFonts) {document.getElementById("imageFonts").style.display = ""}
});
</script>

<script type="text/javascript" src="../mathjax/MathJax.js"></script>


<body class="">
  

 <?php include_once('../includes/dbcon.php'); ?>

<?php 
$cid=$_GET['studentid'];
$sql = "select * from results where cid='$cid' order by cid desc";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$cid = $row['cid'];
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
                                          <?php $sql5 = "select * from results where examname='$examname'";
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
                                          <?php $sql5 = "select * from results where examname='$examname' order by mymarks";
                                          $result5 = $conn->query($sql5);
                                          $rank = $result5->num_rows;
                                           ?>
                                            <div class="stat-text">Rank Obtained</div>
                                            <div class="stat-digit">Null</div>
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
                                                Time Left
                                            </div>
                                            <div class="stat-digit">
                                                <?php echo $row['mytime']; ?> <span style="font-size:13px">Mins!!!</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                  </div>
                </div>


  

                  <div class="card">
                    <div class="card-body">
                      <center>
                      <ul class="pagination">
                        <li class="page-item"><a class="page-link tabs" onclick="openCity(event,'reportcard')">Report Card</a></li>
                        <li class="page-item"><a class="page-link tabs" onclick="openCity(event,'subjectdetails')">Subject Details</a></li>
                        <li class="page-item"><a class="page-link tabs" onclick="openCity(event,'leveldetails')">Level Wise Details</a></li>
                        <!-- <li class="page-item"><a class="page-link tabs" onclick="openCity(event,'checkanswers')">Check Answers</a></li> -->
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
                                    <td class="cell100 column4"><?php echo $row['level1totalmarks']; ?>/<?php echo $row['level1correctmarks']; ?></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Intermediate Questions</td>
                                    <td class="cell100 column2"><?php echo $row['level2correctquestions']; ?>/<?php echo $row['level2questions']; ?></td>
                                    <td class="cell100 column3">Intermediate Marks</td>
                                    <td class="cell100 column4"><?php echo $row['level2totalmarks']; ?>/<?php echo $row['level2correctmarks']; ?></td>
                                  </tr>
                                  <tr class="row100 body">
                                    <td class="cell100 column1">Advanced Questions</td>
                                    <td class="cell100 column2"><?php echo $row['level3correctquestions']; ?>/<?php echo $row['level3questions']; ?></td>
                                    <td class="cell100 column3">Advanced Marks</td>
                                    <td class="cell100 column4"><?php echo $row['level3totalmarks']; ?>/<?php echo $row['level3correctmarks']; ?></td>
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
                                    <td class="cell100 column3">Total Marks</td>
                                    <td class="cell100 column4"><?php echo $row2['totalmarks']; ?></td>
                                    <td class="cell100 column5">Attempted</td>
                                    <td class="cell100 column6"><?php echo $row2['attempted']; ?></td>
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
                                      <td class="cell100 column2"><?php echo $row['level1correctquestions']; ?>/<?php echo $row['level1questions']; ?></td>
                                      <td class="cell100 column3">Beginner's Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level1correctmarks']; ?>/<?php echo $row['level1totalmarks']; ?></td>
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
                                      <td class="cell100 column2"><?php echo $row['level2correctquestions']; ?>/<?php echo $row['level2questions']; ?></td>
                                      <td class="cell100 column3">Intermediate Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level2correctmarks']; ?>/<?php echo $row['level2totalmarks']; ?></td>
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
                                      <td class="cell100 column2"><?php echo $row['level3correctquestions']; ?>/<?php echo $row['level3questions']; ?></td>
                                      <td class="cell100 column3">Advanced Marks</td>
                                      <td class="cell100 column4"><?php echo $row['level3correctmarks']; ?>/<?php echo $row['level3totalmarks']; ?></td>
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
                          
                          <!-- <div id="checkanswers" class="tabcontent">
                            <center><h4>Check Answers</h4></center>
                            <hr>
                            <a onclick="refreshpage()" style="float:right" class="btn btn-info">Refresh Page</a>
                            <br>
                            <br>
                            <iframe id="iframe" src="studentexamview.php?id=<?php echo $cid; ?>&qindex=<?php echo $qindex; ?>&examname=<?php echo $row['examname']; ?>" style="width:100%; border:0px;height:1000px"></iframe>
                          </div> -->


              </div>
            </div>
          </div>
        </div>
      </div>


        <script type="text/javascript">
          function refreshpage(){
            document.getElementById("iframe").src="studentexamview.php?id=<?php echo $cid; ?>&qindex=<?php echo $qindex; ?>&examname=<?php echo $row['examname']; ?>";
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

<?php include_once('../created/footer.php'); ?>
