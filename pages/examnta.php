<?php
  if(isset($_COOKIE["user_name"])) {
  } else {
      header("Location: ../");
      exit();
  }
?>

<style type="text/css">
  #spinner
  {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url(../images/loading.gif) 50% 50% no-repeat #ede9df;
      background-color:white;
  }
</style>


<div id="spinner"></div>

<script src="../assets/js/core/bootstrap.min.js"></script>

<script type="text/javascript">
  history.pushState(null,null,null);
  window.addEventListener('popstate',function(){
    history.pushState(null,null,null);
  });
</script>

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

<script type="text/javascript">
  MathJax.Hub.Config({
    tex2jax: {
           inlineMath: [ ['$','$'], ['\\(','\\)'] ]
    }
  });
</script>

<?php
  include_once('../includes/dbcon.php');
  // input values ----------------------------------------------------
  $cid      = $_COOKIE['user_id'];
  $uname    = $_COOKIE['user_name'];
  $examname = addslashes(htmlspecialchars($_GET['en'], ENT_QUOTES));
  $examid   = addslashes(htmlspecialchars($_GET['id'], ENT_QUOTES));
  $type     = addslashes(htmlspecialchars($_GET['type'], ENT_QUOTES));
  $stype    = addslashes(htmlspecialchars($_GET['stype'], ENT_QUOTES));
  $sid      = $cid;
  if ($type == "a512311409b3798234b19649fa105a27") {
                  $examtype = "practisetest";
  } elseif ($type = "c08beeed313883b21aadc5a8068f7ba5") {
                  $examtype = "originaltest";
  } else {
                  $examtype = "not defined";
  }

  $screentype = "";
  if ($stype == "ab233411eea3217f6a3179f0759d343d") {
                  $screentype = "nta";
  } else {
                  $screentype = "";
  }
  // validations ----------------------------------------------------
  if ($examname == "" || $examid == "" || $type == "" || $screentype == "") {
                  header('Location: ../');
                  exit();
  }
  if (isset($_SERVER['HTTP_REFERER'])) {
                  $page = basename($_SERVER['HTTP_REFERER']);
                  $page = substr($page, 0, 21);
                  if ($page == "chooseexam.php") {
                  } else {
                                  header('Location: ../');
                                  exit();
                  }
  } else {
                  header('Location: ../');
                  exit();
  }
  $sql    = "select * from questionpaper";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                                  if (md5($row['name']) == $examname) {
                                                  $examname1 = $row['name'];
                                  }
                  }
  } else {
                  exit();
  }
  $sql    = "select * from questionpaper";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                                  if (md5($row['qpid']) == $examid) {
                                                  $attempts = $row['noofattempts'];
                                  }
                  }
  }
  if ($attempts == "0") {
  } else {
                  $sql11    = "select * from results where examname='" . $examname1 . "' and cid='$cid'";
                  $result11 = $conn->query($sql11);
                  if ($result11->num_rows == "0") {
                  } else {
                                  $noo = $result11->num_rows;
                                  if ($noo >= $attempts) {
                                                  // echo "jatin";
                                                  header('Location: ../');
                                                  exit();
                                  } else {
                                  }
                  }
  }
  // update data ----------------------------------------------------
  $sql = "select * from settings limit 1";
  $rs1 = $conn->query($sql);
  if ($rs1->num_rows > 0) {
                  $settings = $rs1->fetch_assoc();
                  if ($settings['logs'] == "true") {
                                  date_default_timezone_set('Asia/Kolkata');
                                  $timestamp = date('Y/m/d h:i:s a', time());
                                  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                                  $IP = $_SERVER["HTTP_CLIENT_IP"];
                                  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                                  $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                  } else {
                                                  $IP = $_SERVER['REMOTE_ADDR'];
                                  }
                                  $mycomputername = gethostbyaddr($IP);
                                  $sql            = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Clicked Mock Test > Give Exam','$timestamp')";
                                  $conn->query($sql);
                  }
                  if ($settings['tracking'] == "true") {
                                  $sql = "update students set page='Exam Window' where sid='$sid'";
                                  $conn->query($sql);
                  }
  }

  // getvaluesfromdatabase ----------------------------------------------------
  $sql    = "select * from questionpaper";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                                  if (md5($row['name']) == $examname) {
                                                  $eid       = $row['qpid'];
                                                  $examname  = $row['name'];
                                                  $type      = $row['examtype'];
                                                  $tttime    = $row['time'];
                                                  $totaltime = $row['time'];
                                                  $noofparts = $row['noofparts'];
                                                  $qptype    = $row['qptype'];
                                                  $examtype  = $row['examtype'];
                                  }
                  }
  } else {
                  exit();
  }
  $mynewtime2    = "";
  $mynewtime1    = "";
  $mycurrenttime = "";
  $mynewtime1    = $tttime / 60;
  $mynewtime1    = floor($mynewtime1);
  if ($mynewtime1 < 10) {
                  $mynewtime1 = "0" . $mynewtime1;
  }
  $mynewtime2 = $tttime % 60;
  if ($mynewtime2 < 10) {
                  $mynewtime2 = "0" . $mynewtime2;
  }
  $mynewtime = $mynewtime1 . ":" . $mynewtime2 . ":" . "00";
  $sql       = "select * from questionentry where qpid=$eid";
  $result    = $conn->query($sql);
  if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
  } else {
                  exit();
  }
  $sql    = "select * from students where sid='$cid'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
                  $rowstudent = $result->fetch_assoc();
  } else {
                  exit();
  }
  $sql    = "select * from testcontinue where examname='$examname' and studentid='$cid' and examtype='$examtype' order by attid desc";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
                  $row           = $result->fetch_assoc();
                  $qindex        = $row['qindex'];
                  $mycurrenttime = $row['continuetime'];
                  $getanswer     = "true";
                  $mynewtime1    = $mycurrenttime / 60;
                  $mynewtime1    = floor($mynewtime1);
                  if ($mynewtime1 < 10) {
                                  $mynewtime1 = "0" . $mynewtime1;
                  }
                  $mynewtime2 = $mycurrenttime % 60;
                  if ($mynewtime2 < 10) {
                                  $mynewtime2 = "0" . $mynewtime2;
                  }
                  $mynewcurrenttime = $mynewtime1 . ":" . $mynewtime2 . ":" . "00";
  } else {
                  $sql = "select * from answers_new where examname='$examname' order by aid desc limit 1";
                  $rts = $conn->query($sql);
                  if ($rts->num_rows > 0) {
                                  $row    = $rts->fetch_assoc();
                                  $qindex = $row['qindex'] + 1;
                  } else {
                                  $qindex = "1";
                  }
                  $sql = "INSERT INTO testcontinue(attid,examid,examname,studentid,examtype,qindex,continuetime)VALUES(DEFAULT,'$eid','$examname','$cid','$examtype','$qindex','$tttime')";
                  $conn->query($sql);
                  $mycurrenttime = "";
                  $getanswer     = "false";
                  $sql = "INSERT INTO examattempted(attid,examid,examname,studentid,examtype,qindex)VALUES(DEFAULT,'$examid','$examname','$cid','$examtype','$qindex')";
				  $conn->query($sql);
  }
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="Quiz/img/favicon.html">
    <title>Macro Vision Academy | National Testing Agency (NTA)</title>
    <link href="./assets/Quiz/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/Quiz/css/custom.css" rel="stylesheet" />
    <link href="./assets/Quiz/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/Quiz/css/style.default.css" rel="stylesheet" />
    <style type="text/css">
        /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto; /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
    }

    .modal-contentnew {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
    </style>

    <script src="assets/Quiz/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/Quiz/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      function updatepage(){
          var mysid='<?php echo $cid; ?>';
          var page="Exam Window";
          var examname = '<?php echo $examname; ?>';
          $.ajax({
            type: 'post',
            url: 'ajax.php',
            data: "updatepagenew='true'&page='"+page+"'&examname='"+examname+"'&sid='"+mysid+"'",
            success: function(data) {
            }
          });
        }

         function mycheckactiveness(){
            var updatetime;
            $.ajax({
            type: 'post',
            url: 'ajax.php',
            data: "checkactiveness='true'",
            success: function(data) {
              if (data == "dead") {
                 $("#errorscreen").css("display", "block");
                 updatetime="false";
              }else{
                 $("#errorscreen").css("display", "none");
                 updatetime="true";
                 var currentexamid = "<?php echo $eid; ?>";
                 var currentexamtype = ($("#type").val());
                 var currentstudentid = ($("#cid").val());
                 var currentqindex = "<?php echo $qindex; ?>";
                 var currentexamname = "<?php echo $examname; ?>";
                 var currenttime = $("#rstime").html();

                 var vv1 = currenttime.substr(0, 2);
                 var vv2 = currenttime.substr(3, 2);
                 currenttime = vv1 * 60;
                 currenttime = (+currenttime) + (+vv2) + 1;

                 $.ajax({
                  type: 'post',
                  url: 'ajax.php',
                  data: "updatetime='true'&studentid='"+currentstudentid+"'&examname='"+currentexamname+"'&examid='"+currentexamid+"'&examtype='"+currentexamtype+"'&qindex='"+currentqindex+"'&continuetime='"+currenttime+"'",
                  success: function(data) {

                  }
                });
              }
            },error: function (jqXHR, exception) {
                $("#errorscreen").css("display", "block");
                updatetime = "false";
            }
          });
          if(updatetime == "true"){

          }
        }



        function getqindex(){
            var tno = $("#tno").val();
            var myexamname = ($("#examname").val());
            var myqindex = "";

            $.ajax({
                type: 'post',
                url: 'ajax.php',
                data: "generateqindex='true'&examname='"+myexamname+"'",
                success: function(data) {
                 $("#qindex").val(data);
                }
              });

        }


        function checkform()
        {
            var ti = $("#rstime").text();

            $("#textrstime").val(ti);

            mycheckactiveness();

            var myanswer = "";

            var tno = $("#tno").val();
            for(var jjt = 1;jjt<=tno; jjt++){
                var myoldnumber = jjt;

                if(myoldnumber <10){
                    var mynumber = "0" + myoldnumber;
                }else{
                    var mynumber = myoldnumber;
                }

                var rqid = ($("input[name='qid" + mynumber + "']").val());
                var rpartno = ($("input[name='partno" + mynumber + "']").val());
                var rlevel = ($("input[name='level" + mynumber + "']").val());
                var mycid = ($("#cid").val());
                var mycorrectanswer = ($("input[name='radiospage" + mynumber + "']:checked").val());
                if(mycorrectanswer=="undefined"){
                  myanswer = "";
                }else{
                  myanswer = mycorrectanswer;
                }
                var myexamname = ($("#examname").val());
                var myexamtype = ($("#type").val());
                var mytotaltime = ($("#totaltime").val());
                var studentname = ("<?php echo $uname; ?>");
                var myqindex = "1";

                // $.ajax({
                //     type: 'post',
                //     url: 'ajax.php',
                //     data: "submitmyanswer='true'&qid='"+rqid+"'&partno='"+rpartno+"'&level='"+rlevel+"'&cid='"+mycid+"'&myanswer='"+myanswer+"'&examname='"+myexamname+"'&examtype='"+myexamtype+"'&studentname='"+studentname+"'&myqindex='"+myqindex+"'",
                //     success: function(data) {
                //     }
                //   });
            }

            var myqindex = "1";
            var mytotaltime = ($("#totaltime").val());
            var studentname = ("<?php echo $uname; ?>");

            // $.ajax({
            //   type: 'post',
            //   url: 'ajax.php',
            //   data: "examsubmit='true'&cid='"+mycid+"'&examname='"+myexamname+"'&examtype='"+myexamtype+"'&myqindex='"+myqindex+"'&mytotaltime='"+mytotaltime+"'&studentname='"+studentname+"'",
            //   success: function(data) {
            //   }
            // });

            return true;
        }

        function formsubmit(){
            alert("form submitted!");
        }

        window.history.forward();
        function noBack()
        {
            window.history.forward();
        }

        function checkactiveness(){
          var updatetime;
            $.ajax({
            type: 'post',
            url: 'ajax.php',
            data: "checkactiveness='true'",
            success: function(data) {
              if (data == "dead") {
                 $("#errorscreen").css("display", "block");
                 updatetime="false";
              }else{
                 $("#errorscreen").css("display", "none");
                 updatetime="true";
                 var currentexamid = "<?php echo $eid; ?>";
                 var currentexamtype = ($("#type").val());
                 var currentstudentid = ($("#cid").val());
                 var currentqindex = "<?php echo $qindex; ?>";
                 var currentexamname = "<?php echo $examname; ?>";
                 var currenttime = $("#rstime").html();

                 var vv1 = currenttime.substr(0, 2);
                 var vv2 = currenttime.substr(3, 2);
                 currenttime = vv1 * 60;
                 currenttime = (+currenttime) + (+vv2) + 1;

                 $.ajax({
                  type: 'post',
                  url: 'ajax.php',
                  data: "updatetime='true'&studentid='"+currentstudentid+"'&examname='"+currentexamname+"'&examid='"+currentexamid+"'&examtype='"+currentexamtype+"'&qindex='"+currentqindex+"'&continuetime='"+currenttime+"'",
                  success: function(data) {

                  }
                });
              }
            },error: function (jqXHR, exception) {
                $("#errorscreen").css("display", "block");
                updatetime = "false";
            }
          });
          if(updatetime == "true"){

          }
        }

        setInterval(function() {
          checkactiveness();
          updatepage();
        }, 3000);

        $(document).ready(function() {
          $("#allpagefirst").show();
          $("#allpagesecond").hide();
          $("#allpagethird").hide();
          $("#allpagefourth").hide();
        });

        function submitfirstpage(){
          $("#allpagefirst").hide();
          $("#allpagesecond").show();
        }
        function submitsecondpage(){
          $("#allpagesecond").hide();
          $("#allpagethird").show();
        }

        function validatemyform(){
          if($("#en_ch").is(':checked')){
              $("#allpagethird").hide();
              $("#allpagefourth").show();
              CoundownTimer(parseInt($("#hdfTestDuration").val()));
          } else {
              alert("Please accept terms and conditions before proceeding.");
              return false;
          }
        }

        function disableme(){
          $('#finalsubmit').css("pointer-events","none");
          $("#spinner").show();
        }


        function showinstructions(){
           $("#instructions").css("display", "block");
        }

        function closeinstructions(){
           $("#instructions").css("display", "none");
        }

        function showquestionpaper(){
          refreshquestionpaperpage();
           $("#questionpapermodal").css("display", "block");
        }

        function closequestionpaper(){
           $("#questionpapermodal").css("display", "none");
        }

        function refreshquestionpaperpage(){
            document.getElementById("qpaperiframe").src="myquestionpaper.php?cid=<?php echo $cid;?>&qindex=<?php echo $qindex;?>&examname=<?php echo $examname;?>";
          }

        function resizeIframe(obj) {
          obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
        }
    </script>

</head>
<body oncontextmenu="return false;" onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">

    <div id="errorscreen" style="position: fixed;z-index:1000;background-color:rgba(0,0,0,0.4);color:rgba(0,0,0,0.7);height:100%;width:100%;display:none;">
        <div class="modal-content">
            <h4><span style="color:red;">Error!!! </span>Your Internet Connection/Wifi is not Working!!!! Please Check it out <br> Do Not Refresh This Page else your all answers and results will be lost. <br>Do Not Click On Submit Button it will erase your answers. <br>Try to Connect to Internet/Wifi</h4>
        </div>
    </div>

    <div id="instructions" style="position: fixed;z-index:500;background-color:rgba(0,0,0,0.4);color:rgba(0,0,0,0.7);height:100%;width:100%;display:none;">
        <div class="modal-contentnew" style="overflow-y:scroll;max-height:85%;">
          <div class="clear"></div>
          <div id="heading-breadcrumbs">
            <!-- <div class="container"> -->
                <div class="row">
                    <div class="col-md-12">
                      <div style="color: #FFF; padding: 10 10 10px 10;">
                        <h1 class="pull-left">General Instructions</h1>
                        <div class="pull-right" style="padding: 0">
                            <label style="color: #fff;"> Choose Your Default Language</label>
                            <select class="form-control" onChange="changeIndtruct(this.value)">
                                <option value="en">English</option>
                                <option value="hi" disabled="true">Hindi</option>
                                <option value="gj" disabled="true">Gujarati</option>
                            </select>
                        </div>
                      </div>
                    </div>
                </div>
            <!-- </div> -->
          </div>
          <div id="content">
            <!-- <div class="container"> -->
                <section>
                    <div class="row">
                        <div class="col-md-12 exam-confirm">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-md-12" id="en">
                                        <h4 class="text-center">Please read the instructions carefully</h4>
                                        <h4><strong><u>General Instructions:</u></strong></h4>
                                        <ol>
                                            <li>
                                                <ul>
                                                    <li>Total duration of JEE Main Paper- 1 &amp; JEE Main Paper- 2 is 180 min.</li>
                                                    <li>JEE Paper- 2 is for Mathematics, Aptitude Test & Drawing. The Drawing test is required to be done on separate drawing sheet, which is not part of the current mock test.</li>
                                                </ul>
                                            </li>
                                            <li>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</li>
                                            <li>
                                                The Questions Palette displayed on the right side of screen will show the status of each question using one of the following symbols:
                                                <ol>
                                                    <li><img src="./assets/quiz/img/QuizIcons/Logo1.png" /> You have not visited the question yet.<br /><br /></li>
                                                    <li><img src="./assets/quiz/img/QuizIcons/Logo2.png" /> You have not answered the question.<br /><br /></li>
                                                    <li><img src="./assets/quiz/img/QuizIcons/Logo3.png" /> You have answered the question.<br /><br /></li>
                                                    <li><img src="./assets/quiz/img/QuizIcons/Logo4.png" /> You have NOT answered the question, but have marked the question for review.<br /><br /></li>
                                                    <li><img src="./assets/quiz/img/QuizIcons/Logo5.png" /> The question(s) "Answered and Marked for Review" will be considered for evalution.<br /><br /></li>
                                                </ol>
                                            </li>
                                            <li>You can click on the "&gt;" arrow which apperes to the left of question palette to collapse the question palette thereby maximizing the question window. To view the question palette again, you can click on "&lt;" which appears on the right side of question window.</li>
                                            <li>You can click on your "Profile" image on top right corner of your screen to change the language during the exam for entire question paper. On clicking of Profile image you will get a drop-down to change the question content to the desired language.</li>
                                            <li>You can click on <img src="./assets/quiz/img/QuizIcons/down.png" /> to navigate to the bottom and <img src="./assets/quiz/img/QuizIcons/up.png" /> to navigate to top of the question are, without scrolling.</li>
                                        </ol>
                                        <h4><strong><u>Navigating to a Question:</u></strong></h4>
                                        <ol start="7">
                                            <li>
                                                To answer a question, do the following:
                                                <ol type="a">
                                                    <li>Click on the question number in the Question Palette at the right of your screen to go to that numbered question directly. Note that using this option does NOT save your answer to the current question.</li>
                                                    <li>Click on <strong>Save & Next</strong> to save your answer for the current question and then go to the next question.</li>
                                                    <li>Click on <strong>Mark for Review & Next</strong> to save your answer for the current question, mark it for review, and then go to the next question.</li>
                                                </ol>
                                            </li>
                                        </ol>
                                        <h4><strong><u>Answering a Question:</u></strong></h4>
                                        <ol start="8">
                                            <li>
                                                Procedure for answering a multiple choice type question:
                                                <ol type="a">
                                                    <li>To select you answer, click on the button of one of the options.</li>
                                                    <li>To deselect your chosen answer, click on the button of the chosen option again or click on the <strong>Clear Response</strong> button</li>
                                                    <li>To change your chosen answer, click on the button of another option</li>
                                                    <li>To save your answer, you MUST click on the Save & Next button.</li>
                                                    <li>To mark the question for review, click on the Mark for Review & Next button.</li>
                                                </ol>
                                            </li>
                                            <li>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</li>
                                        </ol>
                                        <h4><strong><u>Navigating through sections:</u></strong></h4>
                                        <ol start="10">
                                            <li>Sections in this question paper are displayed on the top bar of the screen. Questions in a section can be viewed by click on the section name. The section you are currently viewing is highlighted.</li>
                                            <li>After click the Save & Next button on the last question for a section, you will automatically be taken to the first question of the next section.</li>
                                            <li>You can shuffle between sections and questions anything during the examination as per your convenience only during the time stipulated.</li>
                                            <li>Candidate can view the corresponding section summery as part of the legend that appears in every section above the question palette.</li>
                                        </ol>
                                        <hr>
                                        <span class="text-danger">Please note all questions will appear in your default language. This language can be changed for a particular question later on.</span>
                                        <hr>
                                        <div class="col-md-4 col-md-offset-4 text-center">
                                            <input type="button" style="color:white;" onclick="closeinstructions();" class="btn btn-primary btn-block" value="Close">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <!-- </div> -->
          </div>
        </div>
    </div>

    <div id="questionpapermodal" style="overflow-y:scroll;position: fixed;z-index:500;background-color:rgba(0,0,0,0.4);color:rgba(0,0,0,0.7);height:100%;width:100%;display:none;">
      <div class="modal-contentnew" style="">
          <div class="clear"></div>
          <div id="heading-breadcrumbs">
            <!-- <div class="container"> -->
                <div class="row">
                    <div class="col-md-12">
                      <div style="color: #FFF; padding: 10 10 10px 10;">
                        <h1 class="pull-left">Question Paper</h1>
                        <div class="pull-right" style="padding: 0">
                            <label style="color: #fff;"> Choose Your Default Language</label>
                            <select class="form-control" onChange="changeIndtruct(this.value)">
                                <option value="en">English</option>
                                <option value="hi" disabled="true">Hindi</option>
                                <option value="gj" disabled="true">Gujarati</option>
                            </select>
                        </div>
                      </div>
                    </div>
                </div>
            <!-- </div> -->
          </div>
          <div id="content">
            <!-- <div class="container"> -->
                <section>
                    <div class="row">
                        <div class="col-md-12 exam-confirm">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-md-12" id="en">
                                      <a onclick="refreshquestionpaperpage()" style="float:right" class="btn btn-info">Refresh Page</a>
                                      <input type="button" style="color:white;width:100%;" onclick="closequestionpaper();" class="btn btn-primary btn-block" value="Close">
                                      <hr>
                                      <iframe id="qpaperiframe" src="myquestionpaper.php?cid=<?php echo $cid;?>&qindex=<?php echo $qindex;?>&examname=<?php echo $examname;?>" style="width:100%;border:0px;height:500px;max-height:1000px;overflow-y:scroll;"></iframe>
                                     <hr>
                                     <input type="button" style="color:white;" onclick="closequestionpaper();" class="btn btn-primary btn-block" value="Close">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <!-- </div> -->
          </div>
      </div>
    </div>

    <div id="allpagefirst" style="display:none;">
      <header class="main-header">
        <div class="navbar" data-spy="affix" data-offset-top="200">
            <div class="navbar navbar-default yamm" role="navigation" id="navbar">
                <!-- <div class="container"> -->
                    <div class="navbar-header">
                        <a class="navbar-brand home">
                            <img src="assets/Quiz/img/logo.png" alt="NTA logo" class="img-responsive">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse ">
                        <ul class="nav navbar-nav pull-right exam-paper ">
                            <li class="user-profile">
                            </li>
                        </ul>
                    </div>
                <!-- </div> -->
            </div>
        </div>
      </header>
      <div class="clear"></div>
      <div id="heading-breadcrumbs">
        <!-- <div class="container"> -->
            <div class="row">
                <div class="col-md-12">
                  <div style="padding: 10 10 10px 10;">
                    <h1>Selection Of Examination</h1>
                  </div>
                </div>
            </div>
        <!-- </div> -->
      </div>
      <div class="home-carousel">
        <div class="area-bg">
            <div id="content">
                <!-- <div class="container"> -->
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="box-part">
                                <div class="">
                                    <div class="form-group">
                                        <label class="pull-left">Select exam you would like to appear</label>
                                        <select id="drpNatureofExam" required="" class="form-control">
                                            <option value="JEE"><?php echo $qptype; ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="divJEE">
                                        <label class="pull-left">Paper</label>
                                        <select id="drpPastPaper_jee" required="" class="form-control">
                                            <option value="Paper1">Paper</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                      <input type="button" onclick="submitfirstpage();" value="Start Mock Test" class="btn btn-primary btn-block" style="color:white;">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-12 text-center text-primary">
                            <p style="font-size: 22px;">Welcome to <span style="font-weight: bold; color: #f7931e">MVA Examination Portal</span>, Test practice Centre</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-md-12 text-justify text-primary">
                            <h4 style="color:#fff">Note for UGC NET Paper 2 :</h4>
                            <p style="text-transform:none; font-weight:normal;">This Mock Test is to familiarize the students about processes of Computer Based Test (CBT) for which UGC NET Paper-2 is currently available in “Commerce” subject only. For other subjects, it will be made available shortly. However any candidate can understand various processes of Computer Based Test (CBT) with the available mock test.</p>
                        </div>
                    </div>
                    <br>
                <!-- </div> -->
            </div>
        </div>
      </div>
      <div id="copyright">
        <div class="container">
            <div class="col-md-12">
                <p class="text-center">&copy; 2018 Macro Vision Academy, Developed By "Digi MVA" Group</p>
            </div>
        </div>
      </div>
    </div>

    <div id="allpagesecond" style="display:none;">
      <header class="main-header">
        <div class="navbar" data-spy="affix" data-offset-top="200">
            <div class="navbar navbar-default yamm" role="navigation" id="navbar">
                <!-- <div class="container"> -->
                    <div class="navbar-header">
                        <a class="navbar-brand home">
                            <img src="./assets/Quiz/img/logo.png" alt="NTA logo" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-md-5 pull-right">
                        <div class="navbar-collapse">
                            <ul class="nav navbar-nav pull-right exam-paper ">
                                <li class="user-profile">
                                    <table>
                                        <tr>
                                            <td style="padding: 2px; border: 2px solid #666">
                                              <?php 
                                              $imgsrc = $rowstudent['imgsrc'];
                                              $imglink = "../admin/profile/".md5($imgsrc)."jt". md5($imgsrc).".jpg";

                                              if (file_exists($imglink)){
                                               ?>
                                                <img style="padding:0px;margin:0px;width:60px;height:70px;" src="<?php echo $imglink; ?>">
                                              <?php 
                                                }else{
                                                  ?>
                                                <img style="padding:0px;margin:0px;width:60px;height:70px;" src="../assets/img/default-avatar.png">
                                                  <?php
                                                }
                                              ?>
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style="padding: 5px 5px;">Candidate Name</td>
                                                        <td> : <span style="color: #f7931e; font-weight: bold"><?php echo $rowstudent['name']; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 5px 5px;">Subject Name</td>
                                                        <td> : <span style="color: #f7931e; font-weight: bold"><?php echo $examname; ?></span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
      </header>
      <div class="clear"></div>
      <div id="heading-breadcrumbs">
        <!-- <div class="container"> -->
            <div class="row">
                <div class="col-md-12">
                    <div style="color: #FFF; padding: 10 10 10px 10;">
                        <div style="font-size: 22px;">System Name : <?php echo $rowstudent['name']; ?></div>
                        <div>Contact Invigilator if the Name and Photograph displayed on the screen is not yours</div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
        <div class="home-carousel">
            <div class="area-bg">
                <div id="content">
                    <!-- <div class="container"> -->
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                 <div class="box-part">
                                    <h4>Login</h4>
                                    <hr>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input id="txtUsername" placeholder="xxxx@xxxxx.com" value="<?php echo $rowstudent['username']; ?>"" type="text" class="form-control" disabled="true" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input id="txtPassword" placeholder="**********" type="password" value="<?php echo $rowstudent['password']; ?>" class="form-control" disabled="true" />
                                    </div>
                                    <div class="form-group">
                                        <input type="button" onclick="submitsecondpage()" class="btn btn-primary btn-block btn-lg" style="color:white;" value="Login">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <div id="copyright">
            <div class="container">
                <div class="col-md-12">
                    <p class="text-center">&copy; 2018 Macro Vision Academy, Developed By "Digi MVA" Group</p>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div id="allpagethird" style="display:none;">
        <header class="main-header">
          <div class="navbar" data-spy="affix" data-offset-top="200">
              <div class="navbar navbar-default yamm" role="navigation" id="navbar">
                  <!-- <div class="container"> -->
                      <div class="navbar-header">
                          <a class="navbar-brand home">
                              <img src="./assets/Quiz/img/logo.png" alt="NTA logo" class="img-responsive">
                          </a>
                      </div>
                      <div class="navbar-collapse collapse ">
                          <ul class="nav navbar-nav pull-right exam-paper ">
                              <li class="user-profile">
                              </li>
                          </ul>
                      </div>
                  <!-- </div> -->
              </div>
          </div>
        </header>
        <div class="clear"></div>
        <div id="heading-breadcrumbs">
          <!-- <div class="container"> -->
              <div class="row">
                  <div class="col-md-12">
                    <div style="color: #FFF; padding: 10 10 10px 10;">
                      <h1 class="pull-left">General Instructions</h1>
                      <div class="pull-right" style="padding: 0">
                          <label style="color: #fff;"> Choose Your Default Language</label>
                          <select class="form-control" onChange="changeIndtruct(this.value)">
                              <option value="en">English</option>
                              <option value="hi" disabled="true">Hindi</option>
                              <option value="gj" disabled="true">Gujarati</option>
                          </select>
                      </div>
                    </div>
                  </div>
              </div>
          <!-- </div> -->
        </div>
        <div id="content">
          <!-- <div class="container"> -->
              <section>
                  <div class="row">
                      <div class="col-md-12 exam-confirm">
                          <div class="panel panel-default">
                              <div class="panel-body">
                                  <div class="col-md-12" id="en">
                                      <h4 class="text-center">Please read the instructions carefully</h4>
                                      <h4><strong><u>General Instructions:</u></strong></h4>
                                      <ol>
                                          <li>
                                              <ul>
                                                  <li>Total duration of JEE Main Paper- 1 &amp; JEE Main Paper- 2 is 180 min.</li>
                                                  <li>JEE Paper- 2 is for Mathematics, Aptitude Test & Drawing. The Drawing test is required to be done on separate drawing sheet, which is not part of the current mock test.</li>
                                              </ul>
                                          </li>
                                          <li>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</li>
                                          <li>
                                              The Questions Palette displayed on the right side of screen will show the status of each question using one of the following symbols:
                                              <ol>
                                                  <li><img src="./assets/quiz/img/QuizIcons/Logo1.png" /> You have not visited the question yet.<br /><br /></li>
                                                  <li><img src="./assets/quiz/img/QuizIcons/Logo2.png" /> You have not answered the question.<br /><br /></li>
                                                  <li><img src="./assets/quiz/img/QuizIcons/Logo3.png" /> You have answered the question.<br /><br /></li>
                                                  <li><img src="./assets/quiz/img/QuizIcons/Logo4.png" /> You have NOT answered the question, but have marked the question for review.<br /><br /></li>
                                                  <li><img src="./assets/quiz/img/QuizIcons/Logo5.png" /> The question(s) "Answered and Marked for Review" will be considered for evalution.<br /><br /></li>
                                              </ol>
                                          </li>
                                          <li>You can click on the "&gt;" arrow which apperes to the left of question palette to collapse the question palette thereby maximizing the question window. To view the question palette again, you can click on "&lt;" which appears on the right side of question window.</li>
                                          <li>You can click on your "Profile" image on top right corner of your screen to change the language during the exam for entire question paper. On clicking of Profile image you will get a drop-down to change the question content to the desired language.</li>
                                          <li>You can click on <img src="./assets/quiz/img/QuizIcons/down.png" /> to navigate to the bottom and <img src="./assets/quiz/img/QuizIcons/up.png" /> to navigate to top of the question are, without scrolling.</li>
                                      </ol>
                                      <h4><strong><u>Navigating to a Question:</u></strong></h4>
                                      <ol start="7">
                                          <li>
                                              To answer a question, do the following:
                                              <ol type="a">
                                                  <li>Click on the question number in the Question Palette at the right of your screen to go to that numbered question directly. Note that using this option does NOT save your answer to the current question.</li>
                                                  <li>Click on <strong>Save & Next</strong> to save your answer for the current question and then go to the next question.</li>
                                                  <li>Click on <strong>Mark for Review & Next</strong> to save your answer for the current question, mark it for review, and then go to the next question.</li>
                                              </ol>
                                          </li>
                                      </ol>
                                      <h4><strong><u>Answering a Question:</u></strong></h4>
                                      <ol start="8">
                                          <li>
                                              Procedure for answering a multiple choice type question:
                                              <ol type="a">
                                                  <li>To select you answer, click on the button of one of the options.</li>
                                                  <li>To deselect your chosen answer, click on the button of the chosen option again or click on the <strong>Clear Response</strong> button</li>
                                                  <li>To change your chosen answer, click on the button of another option</li>
                                                  <li>To save your answer, you MUST click on the Save & Next button.</li>
                                                  <li>To mark the question for review, click on the Mark for Review & Next button.</li>
                                              </ol>
                                          </li>
                                          <li>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</li>
                                      </ol>
                                      <h4><strong><u>Navigating through sections:</u></strong></h4>
                                      <ol start="10">
                                          <li>Sections in this question paper are displayed on the top bar of the screen. Questions in a section can be viewed by click on the section name. The section you are currently viewing is highlighted.</li>
                                          <li>After click the Save & Next button on the last question for a section, you will automatically be taken to the first question of the next section.</li>
                                          <li>You can shuffle between sections and questions anything during the examination as per your convenience only during the time stipulated.</li>
                                          <li>Candidate can view the corresponding section summery as part of the legend that appears in every section above the question palette.</li>
                                      </ol>
                                      <hr>
                                      <span class="text-danger">Please note all questions will appear in your default language. This language can be changed for a particular question later on.</span>
                                      <hr>
                                      <label>
                                          <input type="checkbox" id="en_ch">&nbsp;&nbsp;I have read and understood the instructions. All computer hardware allotted to me are in proper working condition. I declare  that I am not in possession of / not wearing / not  carrying any prohibited gadget like mobile phone, bluetooth  devices  etc. /any prohibited material with me into the Examination Hall.I agree that in case of not adhering to the instructions, I shall be liable to be debarred from this Test and/or to disciplinary action, which may include ban from future Tests / Examinations
                                      </label>
                                      <hr>
                                      <div class="col-md-4 col-md-offset-4 text-center">
                                          <input type="button" style="color:white;" onclick="validatemyform();" class="btn btn-primary btn-block" value="Proceed">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
          <!-- </div> -->
        </div>
        <div id="copyright">
          <div class="container">
              <div class="col-md-12">
                  <p class="text-center">&copy; 2018 Macro Vision Academy, Developed By "Digi MVA" Group</p>
              </div>
          </div>
        </div>
    </div>

    <div id="allpagefourth" style="display:none;">
      <form action="exam_submit.php" onSubmit="return checkform();"  id="myexamform" method="post">
        <input type="hidden" id="qindex" name="qindex" value="<?php echo $qindex; ?>">
        <input type="hidden" id="hdfBaseURL" value="/" />
        <div id="all">
          <header class="main-header">
            <div class="navbar" data-spy="affix" data-offset-top="200">
                <div class="navbar navbar-default yamm" role="navigation" id="navbar">
                    <!-- <div class="container"> -->
                        <div class="navbar-header">
                            <a class="navbar-brand home">
                                <img src="./assets/Quiz/img/logo.png" alt="NTA logo" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-md-5 pull-right">
                            <div class="navbar-collapse">
                                <ul class="nav navbar-nav pull-right">
                                    <li class="user-profile">
                                        <table>
                                            <tr>
                                                <td style="padding: 2px; border: 2px solid #666"><?php 
                                              $imgsrc = $rowstudent['imgsrc'];
                                              $imglink = "../admin/profile/".md5($imgsrc)."jt". md5($imgsrc).".jpg";

                                              if (file_exists($imglink)){
                                               ?>
                                                <img style="padding:0px;margin:0px;width:60px;height:70px;" src="<?php echo $imglink; ?>">
                                              <?php 
                                                }else{
                                                  ?>
                                                <img style="padding:0px;margin:0px;width:60px;height:70px;" src="../assets/img/default-avatar.png">
                                                  <?php
                                                }
                                              ?></td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td style="padding: 0px 5px;">Candidate Name</td>
                                                            <td> : <span style="color: #f7931e; font-weight: bold"><?php echo strtoupper($rowstudent['name']); ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0px 5px;">Exam Name</td>
                                                            <td> : <span style="color: #f7931e; font-weight: bold"><?php echo $examname; ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0px 5px;">Remaining Time</td>
                                                            <td>
                                                                : <span class="timer-title time-started" id="rstime"><?php if($getanswer == "true"){echo $mynewcurrenttime;}else{echo $mynewtime;} ?></span>
                                                                <input type="hidden" name="mytime" id="mytime">
                                                                <input type="hidden" name="timeleft" id="textrstime">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
          </header>
          <div class="clear"></div>
          <?php
            if($getanswer=="true"){
              echo '<input type="hidden" id="hdfTestDuration" value="'.$mycurrenttime.'" />';
            }else{
              echo '<input type="hidden" id="hdfTestDuration" value="'.$tttime.'" />';
            }
           ?>

          <div>
            <div id="heading-breadcrumbs">
              <!-- <div class="container"> -->
                <div class="row" style="margin-left:0px;margin-right:0px;">
                  <div class="col-md-7 pull-left">
                    <div style="padding: 10 10 10px 10;">
                    <table class="stream">
                      <tr class="full-width">
                        <td class="full-width"></td>
                        <?php
                          $mysql = "select * from questionpaper where qpid='$eid'";
                          $myresult = $conn->query($mysql);
                          if($myresult->num_rows > 0){
                            $jjkk = 0;
                            $newjjkk = 0;
                            $nooftimes = 0;
                            $myrow = $myresult->fetch_assoc();
                            for ($mypart=1; $mypart <= $noofparts ; $mypart++) {
                                $currentpartname = $myrow['part'.$mypart.'name'];
                                $partnoofque = $myrow['part'.$mypart.'noofque'];
                                $nooftimes = $nooftimes + 1;
                                if($nooftimes=="1"){
                                    $newjjkk = "01";
                                }else{
                                    $jjkk=$jjkk + $previouspartquestions;
                                    if($jjkk<10){
                                        $jjkk = $jjkk + 1;
                                        $newjjkk="0".$jjkk;
                                    }else{
                                        $newjjkk=$jjkk+1;
                                    }
                                }
                                $previouspartquestions = $partnoofque;
                                echo '<td class="full-width"><a class="mb5 btn btn-primary stream_1 full-width" href="javascript:void(0);" data-href="page'.$newjjkk.'">'.$currentpartname.'</a><div class="clear-xs"></div></td>';
                            }
                          }
                        ?>
                      </tr>
                    </table>
                    </div>
                  </div>
                  <div class="clear-xs "></div>
                  <div class="col-md-4 text-right">
                      <div style="padding: 15px 0 0 0">
                          <a class="btn btn-primary btn-sm" onclick="showquestionpaper();"><i class="fa fa-th-list"></i> Que. Paper</a>
                          <a class="btn btn-primary btn-sm" onclick="showinstructions();"><i class="fa fa-list-ol"></i>Instructions</a>
                      </div>
                  </div>
                  <div class="clear-xs"></div>
                <!-- </div> -->
              </div>
            </div>
          </div>

          <div id="content">
              <div class="container" style="margin-right:7px;width:100%;height:50vh;">
                  <div class="row exam-paper">
                      <div class="col-md-10" id="quest" style="padding: 0">
                          <table style="width: 100%">
                              <tr>
                                  <td>
                                      <div class="panel panel-default">
                                          <div class="panel-body mb0">
                                              <div class="row">
                                              <div class="col-lg-12">
                                              <?php
                                              $no = 0;
                                              if($getanswer == "true"){
                                                $sql1= "select * from questionpaper where name='$examname'";
                                                $result1=$conn->query($sql1);
                                                if($result1->num_rows > 0){
                                                  $row1=$result1->fetch_assoc();
                                                  $srnotype = $row1['srnotype'];
                                                }

                                                $sql1= "select * from answers_new where examname='$examname' and qindex='$qindex' and cid='$cid' order by aid";
                                                $result1=$conn->query($sql1);
                                                while($row1=$result1->fetch_assoc()){
                                                  $myqid = $row1['qid'];
                                                  $sql2 = "select * from questionentry where qid='$myqid'";
                                                  $result2=$conn->query($sql2);
                                                  if($result2->num_rows > 0){
                                                    $row2=$result2->fetch_assoc();
                                                    $no = $no+1;
                                                    ?>
                                                    <div style="<?php if($no != "1"){echo "display:none;";} ?>height:60vh;" class="tab-content div-question mb0" id="page<?php if($no<=9){echo "0";}echo $no; ?>">
                                                        <input type="hidden" value="1" class="hdfQuestionID">
                                                        <input type="hidden" value="1" class="hdfPaperSetID">
                                                        <input type="hidden" value="4" class="hdfCurrectAns">
                                                        <div class="question-height" style="height:55vh;">
                                                            <input type="hidden" name="clickstatus<?php if($no<=9){echo "0";}echo $no; ?>" id="clickstatus<?php echo $no; ?>" value="<?php echo $row1['clickstatus']; ?>">
                                                            <input type="hidden" name="qid<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>" value="<?php echo $row2['qid']; ?>">
                                                            <input type="hidden" name="qidpage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>" value="<?php echo $row2['qid']; ?>">
                                                            <?php $qid = $row2['qid']; ?>
                                                            <input type="hidden" name="partno<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>" value="<?php echo $row2['part']; ?>">
                                                            <?php $partno = $row2['part']; ?>
                                                            <input type="hidden" name="level<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>" value="<?php echo $row2['level']; ?>">
                                                            <?php
                                                              $levelstatus = $row2['level'];
                                                              $originalcorrectoption = $row2['correctoption'];
                                                            ?>

                                                            <h4 class="question-title"> Question <?php echo $no; ?>: <img src="./assets/quiz/img/QuizIcons/down.png" class="btndown pull-right"> </h4>
                                                            <?php
                                                            if($row2['question']!= ""){
                                                                echo $row2['question'];
                                                                echo "<br>";
                                                            }

                                                            if($row2['imgid']!=""){?>
                                                                <img alt="Question" src="../admin/uploads/questions/<?php echo md5($row2['imgid']); ?>.jpg" class="img-responsive"><br>
                                                                <input type="hidden" name="imgid" value="<?php echo md5($row2['imgid']); ?>.jpg">
                                                                <?php
                                                            }
                                                             ?>


                                                            <?php
                                                            if($row2['option1']!= "" && $row2['opt1img']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(A) ";
                                                                }else{
                                                                  echo "<br>(1) ";
                                                                } 
                                                                echo $row2['option1'];
                                                                ?>
                                                                <br>
                                                                <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                                                <?php
                                                            }elseif($row2['option1']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(A) ";
                                                                }else{
                                                                  echo "<br>(1) ";
                                                                } 
                                                                echo $row2['option1'];

                                                            }elseif($row2['opt1img']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(A) ";
                                                                }else{
                                                                  echo "<br>(1) ";
                                                                } 
                                                                ?>
                                                                <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                                                <?php
                                                            }

                                                            if($row2['option2']!= "" && $row2['opt2img']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(B) ";
                                                                }else{
                                                                  echo "<br>(2) ";
                                                                } 
                                                                echo $row2['option2'];
                                                                ?>
                                                                <br>
                                                                <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                                                <?php
                                                            }elseif($row2['option2']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(B) ";
                                                                }else{
                                                                  echo "<br>(2) ";
                                                                } 
                                                                echo $row2['option2'];
                                                                
                                                            }elseif($row2['opt2img']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(B) ";
                                                                }else{
                                                                  echo "<br>(2) ";
                                                                } 
                                                                ?>
                                                                <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                                                <?php
                                                            }

                                                            if($row2['option3']!= "" && $row2['opt3img']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(C) ";
                                                                }else{
                                                                  echo "<br>(3) ";
                                                                } 
                                                                echo $row2['option3'];
                                                                ?>
                                                                <br>
                                                                <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                                                <?php
                                                            }elseif($row2['option3']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(C) ";
                                                                }else{
                                                                  echo "<br>(3) ";
                                                                } 
                                                                echo $row2['option3'];
                                                                
                                                            }elseif($row2['opt3img']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(C) ";
                                                                }else{
                                                                  echo "<br>(3) ";
                                                                } 
                                                                ?>
                                                                <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                                                <?php
                                                            }

                                                            if($row2['option4']!= "" && $row2['opt4img']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(D) ";
                                                                }else{
                                                                  echo "<br>(4) ";
                                                                } 
                                                                echo $row2['option4'];
                                                                ?>
                                                                <br>
                                                                <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                                                <?php
                                                            }elseif($row2['option4']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(D) ";
                                                                }else{
                                                                  echo "<br>(4) ";
                                                                } 
                                                                echo $row2['option4'];
                                                                
                                                            }elseif($row2['opt4img']!= ""){
                                                                if($srno=="alphabets"){
                                                                  echo "<br>(D) ";
                                                                }else{
                                                                  echo "<br>(4) ";
                                                                } 
                                                                ?>
                                                                <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                                                <?php
                                                            }
                                                             ?>

                                                            <table class="table table-borderless mb0">
                                                                <tbody>
                                                                    <?php
                                                                        $sql = "select * from settings limit 1";
                                                                        $rs1=$conn->query($sql);
                                                                        if($rs1->num_rows > 0){
                                                                          $settings = $rs1->fetch_assoc();
                                                                        }

                                                                        if($srnotype=="alphabets"){
                                                                          if($row1['choosedoption']==""){
                                                                            ?>
                                                                            <tr>
                                                                              <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> A ) </td>
                                                                                <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> B ) </td>
                                                                                <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> C ) </td>
                                                                                <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> D ) </td>
                                                                              </tr>
                                                                            <?php
                                                                          }else{
                                                                           ?>
                                                                            <tr>
                                                                                <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="1"){echo 'checked';} ?>> A ) </td>
                                                                                <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="2"){echo 'checked';} ?>> B ) </td>
                                                                                <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="3"){echo 'checked';} ?>> C ) </td>
                                                                                <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="4"){echo 'checked';} ?>> D ) </td>
                                                                            </tr>
                                                                           <?php
                                                                          }
                                                                          ?>

                                                                          <?php
                                                                        }else{
                                                                          if($row1['choosedoption']==""){
                                                                            ?>
                                                                            <tr>
                                                                                <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 1 ) </td>
                                                                                <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 2 ) </td>
                                                                                <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 3 ) </td>
                                                                                <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 4 ) </td>
                                                                            </tr>
                                                                            <?php
                                                                          }else{
                                                                           ?>
                                                                             <tr>
                                                                                <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="1"){echo 'checked';} ?>> 1 ) </td>
                                                                                <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="2"){echo 'checked';} ?>> 2 ) </td>
                                                                                <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="3"){echo 'checked';} ?>> 3 ) </td>
                                                                                <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="4"){echo 'checked';} ?>> 4 ) </td>
                                                                            </tr>
                                                                          <?php
                                                                        }
                                                                      }
                                                                     ?>

                                                                </tbody>
                                                            </table>
                                                            <h4 class="question-footer"> <img src="./assets/quiz/img/QuizIcons/up.png" class="btnup pull-right"> </h4>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                  }
                                                }else{
                                                $sql1= "select * from questionpaper where name='$examname'";
                                                $result1=$conn->query($sql1);
                                                $no = 0;
                                                $op = 0;
                                                if($result1->num_rows > 0){
                                                  $row1=$result1->fetch_assoc();
                                                  $totalte = $row1['time'];
                                                  $shufflequestions = $row1['shufflequestions'];
                                                  $srnotype = $row1['srnotype'];
                                                  $part1noofque = $row1['part1noofque'];
                                                  $part2noofque = $row1['part2noofque'];
                                                  $part3noofque = $row1['part3noofque'];
                                                  $part4noofque = $row1['part4noofque'];
                                                  $part5noofque = $row1['part5noofque'];
                                                  $part6noofque = $row1['part6noofque'];
                                                  $part7noofque = $row1['part7noofque'];
                                                  $part8noofque = $row1['part8noofque'];
                                                  $part9noofque = $row1['part9noofque'];
                                                  $part10noofque = $row1['part10noofque'];

                                                  for ($i=1; $i <= $row1['noofparts']; $i++){
                                                  }
                                                }

                                                if($result1->num_rows > 0){
                                                  for($j=1;$j<$i;$j++){
                                                    if($shufflequestions=="yes"){
                                                      $sql2 = "select * from questionentry where qpname='$examname' and part='$j' order by RAND()";
                                                      if($j=="1"){
                                                      	$limitnoofque = $part1noofque;
                                                      }elseif($j=="1"){
                                                      	$limitnoofque = $part1noofque;
                                                      }elseif($j=="2"){
                                                      	$limitnoofque = $part2noofque;
                                                      }elseif($j=="3"){
                                                      	$limitnoofque = $part3noofque;
                                                      }elseif($j=="4"){
                                                      	$limitnoofque = $part4noofque;
                                                      }elseif($j=="5"){
                                                      	$limitnoofque = $part5noofque;
                                                      }elseif($j=="6"){
                                                      	$limitnoofque = $part6noofque;
                                                      }elseif($j=="7"){
                                                      	$limitnoofque = $part7noofque;
                                                      }elseif($j=="8"){
                                                      	$limitnoofque = $part8noofque;
                                                      }elseif($j=="9"){
                                                      	$limitnoofque = $part9noofque;
                                                      }elseif($j=="10"){
                                                      	$limitnoofque = $part10noofque;
                                                      }
                                                      $sql2 .= " LIMIT ".$limitnoofque;
                                                    }else{
                                                      $sql2 = "select * from questionentry where qpname='$examname' and part='$j' order by qid";
                                                      if($j=="1"){
                                                      	$limitnoofque = $part1noofque;
                                                      }elseif($j=="1"){
                                                      	$limitnoofque = $part1noofque;
                                                      }elseif($j=="2"){
                                                      	$limitnoofque = $part2noofque;
                                                      }elseif($j=="3"){
                                                      	$limitnoofque = $part3noofque;
                                                      }elseif($j=="4"){
                                                      	$limitnoofque = $part4noofque;
                                                      }elseif($j=="5"){
                                                      	$limitnoofque = $part5noofque;
                                                      }elseif($j=="6"){
                                                      	$limitnoofque = $part6noofque;
                                                      }elseif($j=="7"){
                                                      	$limitnoofque = $part7noofque;
                                                      }elseif($j=="8"){
                                                      	$limitnoofque = $part8noofque;
                                                      }elseif($j=="9"){
                                                      	$limitnoofque = $part9noofque;
                                                      }elseif($j=="10"){
                                                      	$limitnoofque = $part10noofque;	
                                                      }
                                                      $sql2 .= " LIMIT ".$limitnoofque;
                                                    }
                                                  $result2=$conn->query($sql2);
                                                  if($result2->num_rows > 0){
                                                    while($row2=$result2->fetch_assoc()){
                                                      $no = $no+1;

                                                    ?>
                                                      <div style="<?php if($no != "1"){echo "display:none;";} ?>height:60vh;" class="tab-content div-question mb0" id="page<?php if($no<=9){echo "0";}echo $no; ?>">
                                                          <input type="hidden" value="1" class="hdfQuestionID">
                                                          <input type="hidden" value="1" class="hdfPaperSetID">
                                                          <input type="hidden" value="4" class="hdfCurrectAns">
                                                          <div class="question-height" style="height:55vh;">
                                                              <input type="hidden" name="clickstatus<?php if($no<=9){echo "0";}echo $no; ?>" id="clickstatus<?php echo $no; ?>" value="">
                                                              <input type="hidden" name="qid<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>" value="<?php echo $row2['qid']; ?>">
                                                              <input type="hidden" name="qidpage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>" value="<?php echo $row2['qid']; ?>">
                                                              <?php $qid = $row2['qid']; ?>
                                                              <input type="hidden" name="partno<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>" value="<?php echo $row2['part']; ?>">
                                                              <?php $partno = $row2['part']; ?>
                                                              <input type="hidden" name="level<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>" value="<?php echo $row2['level']; ?>">
                                                              <?php
                                                                $levelstatus = $row2['level'];
                                                                $originalcorrectoption = $row2['correctoption'];
                                                              ?>

                                                              <h4 class="question-title"> Question <?php echo $no; ?>: <img src="./assets/quiz/img/QuizIcons/down.png" class="btndown pull-right"> </h4>
                                                              <?php
                                                              if($row2['question']!= ""){
                                                                  echo $row2['question'];
                                                                  echo "<br>";
                                                              }

                                                              if($row2['imgid']!=""){?>
                                                                  <img alt="Question" src="../admin/uploads/questions/<?php echo md5($row2['imgid']); ?>.jpg" class="img-responsive"><br>
                                                                  <input type="hidden" name="imgid" value="<?php echo md5($row2['imgid']); ?>.jpg">
                                                                  <?php
                                                              }
                                                               ?>


                                                              <?php
                                                              if($row2['option1']!= "" && $row2['opt1img']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(A) ";
                                                                  }else{
                                                                    echo "<br>(1) ";
                                                                  } 
                                                                  echo $row2['option1'];
                                                                  ?>
                                                                  <br>
                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                                                  <?php
                                                              }elseif($row2['option1']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(A) ";
                                                                  }else{
                                                                    echo "<br>(1) ";
                                                                  } 
                                                                  echo $row2['option1'];

                                                              }elseif($row2['opt1img']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(A) ";
                                                                  }else{
                                                                    echo "<br>(1) ";
                                                                  } 
                                                                  ?>
                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                                                  <?php
                                                              }

                                                              if($row2['option2']!= "" && $row2['opt2img']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(B) ";
                                                                  }else{
                                                                    echo "<br>(2) ";
                                                                  } 
                                                                  echo $row2['option2'];
                                                                  ?>
                                                                  <br>
                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                                                  <?php
                                                              }elseif($row2['option2']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(B) ";
                                                                  }else{
                                                                    echo "<br>(2) ";
                                                                  } 
                                                                  echo $row2['option2'];
                                                                  
                                                              }elseif($row2['opt2img']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(B) ";
                                                                  }else{
                                                                    echo "<br>(2) ";
                                                                  } 
                                                                  ?>
                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                                                  <?php
                                                              }

                                                              if($row2['option3']!= "" && $row2['opt3img']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(C) ";
                                                                  }else{
                                                                    echo "<br>(3) ";
                                                                  } 
                                                                  echo $row2['option3'];
                                                                  ?>
                                                                  <br>
                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                                                  <?php
                                                              }elseif($row2['option3']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(C) ";
                                                                  }else{
                                                                    echo "<br>(3) ";
                                                                  } 
                                                                  echo $row2['option3'];
                                                                  
                                                              }elseif($row2['opt3img']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(C) ";
                                                                  }else{
                                                                    echo "<br>(3) ";
                                                                  } 
                                                                  ?>
                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                                                  <?php
                                                              }

                                                              if($row2['option4']!= "" && $row2['opt4img']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(D) ";
                                                                  }else{
                                                                    echo "<br>(4) ";
                                                                  } 
                                                                  echo $row2['option4'];
                                                                  ?>
                                                                  <br>
                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                                                  <?php
                                                              }elseif($row2['option4']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(D) ";
                                                                  }else{
                                                                    echo "<br>(4) ";
                                                                  } 
                                                                  echo $row2['option4'];
                                                                  
                                                              }elseif($row2['opt4img']!= ""){
                                                                  if($srno=="alphabets"){
                                                                    echo "<br>(D) ";
                                                                  }else{
                                                                    echo "<br>(4) ";
                                                                  } 
                                                                  ?>
                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                                                  <?php
                                                              }

                                                               ?>

                                                              <table class="table table-borderless mb0">
                                                                  <tbody>
                                                                      <?php
                                                                          $sql = "select * from settings limit 1";
                                                                          $rs1=$conn->query($sql);
                                                                          if($rs1->num_rows > 0){
                                                                            $settings = $rs1->fetch_assoc();
                                                                          }

                                                                          if($srnotype=="alphabets"){
                                                                            ?>
                                                                              <tr>
                                                                                  <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> A ) </td>
                                                                                  <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> B ) </td>
                                                                                  <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> C ) </td>
                                                                                  <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> D ) </td>
                                                                              </tr>
                                                                            <?php
                                                                          }else{
                                                                            ?>
                                                                               <tr>
                                                                                  <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 1 ) </td>
                                                                                  <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 2 ) </td>
                                                                                  <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 3 ) </td>
                                                                                  <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 4 ) </td>
                                                                              </tr>
                                                                            <?php
                                                                          }

                                                                       ?>

                                                                  </tbody>
                                                              </table>
                                                              <h4 class="question-footer"> <img src="./assets/quiz/img/QuizIcons/up.png" class="btnup pull-right"> </h4>
                                                          </div>
                                                      </div>
                                                      <?php
                                                      $sqlttt = "select * from questionpaper where name='$examname'";
                                                      $resultttt = $conn->query($sqlttt);
                                                      if($resultttt->num_rows > 0){
                                                        $rowttt = $resultttt->fetch_assoc();
                                                        $attempts = $rowttt['noofattempts'];
                                                      }


                                                      if($attempts=="0"){
                                                        $sqljjt = "select * from answers_new where cid='$cid' and qid='$qid' and examname='$examname' and qindex='$qindex' and correctoption='$originalcorrectoption'";

                                                        $resultjjt = $conn->query($sqljjt);
                                                        if($resultjjt->num_rows > 0){

                                                        }else{
                                                          $sqljjrt  = "INSERT INTO answers_new(aid,correctoption,cid,qid,examname,qindex,part,studentname,level,status,examtype,choosedoption) VALUES (DEFAULT,'$originalcorrectoption','$cid','$qid','$examname','$qindex','$partno','$uname','$levelstatus','incorrect','$type','')";

                                                          $conn->query($sqljjrt);

                                                        }

                                                      }else{
                                                          $sqljjt = "select * from answers_new where cid='$cid' and qid='$qid' and examname='$examname' and correctoption='$originalcorrectoption'";


                                                          $resultjjt = $conn->query($sqljjt);
                                                          if($resultjjt->num_rows > 0){

                                                          }else{
                                                            $sqljjrt  = "INSERT INTO answers_new(aid,correctoption,cid,qid,examname,qindex,part,studentname,level,status,examtype,choosedoption) VALUES (DEFAULT,'$originalcorrectoption','$cid','$qid','$examname','$qindex','$partno','$uname','$levelstatus','incorrect','$type','')";

                                                            $conn->query($sqljjrt);

                                                            }
                                                      }

                                                    }
                                                  }
                                                  }
                                                }

                                              }
                                              ?>
                                                  </div>
                                              </div>
                                              <div class="clearfix"></div>
                                              <div class="row">
                                                  <div class="col-md-4">
                                                      <button class="mb5 full-width btn btn-success btn-block btn-save-answer">Save &amp; Next</button>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <button class="mb5 full-width btn btn-warning btn-block btn-save-mark-answer">Save &amp; Mark For Review</button>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <button class="mb5 full-width btn btn-default btn-block btn-reset-answer">Clear Response</button>
                                                  </div>
                                              </div>
                                              <br>
                                              <div class="row">
                                                  <div class="col-md-4">
                                                      <button class="mb5 full-width btn btn-primary btn-block btn-mark-answer">Mark For Review &amp; Next</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="panel-footer">
                                          <div class="row">
                                              <div class="col-md-12"> <button class="btn btn-success btn-submit-all-answers pull-right">Submit</button>&nbsp;&nbsp; <a href="javascript:void(0);" class="btn btn-default pull-left" id="btnPrevQue"> << Back </a>&nbsp;&nbsp; <a href="javascript:void(0);" class="btn btn-default pull-left" id="btnNextQue">Next >></a>&nbsp;&nbsp; </div>
                                          </div>
                                      </div>
                                  </td>
                                  <td>
                                      <div class="full_screen pull-right" style="cursor: pointer; background-color: #000; color: #fff; padding: 5px;">
                                          <i class="fa fa-angle-right fa-2x"></i>
                                      </div>
                                      <div class="collapse_screen hidden pull-right" style="cursor: pointer; background-color: #000; color: #fff; padding: 5px;">
                                          <i class="fa fa-angle-left fa-2x"></i>
                                      </div>
                                  </td>
                              </tr>
                          </table>
                      </div>
                      <div class="col-md-2" id="pallette">
                          <div class="panel panel-default mb0">
                              <div class="panel-body">
                                  <table class="table table-borderless mb0">
                                      <tr>
                                          <td class="full-width" style="font-size:12px;width:50%;"> <a class="test-ques-stats que-not-attempted lblNotVisited">0</a> Not Visited</td>
                                          <td class="full-width" style="font-size:12px;width:50%;"> <a class="test-ques-stats que-not-answered lblNotAttempted">0</a> Not Answered </td>
                                      </tr>
                                      <tr>
                                          <td class="full-width" style="font-size:12px;width:50%;"> <a class="test-ques-stats que-save lblTotalSaved">0</a> Answered </td>
                                          <td class="full-width" style="font-size:12px;width:50%;"> <a class="test-ques-stats que-mark lblTotalMarkForReview">0</a> Marked for Review </td>
                                      </tr>
                                      <tr>
                                          <td colspan="2" style="font-size:12px;width:100%;"> <a class="test-ques-stats que-save-mark lblTotalSaveMarkForReview">0</a> Answered &amp; Marked for Review (will be considered for evaluation) </td>
                                      </tr>
                                  </table>
                              </div>
                          </div>
                          <div class="panel panel-default ">
                              <div class="panel-body" style="height:60vh;overflow-y:scroll;">
                                  <ul class="pagination test-questions">
                                      <?php
                                        $mykk = 0;
                                        if($getanswer == "true"){
                                            $sql1= "select * from answers_new where examname='$examname' and qindex='$qindex' and cid='$cid' order by aid";
                                            $result1=$conn->query($sql1);
                                            while($row1=$result1->fetch_assoc()){
                                              $myclickstatus = $row1['clickstatus'];
                                              $mykk = $mykk + 1;
                                              if($mykk < 10){
                                                  $myno = "0".$mykk;
                                              }else{
                                                  $myno = $mykk;
                                              }
                                              if($myclickstatus=="save"){
                                                if($mykk == "1"){
                                                    echo '<li class="active" data-seq="1"><a class="test-ques que-save" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }else{
                                                    echo '<li data-seq="1"><a class="test-ques que-save" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }
                                              }else if($myclickstatus=="savemark"){
                                                if($mykk == "1"){
                                                  echo '<li class="active" data-seq="1"><a class="test-ques que-save-mark" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }else{
                                                  echo '<li data-seq="1"><a class="test-ques que-save-mark" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }
                                              }else if($myclickstatus=="attempted"){
                                                if($mykk == "1"){
                                                  echo '<li class="active" data-seq="1"><a class="test-ques que-not-answered" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }else{
                                                  echo '<li data-seq="1"><a class="test-ques que-not-answered" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }
                                              }else if($myclickstatus=="mark"){
                                                if($mykk == "1"){
                                                  echo '<li class="active" data-seq="1"><a class="test-ques que-mark" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }else{
                                                  echo '<li data-seq="1"><a class="test-ques que-mark" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }
                                              }else{
                                                if($mykk == "1"){
                                                  echo '<li class="active" data-seq="1"><a class="test-ques que-not-attempted" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }else{
                                                  echo '<li data-seq="1"><a class="test-ques que-not-attempted" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                                }
                                              }
                                            }
                                          }else{
                                            for ($kk=1; $kk <=$no ; $kk++) {
                                              if($kk == "1"){
                                                  if($kk < 10){
                                                      $mykk = "0".$kk;
                                                  }else{
                                                      $mykk = $kk;
                                                  }
                                                 echo '<li class="active" data-seq="1"><a class="test-ques que-not-attempted" href="javascript:void(0);" data-href="page'.$mykk.'">'.$mykk.'</a></li>';
                                              }else{
                                                  if($kk < 10){
                                                      $mykk = "0".$kk;
                                                  }else{
                                                      $mykk = $kk;
                                                  }
                                                 echo '<li data-seq="1"><a class="test-ques que-not-attempted" href="javascript:void(0);" data-href="page'.$mykk.'">'.$mykk.'</a></li>';
                                              }
                                            }
                                          }

                                       ?>
                                  </ul>
                              </div>
                          </div>

                      </div>
                  </div>

                  <input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>">
                  <input type="hidden" id="tno" name="tno" value="<?php echo $no; ?>">
                  <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">
                  <input type="hidden" id="examname" name="examname" value="<?php echo $examname; ?>">
                  <input type="hidden" id="totaltime" name="totaltime" value="<?php echo $totaltime; ?>">

                  <div class="row">
                      <div class="col-md-12 exam-summery" style="display:none;">
                          <div class="panel panel-default">
                              <div class="panel-body">
                                  <h3 class="text-center">Exam Summary</h3>
                                  <table class="table table-bordered table-condensed">
                                      <thead>
                                          <tr>
                                              <th>Section Name</th>
                                              <th>No of Questions</th>
                                              <th>Answered</th>
                                              <th>Not Answered</th>
                                              <th>Marked for Review</th>
                                              <th>Answered & Marked for Review(will be considered for evaluation)</th>
                                              <th>Not Visited</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td class="">Paper 1</td>
                                              <td class="lblTotalQuestion"></td>
                                              <td class="lblTotalSaved"></td>
                                              <td class="lblNotAttempted"></td>
                                              <td class="lblTotalMarkForReview"></td>
                                              <td class="lblTotalSaveMarkForReview"></td>
                                              <td class="lblNotVisited"></td>
                                          </tr>
                                      </tbody>
                                  </table>
                                  <hr />
                                  <div class="col-md-12 text-center">
                                      <h4> Are you sure you want to submit for final marking?<br />No changes will be allowed after submission. <br /> </h4>
                                      <a class="btn btn-default btn-lg" id="btnYesSubmit" value="Yes">Yes</a> <a class="btn btn-default btn-lg" id="btnNoSubmit">No</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 exam-confirm" style="display:none;">
                          <div class="panel panel-default">
                              <div class="panel-body">
                                  <div class="col-md-12 text-center">
                                      <h4> Thank You, your responses will be submitted for final marking - click OK to complete final submission. <br /> </h4>
                                      <input type="submit" onclick="disableme();" class="btn btn-default btn-lg" id="finalsubmit" Value="Ok"> <a class="btn btn-default btn-lg" id="btnNoSubmitConfirm">Cancel</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 exam-result" style="display:none;">
                          <div class="panel panel-default">
                              <div class="panel-body">
                                  <div class="col-md-12 text-center">
                                      <h3>
                                          Result
                                          <a id="btnRBack" class="btn btn-info pull-right">Back</a>
                                      </h3>
                                      <h5>Score: <strong id="lblRScore"></strong></h5>
                                      <table class="table table-bordered">
                                          <tbody>
                                              <tr>
                                                  <td>Total Question</td>
                                                  <th id="lblRTotalQuestion"></th>
                                                  <td>Total Attempted</td>
                                                  <th id="lblRTotalAttempted"></th>
                                              </tr>
                                              <tr>
                                                  <td>Correct Answers</td>
                                                  <th id="lblRTotalCorrect"></th>
                                                  <td>Incorrect Answers</td>
                                                  <th id="lblRTotalWrong"></th>
                                              </tr>
                                          </tbody>
                                      </table>
                                      <table class="table table-bordered">
                                          <thead>
                                              <tr>
                                                  <th>Question No.</th>
                                                  <th>selected Option</th>
                                                  <th>Status</th>
                                                  <th>Currect Option</th>
                                              </tr>
                                          </thead>
                                          <tbody id="tbodyResult"></tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </form>
    </div>


    <script type="text/javascript">
      var myInterval, AttemptedAns = [],TotalTime = 0;

      function NextQuestion(e) {
          var t = $(".test-questions").find("li.active");
          if (CheckNextPrevButtons(), t.is(":last-child")) return !1;
          $(".test-questions").find("li").removeClass("active"), t.next().addClass("active"), OpenCurrentQue(t.next().find("a")), e && (t.find("a").addClass("que-not-answered"), t.find("a").removeClass("que-not-attempted"));
          var a = t.attr("data-seq");
          $(".nav-tab-sections").find("li").removeClass("active"), $(".nav-tab-sections").find("li[data-id=" + a + "]").addClass("active"), CheckQueAttemptStatus()
      }

      function PrevQuestion(e) {
          var t = $(".test-questions").find("li.active");
          if (CheckNextPrevButtons(), t.is(":first-child")) return !1;
          $(".test-questions").find("li").removeClass("active"), t.prev().addClass("active"), OpenCurrentQue(t.prev().find("a"));
          var a = t.attr("data-seq");
          $(".nav-tab-sections").find("li").removeClass("active"), $(".nav-tab-sections").find("li[data-id=" + a + "]").addClass("active"), CheckQueAttemptStatus()
      }

      function CheckNextPrevButtons() {
          var e = $(".test-questions").find("li.active");
          $("#btnPrevQue").removeAttr("disabled"), $("#btnNextQue").removeAttr("disabled"), e.is(":first-child") ? $("#btnPrevQue").attr("disabled", "disabled") : e.is(":last-child") && $("#btnNextQue").attr("disabled", "disabled")
      }

      function pad(e, t) {
          for (var a = e + ""; a.length < t;) a = "0" + a;
          return a
      }

      function OpenCurrentQue(e) {
          $(".tab-content").hide(), $("#lblQueNumber").text(e.text()), $("#" + e.attr("data-href")).show();
          var t = e.parent().attr("data-seq");
          $(".nav-tab-sections").find("li").removeClass("active"), $(".nav-tab-sections").find("li[data-id=" + t + "]").addClass("active"), CheckQueAttemptStatus()
      }

      function CoundownTimer(e) {
          var t = 60 * e;
          myInterval = setInterval(function() {
              myTimeSpan = 1e3 * t, $(".timer-title").text(GetTime(myTimeSpan)), t < 600 ? ($(".timer-title").addClass("time-ending"), $(".timer-title").removeClass("time-started")) : ($(".timer-title").addClass("time-started"), $(".timer-title").removeClass("time-ending")), t > 0 ? t -= 1 : CleartTimer()

          }, 1e3)
      }

      function CleartTimer() {
          clearInterval(myInterval);
          $("title").text("Time Out");
          $("#myexamform").submit();
      }

      function GetTime(e) {
          parseInt(e % 1e3 / 100);
          var t = parseInt(e / 1e3 % 60),
              a = parseInt(e / 6e4 % 60),
              n = parseInt(e / 36e5 % 24);
          return (n = n < 10 ? "0" + n : n) + ":" + (a = a < 10 ? "0" + a : a) + ":" + (t < 10 ? "0" + t : t)
      }


      function pretty_time_string(e) {
          return (e < 10 ? "0" : "") + e
      }

      function CheckQueExists(e) {
          $.each(AttemptedAns, function(t, a) {
              void 0 !== a && a[1] == e && AttemptedAns.splice(t, 1)
          })
      }

      function CheckQueAttemptStatus() {
          var e = 0,
              t = 0,
              a = 0,
              n = 0,
              s = 0,
              i = 0;
          $(".test-questions").find("li").each(function() {
              var r = $(this);
              e += 1, r.children().hasClass("que-save") ? a += 1 : r.children().hasClass("que-save-mark") ? n += 1 : r.children().hasClass("que-mark") ? s += 1 : r.children().hasClass("que-not-answered") ? t += 1 : i += 1
          }), $(".lblTotalQuestion").text(e), $(".lblNotAttempted").text(t), $(".lblTotalSaved").text(a), $(".lblTotalSaveMarkForReview").text(n), $(".lblTotalMarkForReview").text(s), $(".lblNotVisited").text(i)
      }

      function CheckResult() {
          var n = 0
          $('#tbodyResult').html();
          var score = 0;
          var TotalQuestion = 0;
          var TotalAttempted = 0;
          var TotalCorrect = 0;
          var TotalWrong = 0;
          $(".test-questions").find("li").each(function() {
              var r = $(this);
              var a = r.find("a").attr("data-href");
              var currectAns = $("#" + a).find(".hdfCurrectAns").val();
              var currectQue = $("#" + a).find(".question-title").text();
              TotalQuestion = TotalQuestion + 1;
              var tr = $('<tr></tr>');
              tr.append('<td>' + currectQue + '</td>');
              var ansStatus = "Wrong";
              var selectedAns = '';
              if (r.children().hasClass("que-save") || r.children().hasClass("que-save-mark")) {
                  $("#" + a).find("input[name='radios" + a + "']").each(function() {
                      var e = $(this);
                      if (e.is(':checked')) {
                          selectedAns = e.val();
                          if (e.val() == currectAns) {
                              ansStatus = "Correct"
                          }
                      }
                  });
                  if (ansStatus == 'Correct') {
                      score = score + 4;
                      TotalCorrect = TotalCorrect + 1
                  } else {
                      score = score - 1;
                      TotalWrong = TotalWrong + 1
                  }
                  TotalAttempted = TotalAttempted + 1
              }
              if (r.children().hasClass("que-save") || r.children().hasClass("que-save-mark")) {
                  tr.append('<td>' + selectedAns + '</td>')
              } else {
                  tr.append('<td>---</td>')
              }
              if (r.children().hasClass("que-save") || r.children().hasClass("que-save-mark")) {
                  if (ansStatus == 'Correct') {
                      tr.append('<td><span class="label label-success">' + ansStatus + '</span></td>')
                  } else {
                      tr.append('<td><span class="label label-danger">' + ansStatus + '</span></td>')
                  }
              } else {
                  tr.append('<td>N/A</td>')
              }
              tr.append('<td>' + currectAns + '</td>');
              $('#tbodyResult').append(tr)
          });
          $('#lblRTotalQuestion').text(TotalQuestion);
          $('#lblRTotalAttempted').text(TotalAttempted);
          $('#lblRTotalCorrect').text(TotalCorrect);
          $('#lblRTotalWrong').text(TotalWrong);
          $('#lblRScore').text(score)
      }
      $(document).ready(function() {
          $("#page01").show();
          $(".exam-paper").show();
          CheckNextPrevButtons();
          CheckQueAttemptStatus();
          $("#btnPrevQue").click(function(e) {

              var t = $(".test-questions").find("li.active"),
                  a = t.find("a").attr("data-href");
              var myanswer = "";

              var myexamname = ($("#examname").val());
              var myexamtype = ($("#type").val());

              var rqid = ($("input[name='qid" + a + "']").val());
              var mycid = ($("#cid").val());
              var myqindex = "<?php echo $qindex; ?>";

              $.ajax({
                  type: 'post',
                  url: 'ajax.php',
                  data: "updateanswer1='true'&qid='"+rqid+"'&cid='"+mycid+"'&myanswer='"+myanswer+"'&examname='"+myexamname+"'&clickstatus='attempted'&examtype='"+myexamtype+"'&myqindex='"+myqindex+"'",
                  success: function(data) {
                  }
                });
              PrevQuestion(!0)
          });
          $("#btnNextQue").click(function(e) {

               var t = $(".test-questions").find("li.active"),
                  a = t.find("a").attr("data-href");
              var myanswer = "";

              var myexamname = ($("#examname").val());
              var myexamtype = ($("#type").val());

              var rqid = ($("input[name='qid" + a + "']").val());
              var mycid = ($("#cid").val());
              var myqindex = "<?php echo $qindex; ?>";

              $.ajax({
                  type: 'post',
                  url: 'ajax.php',
                  data: "updateanswer1='true'&qid='"+rqid+"'&cid='"+mycid+"'&myanswer='"+myanswer+"'&examname='"+myexamname+"'&clickstatus='attempted'&examtype='"+myexamtype+"'&myqindex='"+myqindex+"'",
                  success: function(data) {
                  }
                });
              NextQuestion(!0)
          });
          $(".test-ques").click(function(e) {
              var e = $(".test-questions").find("li.active").find("a");
              $(".test-questions").find("li").removeClass("active"), $(this).parent().addClass("active"), $(this).hasClass("que-save") || $(this).hasClass("que-save-mark") || $(this).hasClass("que-mark") || ($(this).addClass("que-not-answered"), $(this).removeClass("que-not-attempted")), e.hasClass("que-save") || e.hasClass("que-save-mark") || e.hasClass("que-mark") || (e.addClass("que-not-answered"), e.removeClass("que-not-attempted")), OpenCurrentQue($(this))

              var t = $(".test-questions").find("li.active"),
                  a = t.find("a").attr("data-href");
              var myanswer = "";

              var myexamname = ($("#examname").val());
              var myexamtype = ($("#type").val());

              var rqid = ($("input[name='qid" + a + "']").val());
              var mycid = ($("#cid").val());
              var myqindex = "<?php echo $qindex; ?>";

              $.ajax({
                  type: 'post',
                  url: 'ajax.php',
                  data: "updateanswer1='true'&qid='"+rqid+"'&cid='"+mycid+"'&myanswer='"+myanswer+"'&examname='"+myexamname+"'&clickstatus='attempted'&examtype='"+myexamtype+"'&myqindex='"+myqindex+"'",
                  success: function(data) {
                  }
                });
          });
          $(".btn-save-answer").click(function(e) {
              e.preventDefault();
              var t = $(".test-questions").find("li.active"),
                  a = t.find("a").attr("data-href"),
                  n = ($("#" + a).find(".hdfQuestionID").val(), $("#" + a).find(".hdfPaperSetID").val(), $("#" + a).find(".hdfCurrectAns").val(), !1);
              if ($("input[name='radios" + a + "']").each(function() {
                      $(this).is(":checked") && (n = !0)
                  }), 0 == n) {
                  // alert("Please choose an option");
                  NextQuestion(!0);
                  return !1
              }else{
                      var myanswer = ($("input[name='radios" + a + "']:checked"). val());

                      var myexamname = ($("#examname").val());
                      var myexamtype = ($("#type").val());

                      var rqid = ($("input[name='qid" + a + "']").val());
                      var mycid = ($("#cid").val());
                      var myqindex = "<?php echo $qindex; ?>";

                      $.ajax({
                          type: 'post',
                          url: 'ajax.php',
                          data: "updateanswer='true'&qid='"+rqid+"'&cid='"+mycid+"'&myanswer='"+myanswer+"'&examname='"+myexamname+"'&examtype='"+myexamtype+"'&clickstatus='save'&myqindex='"+myqindex+"'",
                          success: function(data) {
                          }
                        });
              };
              $("input[name='radios" + a + "']:checked").val(), t.find("a").removeClass("que-save-mark"), t.find("a").removeClass("que-mark"), t.find("a").addClass("que-save"), t.find("a").removeClass("que-not-answered"), t.find("a").removeClass("que-not-attempted"), NextQuestion(!1), CheckQueAttemptStatus()
          });
          $(".btn-save-mark-answer").click(function(e) {
              e.preventDefault();
              var t = $(".test-questions").find("li.active"),
                  a = t.find("a").attr("data-href"),
                  n = ($("#" + a).find(".hdfQuestionID").val(), $("#" + a).find(".hdfPaperSetID").val(), $("#" + a).find(".hdfCurrectAns").val(), $("#" + a).find(".hdfCurrectAns").val(), !1);
                  if ($("input[name='radios" + a + "']").each(function() {
                          $(this).is(":checked") && (n = !0)
                      }), 0 == n) {
                     // alert("Please choose an option");
                      NextQuestion(!0);
                      return !1
                  }else{
                      var myanswer = ($("input[name='radios" + a + "']:checked"). val());

                      var myexamname = ($("#examname").val());
                      var myexamtype = ($("#type").val());

                      var rqid = ($("input[name='qid" + a + "']").val());
                      var mycid = ($("#cid").val());
                      var myqindex = "<?php echo $qindex; ?>";

                      $.ajax({
                          type: 'post',
                          url: 'ajax.php',
                          data: "updateanswer='true'&qid='"+rqid+"'&cid='"+mycid+"'&myanswer='"+myanswer+"'&examname='"+myexamname+"'&clickstatus='savemark'&examtype='"+myexamtype+"'&myqindex='"+myqindex+"'",
                          success: function(data) {
                          }
                        });
                  };
                  $("input[name='radios" + a + "']:checked").val(), t.find("a").removeClass("que-save"), t.find("a").removeClass("que-mark"), t.find("a").addClass("que-save-mark"), t.find("a").removeClass("que-not-answered"), t.find("a").removeClass("que-not-attempted"), NextQuestion(!1), CheckQueAttemptStatus()
          });
          $(".btn-mark-answer").click(function(e) {
              e.preventDefault();
              var t = $(".test-questions").find("li.active"),
                  a = t.find("a").attr("data-href");
              $("#" + a).find(".hdfQuestionID").val(), $("#" + a).find(".hdfPaperSetID").val(), $("#" + a).find(".hdfCurrectAns").val(), $("#" + a).find(".hdfCurrectAns").val(), t.find("a").removeClass("que-save-mark"), t.find("a").removeClass("que-save"), t.find("a").addClass("que-mark"), t.find("a").removeClass("que-not-answered"), t.find("a").removeClass("que-not-attempted"), NextQuestion(!1), CheckQueAttemptStatus()

                      var myanswer = "";

                      var myexamname = ($("#examname").val());
                      var myexamtype = ($("#type").val());

                      var rqid = ($("input[name='qid" + a + "']").val());
                      var mycid = ($("#cid").val());
                      var myqindex = "<?php echo $qindex; ?>";

                      $.ajax({
                          type: 'post',
                          url: 'ajax.php',
                          data: "updateanswer='true'&qid='"+rqid+"'&cid='"+mycid+"'&myanswer='"+myanswer+"'&examname='"+myexamname+"'&clickstatus='mark'&examtype='"+myexamtype+"'&myqindex='"+myqindex+"'",
                          success: function(data) {
                          }
                        });
          });
          $(".btn-reset-answer").click(function(e) {
              e.preventDefault();
              var t = $(".test-questions").find("li.active"),
                  a = t.find("a").attr("data-href");
              $("#" + a).attr("data-queid"), t.find("a").removeClass("saved-que"), $("input[name='radios" + a + "']:checked").each(function() {
                  $(this).prop("checked", !1).change()
              }), $("input[name='chk" + a + "']").each(function() {
                  $(this).prop("checked", !1).change()
              }), $("input[type=checkbox]").prop("checked", !1).change(), a = t.find("a").attr("data-href"), $("#" + a).find(".hdfQuestionID").val(), $("#" + a).find(".hdfPaperSetID").val(), $("#" + a).find(".hdfCurrectAns").val(), $("#" + a).find(".hdfCurrectAns").val(), t.find("a").removeClass("que-save-mark"), t.find("a").removeClass("que-mark"), t.find("a").removeClass("que-save"), t.find("a").removeClass("que-not-attempted"), t.find("a").addClass("que-not-answered"), CheckQueAttemptStatus()

              var myanswer = "";

              var myexamname = ($("#examname").val());
              var myexamtype = ($("#type").val());

              var rqid = ($("input[name='qid" + a + "']").val());
              var mycid = ($("#cid").val());
              var myqindex = "<?php echo $qindex; ?>";

              $.ajax({
                  type: 'post',
                  url: 'ajax.php',
                  data: "updateanswer='true'&qid='"+rqid+"'&cid='"+mycid+"'&myanswer='"+myanswer+"'&examname='"+myexamname+"'&clickstatus='attempted'&examtype='"+myexamtype+"'&myqindex='"+myqindex+"'",
                  success: function(data) {
                  }
                });

          });
          $(".btn-submit-all-answers").click(function(e) {
              e.preventDefault(), $(this), $(".test-questions").find("li").each(function() {
                  var e = $(this),
                      t = !1;
                  if (e.children().hasClass("que-save") ? t = !0 : e.children().hasClass("que-save-mark") && (t = !0), t) {
                      var a = e.find("a").attr("data-href");
                      $("#" + a).find(".hdfCurrectAns").val();
                      $("#" + a).find("input[name='radios" + a + "']").each(function() {
                          var e = $(this);
                          e.is(":checked") && e.val()
                      })
                  }
              }), $(".exam-paper").hide(), $(".stream_1").hide(), $(".exam-summery").show(), CheckQueAttemptStatus()
          });
          $("#btnYesSubmit").on("click", function(e) {
              e.preventDefault(), $(".exam-confirm").show(), $(".exam-summery").hide()
          });
          $("#btnNoSubmit").on("click", function(e) {
              e.preventDefault(), $(".exam-paper").show(), $(".stream_1").show(), $(".exam-summery").hide()
          });
          $("#btnYesSubmitConfm").on("click", function(e) {
              e.preventDefault(), $(".exam-thankyou").show(), $(".exam-confirm").hide()
          });
          $("#btnNoSubmitConfirm").on("click", function(e) {
              e.preventDefault(), $(".exam-paper").show(), $(".stream_1").show(), $(".exam-confirm").hide()
          });
          $("#drpLanguage_ugc").on("change", function(e) {
              e.preventDefault(), "English" == $(this).val() ? window.location.href = "UGCNET_ENG.html" : window.location.href = "UGCNET_HIN.html"
          });
          $("#drpLanguage_ugc_commerce").on("change", function(e) {
              e.preventDefault(), "English" == $(this).val() ? window.location.href = "UGCNET_Commerce_ENG.html" : window.location.href = "UGCNET_Commerce_HIN.html"
          });
          $("#drpLanguage_jee_p1").on("change", function(e) {
              e.preventDefault(), "English" == $(this).val() ? window.location.href = "JEEMain.html" : "Hindi" == $(this).val() ? window.location.href = "JEEMain_hindi.html" : window.location.href = "JEEMain_gujarati.html"
          });
          $("#drpLanguage_jee_p2").on("change", function(e) {
              e.preventDefault(), "English" == $(this).val() ? window.location.href = "JEEMain_paper2_en.html" : "Hindi" == $(this).val() ? window.location.href = "JEEMain_paper2_hi.html" : window.location.href = "JEEMain_paper2_gj.html"
          });
          $('.stream_1').on('click', function(e) {
              e.preventDefault();
              var current_herf = $(this).attr('data-href');
              var a = $(".test-questions").find("li").find("a[data-href=" + current_herf + "]");
              a.trigger('click')
          });
          $('#btnViewResult').on('click', function(e) {
              e.preventDefault();
              CheckResult();
              $('.exam-result').show();
              $(".exam-thankyou").hide()
          });
          $('#btnRBack').on('click', function(e) {
              e.preventDefault();
              window.location.href = $('#hdfBaseURL').val() + "Quiz/Home/Index"
          })
      })
      $('.full_screen').click(function () {
          $('#quest').removeClass('col-md-10');
          $('#quest').addClass('col-md-12');
          $('#pallette').addClass('hidden');
          $('.full_screen').addClass('hidden');
          $('.collapse_screen').removeClass('hidden');
      });

      $('.collapse_screen').click(function () {
          $('#quest').removeClass('col-md-12');
          $('#quest').addClass('col-md-10');
          $('#pallette').removeClass('hidden');
          $('.full_screen').removeClass('hidden');
          $('.collapse_screen').addClass('hidden');
      });
    </script>


<script type="text/javascript">
    $( document ).ready(function() {
       $("#spinner").fadeOut("fast");
    });
</script>
</body>

</html>
