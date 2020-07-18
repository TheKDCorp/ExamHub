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
      styles: {".MathJax_Preview": {visibility: "text"}}
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
<div style="display:none;">
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
  if ($stype == "60c464c8b2696ae5ad1553ef1e53a0cb") {
                  $screentype = "digialm";
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
                  $mynewtime1    = ($mycurrenttime / 60);
                  $mynewtime1    = floor($mynewtime1);
                  if ($mynewtime1 < 10) {
                                  $mynewtime1 = "0" . $mynewtime1;
                  }
                  $mynewtime2 = ($mycurrenttime % 60);
                  if ($mynewtime2 < 10) {
                                  $mynewtime2 = "0" . $mynewtime2;
                  }
                  $mynewcurrenttime = $mynewtime1 . ":" . $mynewtime2 . ":" . "00";
                  $oldqpid = $row['examid'];
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
</div>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="Quiz/img/favicon.html">
    <title>Macro Vision Academy | National Testing Agency (TCS ION)</title>
    <link href="./assets/Quiz/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/Quiz/css/custom.css" rel="stylesheet" />
    <link href="./assets/Quiz/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/Quiz/css/style.default.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="./assets/css/examportal/digialm/exam_mains.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style-login.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">


    <style type="text/css">
        /* The Modal (background) */
    .modal {
      display: none; /* text by default */
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

  .mytest-ques{
    height:2em;
    width:2.7em;
    border-radius: 5%;
    margin-left:0.6em;
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
          $("#allpagefifth").hide();
          $('.nospan').css("display","none");
         $('.nos1').css("display","inline");
        });

        function showfirstpage(){
          $("#allpagefirst").show();
          $("#allpagethird").hide();
          $("#allpagesecond").hide();

        }
        function submitfirstpage(){
          $("#allpagefirst").hide();
          $("#allpagethird").show();
          $("#allpagesecond").hide();
        }
        function submitsecondpage(){
          $("#allpagefirst").hide();
          $("#allpagesecond").hide();
          $("#allpagethird").show();
        }

        function validatemyform(){
          if($("#termsandconditions").is(':checked')){
              $("#allpagefirst").hide();
              $("#allpagesecond").hide();
              $("#allpagethird").hide();
              $("#allpagefourth").show();
              setheight();
              // openCitynewtab(1,'rr');
              CoundownTimer(parseInt($("#hdfTestDuration").val()));
          } else {
              alert("Please accept terms and conditions before proceeding.");
              return false;
          }
        }

        function disableme(){
          $("#allpagefourth").hide();
          $("#allpagefifth").show();
        }

        function submitexam(){
          $('#finalsubmitok').css("pointer-events","none");
          $("#spinner").show();
        }

        function gotoexamscreen(){
	        $("#allpagefourth").show();
	        $("#allpagefifth").hide();	
        }

    </script>



  <script type="text/javascript">
    function setheight(){
      var temp1 = $("footer").css("top");
      temp1 = temp1.replace("px","");
      var temp2 = $("footer").css("height");
      temp2 = temp2.replace("px","");

      var total = +temp2 + +temp1;

      var titlebar = $(".titlebar").css("height");
      titlebar = titlebar.replace("px","");
      var timebar = $(".timebar").css("height");
      timebar = timebar.replace("px","");
      var questiontypebar = $(".questiontypebar").css("height");
      questiontypebar = questiontypebar.replace("px","");

      var functionarea= $(".functionarea").css("height");
      functionarea = functionarea.replace("px","");

      total = + total - +functionarea;
      var jt = +titlebar + +timebar + +questiontypebar;
      var height = +total - +jt;

      $(".answerarea").css("height",height);
      leftdivheight = +height - 2;
      $(".leftDiv").css("height",leftdivheight)

      var temp1 = $("footer").css("top");
      temp1 = temp1.replace("px","");
      var temp2 = $("footer").css("height");
      temp2 = temp2.replace("px","");
      var total = +temp2 + +temp1;

      var submitarea = $(".submitarea").css("height");
      submitarea = submitarea.replace("px","");

      var tt = +total - +submitarea + "px";

      $(".submitarea").css("top",tt);

      var titlebar = $(".titlebar").css("height");
      titlebar = titlebar.replace("px","");
      var profilebar = $(".profilebar").css("height");
      profilebar = profilebar.replace("px","");

      var detbar = $(".detbar").css("height");
      detbar = detbar.replace("px","");

      var sectionname = $(".sectionname").css("height");
      sectionname = sectionname.replace("px","");

      var submitarea = $(".submitarea").css("height");
      submitarea = submitarea.replace("px","");

      var ext = $(".ext").css("height");
      ext = ext.replace("px","");

      total = +total - +functionarea;
      var jt = +titlebar + +profilebar + +detbar + +sectionname;

      var height = +total - +jt;
      $(".qlist").css("height",height);

    }
  </script>

  <script type="text/javascript">
    function openCity1(cityName,questionno) {
      var elements = document.getElementsByClassName("quels");
      for(var i=0; i<elements.length; i++) {
        elements[i].style.display="none";
      }
      var elements = document.getElementsByClassName("quels2");
      for(var i=0; i<elements.length; i++) {
        elements[i].style.display="none";
      }
      document.getElementById("st"+cityName).style.display = "block";
      document.getElementById("st"+cityName+"q"+questionno).style.display = "block";
      document.getElementById("st"+cityName+"cp").value = questionno;
      document.getElementById("cp").value = cityName;
    }

    function openCity(cityName,questionno){
      var elements = document.getElementsByClassName("quels");
      for(var i=0; i<elements.length; i++) {
        elements[i].style.display="none";
      }
      var elements = document.getElementsByClassName("quels2");
      for(var i=0; i<elements.length; i++) {
        elements[i].style.display="none";
      }

      document.getElementById("st"+cityName).style.display = "block";
      document.getElementById("st"+cityName+"q"+questionno).style.display = "block";

      var newquestionno = questionno;

      document.getElementById("st"+cityName+"cp").value = newquestionno;
      document.getElementById("cp").value = cityName;
    }

    function openCitynewtab(cityName,questionno){
      var elements = document.getElementsByClassName("quels");
      for(var i=0; i<elements.length; i++) {
        elements[i].style.display="none";
      }
      var elements = document.getElementsByClassName("quels2");
      for(var i=0; i<elements.length; i++) {
        elements[i].style.display="none";
      }
      var elements = document.getElementsByClassName("qlisttabs");
      for(var i=0; i<elements.length; i++) {
        elements[i].style.display="none";
      }

      document.getElementById("qlist"+cityName).style.display = "block";

      if(questionno=='rr'){
        questionno = document.getElementById("st"+cityName+"cp").value;
      }

      document.getElementById("st"+cityName).style.display = "block";
      document.getElementById("st"+cityName+"q"+questionno).style.display = "block";

      if(questionno=="0"){
        // var newquestionno = +questionno + 1;
      }else{
        var newquestionno = questionno;
      }

      document.getElementById("st"+cityName+"cp").value = newquestionno;
      document.getElementById("cp").value = cityName;
    }

    function nextquestiondigi(){
      var atab = document.getElementById("cp").value;
      var aque = document.getElementById("st"+atab+"cp").value;

      atab = atab;
      aque = +aque + 1;

      openCity(atab,aque);

      var atab = document.getElementById("cp").value;
      var aque = document.getElementById("st"+atab+"cp").value;
      if(aque=="31"){
        document.getElementById("cp").value = +atab + 1;
      }
    }
    function gotoquestiondigi(qno){
      var atab = document.getElementById("cp").value;

      openCity(atab,qno);
    }


function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;


        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

function startTimer2(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        $(display).val(minutes + "." + seconds);

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

function strrrt(){
    var time = $("#times").val();
    var fiveMinutes = time * 60;
    display = document.querySelector('#time');
    display2 = document.querySelector('#timeinput');

    timer(fiveMinutes);

    startTimer(fiveMinutes, display);
    startTimer2(fiveMinutes, "#timeinput");
}

function clearresponse(){

}

function timer(kk){
  kk = kk * 1000;
  setTimeout(function() {
   $('#curform').submit();
  }, kk);
}

function starttime(fieldname){

}

function stoptime(fieldname,){

}

function clicksubject(no,nos){
  $(".currentpart").val(no);
  shownos(nos);
}
function shownos(nos){
  $('.nospan').css("display","none");
  $('.'+nos).css("display","inline");
}

function scrolldown(){
  scrolled=scrolled+300;
  $(".div-content").animate({
    scrollTop:  scrolled
  });
}

function setcurrentqueno(no){
  $(".currentqueno").val(no);
}


  function showinstructions(){
  $("#instructions").css("display", "block");
  }

  function closeinstructions(){
   $("#instructions").css("display", "none");
  }

  function showquestionpaper(){
   $("#questionpapermodal").css("display", "block");
  }

  function closequestionpaper(){
   $("#questionpapermodal").css("display", "none");
  }

   function refreshquestionpaperpage(){
      document.getElementById("qpaperiframe").src="myquestionpaper.php?cid=<?php echo $cid;?>&qindex=<?php echo $qindex;?>&examname=<?php echo $examname;?>";
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
          <div id="heading-breadcrumbs" style="background-color: #4e85c5">
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
                                            <input type="button" style="color:white;background-color: #4e85c5;" onclick="closeinstructions();" class="btn btn-primary btn-block" value="Close">
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
          <div id="heading-breadcrumbs" style="background-color: #4e85c5">
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
                                      <input type="button" style="color:white;width:100%;background-color: #4e85c5" onclick="closequestionpaper();" class="btn btn-primary btn-block" value="Close">
                                      <hr>
                                      <iframe id="qpaperiframe" src="myquestionpaper.php?cid=<?php echo $cid;?>&qindex=<?php echo $qindex;?>&examname=<?php echo $examname;?>" style="width:100%;border:0px;height:500px;max-height:1000px;overflow-y:scroll;"></iframe>
                                     <hr>
                                     <input type="button" style="color:white;background-color: #4e85c5" onclick="closequestionpaper();" class="btn btn-primary btn-block" value="Close">
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
      <div id="wrapper">
        <div id="minwidth"> 
          <div id="header">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                <td align="left" id="bannerImage">
                  <div id="bannerImg" style="float:left"></div>
                  <div id="bannerText" align="center" style="margin-top:10px; font-weight:bold;"><font size="4" color="#ffffff"></font></div>
                </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="userInfo">
            <div class="system_info">
              <div class="system_name">
                <div id="sysName" class="name1">System Name :</div>
                <div class="details1" id="mockSysNum" style="font-size:30px;"><?php echo strtoupper($rowstudent['name']); ?></div>
                <div style="font-size:15px;" class="details3">
                </div>
              </div>
              <div align="center" class="user_pic">
                <?php 
                  $imgsrc = $rowstudent['imgsrc'];
                  $imglink = "../admin/profile/".md5($imgsrc)."jt". md5($imgsrc).".jpg";

                  if (file_exists($imglink)){
                   ?>
                    <img width="94" height="101" align="absmiddle" class="candidateImg" src="<?php echo $imglink;?>">
                  <?php 
                    }else{
                      ?>
                    <img width="94" height="101" align="absmiddle" class="candidateImg" src="../assets/img/default-avatar.png">
                      <?php
                    }
                  ?>

                
              </div>
              
              <div class="user_name">
                <div id="indexCandName" class="name2" style="font-size:20px;">Candidate Name : <?php echo strtoupper($rowstudent['name']); ?></div>
                <div class="details2">
                  <span title="" class="candOriginalName"></span>
                </div>
                <div style="margin-top:10px;text-align:right"><span class="name2" id="subName">Subject :</span><span style="font-size:15px;" class="details2" id="mockSubName"><?php echo strtoupper($examname); ?></span></div>
              </div>
              <div class="clear"></div>
            </div>
          </div>
          <div id="login">
            <div class="form-header" id="LoginPageHeader">Sign in to Continue</div>
            <form name='form-login' style="margin:0px;">
                <span class="fontawesome-user" style="padding:5px;"><i class="fa fa-user" style="font-size:25px;"></i></span>
                <input type="text" name="text15" class="mandat_input keyboardInput loginText" disabled="disabled" value="<?php echo $rowstudent['username']; ?>" class="" >

                <span class="clear"></span>

                <span class="fontawesome-lock" style="padding:5px;"><i class="fa fa-lock" style="font-size:25px;"></i></span>
                <input type="password"  value="<?php echo $rowstudent['password']; ?>"  class="mandat_input keyboardInput loginText" disabled="disabled" name="text14">                      
                <a  onclick="submitfirstpage();" > <span id="signInLabel" class="btn btn-primary btn-primary-blue" style="line-height: 35px">Sign In</span><a>
            </form>
            </div>
          </div>
          <div id="footer">
            <center>
              <div> &copy; 2018 Macro Vision Academy, Developed By "Digi MVA" Group</div>
            </center>
          </div>
        </div>
    </div>

    <div id="allpagesecond" style="display:none;overflow: hidden;">
        <style type="text/css"> 
          #topheader{
            width:100%;
            background-color:#2d70b6;
          }
          
          #subheader{
            width:100%;
            background-color:#BCE8F5;
          }

          #message{
            height:70%;
            overflow-y:scroll;
          }

        </style>

        <div class="container-fluid" style="overflow:hidden;margin-right:0px;padding-right:0px;">
          <div class="row" style="margin-right:0px;padding-right:0px;"><br><br></div>
          <div class="row" style="overflow:hidden;">
            <div class="col-lg-10 col-md-10 col-sm-10" style="padding:0px;margin:0px;padding-left:5px;">
              <div id="subheader">
                Instructions
              </div>
              <div id="message" style="height: 85%;">
                <?php $myfile = fopen("instructions1.txt", "r") or die("Unable to open file!");
                  echo fread($myfile,filesize("instructions1.txt"));
                  fclose($myfile); 
                  ?>
              </div>
              <div id="functions" style="border-top:1px solid grey;padding-top:1em;">
                <a class="btn btn-default" style="float:right;border:1px solid grey; background-color:transparent;padding-bottom:10px;" onclick="submitsecondpage();">Next ></a>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div style="height:100%;width:100%;border-left:1px solid grey;"><center>
                <?php 
                  $imgsrc = $rowstudent['imgsrc'];
                  $imglink = "../admin/profile/".md5($imgsrc)."jt". md5($imgsrc).".jpg";

                  if (file_exists($imglink)){
                   ?>
                    <img src="<?php echo $imglink;?>" height=150 width=115>
                  <?php 
                    }else{
                      ?>
                    <img src="../assets/img/default-avatar.png" height=150 width=115>
                      <?php
                    }
                  ?>
              </center>
              </div>
            </div>
          </div>
        </div>

    </div>

    <div id="allpagethird" style="display:none;overflow: hidden;">
        <style type="text/css"> 
          #topheader{
            width:100%;
            background-color:#363636;
            color:yellow;
          }
          
          #subheader{
            width:100%;
            background-color:#BCE8F5;
          }

          #message{
            height:60%;
            overflow-y:scroll;
          }

        </style>

        <div class="container-fluid" style="overflow:hidden;margin-right:0px; padding-right:0px;">
          <div class="row" id="topheader" ><br><br></div>
          <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10" style="padding:0px;margin:0px;padding-left:5px;">
              <div id="subheader">
                Instructions
              </div>
              <div id="message" style="height: 80%;">
                <?php $myfile = fopen("instructions1.txt", "r") or die("Unable to open file!");
                  echo fread($myfile,filesize("instructions1.txt"));
                  fclose($myfile); 
                  ?>
              </div>
              
              <div id="functions" style="border-top:1px solid grey;padding-top:1em;">
                <input type="checkbox" id="termsandconditions" name="termsandconditions" style="-webkit-appearance: checkbox;"> I have read and understood the instructions. All computer hardware allotted to me are in proper working condition. I declare  that I am not in possession of / not wearing / not  carrying any prohibited gadget like mobile phone, bluetooth  devices  etc. /any prohibited material with me into the Examination Hall.I agree that in case of not adhering to the instructions, I shall be liable to be debarred from this Test and/or to disciplinary action, which may include ban from future Tests / Examinations
                <br>
                <br>
              
                <a class="btn btn-primary" style="float:left;border:1px solid grey; background-color:transparent;color:black" onclick="showfirstpage();">< Previous</a>
                <a class="btn btn-primary" style="float:right;background-color:#0c7cd5;color:white;" onclick="validatemyform();">I am ready to begin ></a>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div style="height:100%;width:100%;border-left:1px solid grey;"><center>
                <?php 
                  $imgsrc = $rowstudent['imgsrc'];
                  $imglink = "../admin/profile/".md5($imgsrc)."jt". md5($imgsrc).".jpg";

                  if (file_exists($imglink)){
                   ?>
                    <img src="<?php echo $imglink;?>" height=150 width=115>
                  <?php 
                    }else{
                      ?>
                    <img src="../assets/img/default-avatar.png" height=150 width=115>
                      <?php
                    }
                  ?>
              </center>
              </div>
            </div>
          </div>
        </div>

    </div>

<form action="exam_submit.php" method="post" id="myexamform" onSubmit="return checkform();">
    <div id="allpagefourth" style="display:none;">
          <input type="hidden" id="qindex" name="qindex" value="<?php echo $qindex; ?>">
          <input type="hidden" id="hdfBaseURL" value="/" />
          <div class="titlebar">
            <div style="color:yellow;"><span style="font-size:13px;margin-left:10px;color:yellow;">Exam Name: <?php echo strtoupper($examname); ?></span>
              <div style="float:right;">
                <a onclick="showquestionpaper();" class="btn-primary" style="color:white;background-color: #4e85c5;padding:0.5em;"><strong>Question Paper</strong></a>&nbsp&nbsp&nbsp
                <a onclick="showinstructions();" class="btn-primary" style="color:white;background-color: #4e85c5;padding:0.5em;"><strong>Instructions</strong></a>
              </div>
            </div>
          </div>
          <div class="container-fluid" style="padding:0px;margin:0px;">
            <div style="padding:0px;margin:0px;width:85%;position:fixed;">
              <div class="timebar" style="border:1px solid grey;">
                <div>
                  <?php
                    $mysql = "select * from questionpaper where qpid='$eid'";
                    $myresult = $conn->query($mysql);
                    if($myresult->num_rows > 0){
                      $jjkk = 0;
                      $newjjkk = 0;
                      $nooftimes = 0;
                      $myrow = $myresult->fetch_assoc();
                      echo '<td class="full-width">';
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
                          echo '<span style="margin-left:5px;margin-right:5px;"><a class="mb5 btn btn-primary stream_1 full-width" href="javascript:void(0);" data-href="page'.$newjjkk.'"';
                          ?>
                          onclick="clicksubject('<?php echo $mypart;?>','nos<?php echo $mypart;?>');"
                          <?php echo '>'.$currentpartname.'</a></span>';
                      }
                      echo "</td>";
                    }
                  ?>
                  <div style="float:right;">
                    <strong>
                      <span class="timer-title time-started" id="rstime"><?php if($getanswer == "true"){echo $mynewcurrenttime;}else{echo $mynewtime;} ?>
                      </span>
                    <input type="hidden" name="mytime" id="mytime">
                    <input type="hidden" name="timeleft" id="textrstime"></strong>
                  </div>
                </div>
              </div>
              <?php
                if($getanswer=="true"){
                  echo '<input type="hidden" id="hdfTestDuration" value="'.$mycurrenttime.'" />';
                }else{
                  echo '<input type="hidden" id="hdfTestDuration" value="'.$tttime.'" />';
                }
               ?>

              <div class="questiontypebar">
                <div style="color:red;">Question Type : Single Choice Question's</div>
              </div>

              <div class="qarea">
                <div class="answerarea">
                  <div class="question">
                    <input type="hidden" class="currentqueno" value="1">
                   <?php
                    $no = 0;
                    $totalnoofque = 0;

                    if($getanswer == "true"){

                       $sql1= "select * from questionpaper where name='$examname'";
                        $result1=$conn->query($sql1);
                        if($result1->num_rows > 0){
                          $row1=$result1->fetch_assoc();
                          $srnotype = $row1['srnotype'];
                        }

                      $sql1 = "select DISTINCT part from answers_new where examname='$examname' and qindex='$qindex' and cid='$cid'";
                      $result1 = $conn->query($sql1);
                      $totalnoofparts = $result1->num_rows;

                      for($j=1;$j<=$totalnoofparts;$j++){
                        $sql2= "select * from answers_new where examname='$examname' and qindex='$qindex' and cid='$cid' and part='$j'";
                        $result2=$conn->query($sql2);
                        $noofque = $result2->num_rows;?>
                        <input type="hidden" class="part<?php echo $j; ?>" value="<?php echo $noofque; ?>">
                        <?php
                      }

                      $sql1= "select * from answers_new where examname='$examname' and qindex='$qindex' and cid='$cid' order by aid";
                      $result1=$conn->query($sql1);
                      ?>


                      <input type="hidden" class="currentpart" value="1">
                      <input type="hidden" class="noofparts" value="<?php echo $totalnoofparts; ?>">
                      <?php
                      while($row1=$result1->fetch_assoc()){
                        $myqid = $row1['qid'];
                        $sql2 = "select * from questionentry where qid='$myqid'";
                        $result2=$conn->query($sql2);
                        if($result2->num_rows > 0){

                          $row2=$result2->fetch_assoc();
                          $no = $no+1;

                          ?>

                            <div style="<?php if($no != "1"){echo "display:none;";} ?>margin:0px;padding:0px;width:100%;height:100%;overflow-y:scroll;" class="tab-content div-question mb0" id="page<?php if($no<=9){echo "0";}echo $no; ?>">
                              <div class="leftDiv" style="margin:1px; margin-top:2px;margin-left:1px;">
                                <input type="hidden" value="1" class="hdfQuestionID">
                                <input type="hidden" value="1" class="hdfPaperSetID">
                                <input type="hidden" value="4" class="hdfCurrectAns">
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
                                <div class="divHeader" style="border-bottom: 1px solid grey;padding:0px;margin:0px">
                                  <b>
                                    <span class="questionNumber" style="margin-left:5px;">Question <?php echo $no; ?>:
                                    </span>
                                  </b>
                                  <a id="scrollToBottom" title="Scroll Down" onclick="scrollToBottom()" style="display: inline;">
                                    <img width="25" height="22" align="right" alt="Scroll Down" src="./assets/Quiz/img/QuizIcons/down.png" style="">
                                  </a>
                                </div>
                                <div id="quesAnsContent" class="Ans_Area" style="padding:5px;">
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
                                                    <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> A ) <?php if($row2['option1']!= ""){
                                                          echo $row2['option1'];
                                                          } if($row2['opt1img']!= ""){
                                                    ?>
                                                    <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                                    <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> B ) <?php if($row2['option2']!= ""){

                                                          echo $row2['option2'];
                                                      } if($row2['opt2img']!= ""){
                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> C ) <?php if($row2['option3']!= ""){

                                                          echo $row2['option3'];
                                                      } if($row2['opt3img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> D ) <?php if($row2['option4']!= ""){

                                                          echo $row2['option4'];
                                                      }                                   if($row2['opt4img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <?php
                                                }else{
                                                 ?>
                                                  <tr>
                                                      <td><input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="1"){echo 'checked';} ?>> A ) <?php if($row2['option1']!= ""){

                                                          echo $row2['option1'];
                                                          } if($row2['opt1img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="2"){echo 'checked';} ?>> B ) <?php if($row2['option2']!= ""){

                                                            echo $row2['option2'];
                                                        } if($row2['opt2img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="3"){echo 'checked';} ?>> C ) <?php if($row2['option3']!= ""){

                                                          echo $row2['option3'];
                                                      } if($row2['opt3img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="4"){echo 'checked';} ?>> D ) <?php if($row2['option4']!= ""){

                                                            echo $row2['option4'];
                                                        }                                   if($row2['opt4img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                 <?php
                                                }
                                                ?>

                                                <?php
                                              }else{
                                                if($row1['choosedoption']==""){
                                                  ?>
                                                  <tr>
                                                      <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 1 ) <?php if($row2['option1']!= ""){

                                                          echo $row2['option1'];
                                                          } if($row2['opt1img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 2 ) <?php if($row2['option2']!= ""){

                                                            echo $row2['option2'];
                                                        } if($row2['opt2img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 3 ) <?php if($row2['option3']!= ""){

                                                      echo $row2['option3'];
                                                  } if($row2['opt3img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 4 ) <?php if($row2['option4']!= ""){

                                                            echo $row2['option4'];
                                                        } if($row2['opt4img']!= ""){

                                                        ?>
                                                        <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                                        <?php
                                                  }?></td>
                                                  </tr>
                                                  <?php
                                                }else{
                                                    ?>
                                                   <tr>
                                                      <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="1"){echo 'checked';} ?>> 1 ) <?php if($row2['option1']!= ""){

                                                          echo $row2['option1'];
                                                          } if($row2['opt1img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                      }?>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="2"){echo 'checked';} ?>> 2 ) <?php if($row2['option2']!= ""){

                                                          echo $row2['option2'];
                                                      } if($row2['opt2img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="3"){echo 'checked';} ?>> 3 ) <?php if($row2['option3']!= ""){

                                                          echo $row2['option3'];
                                                      } if($row2['opt3img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1" <?php if($row1['choosedoption']=="4"){echo 'checked';} ?>> 4 ) <?php if($row2['option4']!= ""){

                                                          echo $row2['option4'];
                                                      } if($row2['opt4img']!= ""){

                                                      ?>
                                                      <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                                      <?php
                                                  }?></td>
                                                  </tr>
                                                <?php
                                                }
                                              }
                                           ?>
                                      </tbody>
                                  </table>
                                </div>
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
                        ?>
                        <input type="hidden" class="currentpart" value="1">
                        <input type="hidden" class="noofparts" value="<?php echo $i-1; ?>">
                        <?php
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
                          $noofque = $result2->num_rows;
                          $totalnoofque = $totalnoofque + $noofque;
                          ?>
                          <input type="hidden" class="part<?php echo $j; ?>" value="<?php echo $noofque; ?>">
                          <?php
                          while($row2=$result2->fetch_assoc()){
                            $no = $no+1;
                            if($no==$totalnoofque){
                              $showno = $j;
                            }else{
                              $showno = $j+1;
                            }

                          ?>
                            <div style="<?php if($no != "1"){echo "display:none;";} ?>margin:0px;padding:0px;width:100%;overflow-y:scroll;height:100%;" class="tab-content div-question mb0" id="page<?php if($no<=9){echo "0";}echo $no; ?>">
                              <div class="leftDiv" style="margin:1px; margin-top:2px;margin-left:1px;">
                                <input type="hidden" value="1" class="hdfQuestionID">
                                <input type="hidden" value="1" class="hdfPaperSetID">
                                <input type="hidden" value="4" class="hdfCurrectAns">
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

                                <div class="divHeader" style="border-bottom: 1px solid grey;padding:0px;margin:0px">
                                  <b>
                                    <span class="questionNumber" style="margin-left:5px;">Question <?php echo $no; ?>:
                                    </span>
                                  </b>
                                  <a id="scrollToBottom" title="Scroll Down" onclick="scrollToBottom()" style="display: inline;">
                                    <img width="25" height="22" align="right" alt="Scroll Down" src="./assets/Quiz/img/QuizIcons/down.png" style="">
                                  </a>
                                </div>
                                <div id="quesAnsContent" class="Ans_Area" style="padding:5px;">
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
                                            <td> 
                                              <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> A ) 
                                              <?php
                                              if($row2['option1']!= ""){
                                                  echo $row2['option1'];
                                              } 
                                              if($row2['opt1img']!= ""){
                                                ?>
                                                <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                                <?php
                                              }
                                              ?>
                                            </td>
                                          </tr>
                                          <tr>
                                              <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> B ) <?php if($row2['option2']!= ""){

                                                  echo $row2['option2'];
                                              } if($row2['opt2img']!= ""){
                                              ?>
                                              <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                              <?php
                                          }?></td>
                                          </tr>
                                          <tr>
                                              <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> C ) <?php if($row2['option3']!= ""){

                                                  echo $row2['option3'];
                                              } if($row2['opt3img']!= ""){

                                              ?>
                                              <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                              <?php
                                          }?></td>
                                          </tr>
                                          <tr>
                                              <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> D ) <?php if($row2['option4']!= ""){

                                                  echo $row2['option4'];
                                              }                                   if($row2['opt4img']!= ""){

                                              ?>
                                              <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                              <?php
                                          }?></td>
                                          </tr>
                                          <?php
                                  }else{              
                                      ?>
                                      <tr>
                                          <td> <input type="radio" value="1" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 1 ) <?php if($row2['option1']!= ""){

                                              echo $row2['option1'];
                                              } if($row2['opt1img']!= ""){

                                          ?>
                                          <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt1img']); ?>.jpg" class="img-responsive"><br>
                                          <?php
                                      }?></td>
                                      </tr>
                                      <tr>
                                          <td> <input type="radio" value="2" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 2 ) <?php if($row2['option2']!= ""){

                                                echo $row2['option2'];
                                            } if($row2['opt2img']!= ""){

                                          ?>
                                          <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt2img']); ?>.jpg" class="img-responsive"><br>
                                          <?php
                                      }?></td>
                                      </tr>
                                      <tr>
                                          <td> <input type="radio" value="3" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 3 ) <?php if($row2['option3']!= ""){

                                          echo $row2['option3'];
                                      } if($row2['opt3img']!= ""){

                                          ?>
                                          <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt3img']); ?>.jpg" class="img-responsive"><br>
                                          <?php
                                      }?></td>
                                      </tr>
                                      <tr>
                                          <td> <input type="radio" value="4" name="radiospage<?php if($no<=9){echo "0";}echo $no; ?>" id="rOption<?php echo $no; ?>_1"> 4 ) <?php if($row2['option4']!= ""){

                                                echo $row2['option4'];
                                            } if($row2['opt4img']!= ""){

                                            ?>
                                            <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row2['opt4img']); ?>.jpg" class="img-responsive"><br>
                                            <?php
                                      }?></td>
                                      </tr>
                                      <?php
                                  }
                                  ?>
                                  </tbody>
                                </table>
                              </div>
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
              </div>
              <div class="functionarea" style="z-index:3;background-color:white;">
                <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <button class="btn btn-primary btn-save-mark-answer">Save &amp; Mark For Review</button>
                    <button class="btn btn-primary btn-reset-answer">Clear Response</button>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3" style="text-align:right;">
                    <button class="btn btn-primary btn-block btn-save-answer" >Save &amp; Next</button>
                  </div>
                </div>
              </div>
            </div>
            <div style="width:15%;float:right;">
              <div class="profilebar">
                <div style="">
                  <?php 
                    $imgsrc = $rowstudent['imgsrc'];
                    $imglink = "../admin/profile/".md5($imgsrc)."jt". md5($imgsrc).".jpg";

                    if (file_exists($imglink)){
                     ?>
                      <img style="padding:0px;margin:0px;width:60px;height:70px;" src="<?php echo $imglink;?>">
                    <?php 
                      }else{
                        ?>
                      <img style="padding:0px;margin:0px;width:60px;height:70px;" src="../assets/img/default-avatar.png">
                        <?php
                      }
                    ?>
                  
                  <span style="font-size:20px;padding-left:0.3em;">
                    <?php echo strtoupper($rowstudent['name']); ?>
                  </span>
                </div>
              </div>
              <div class="qlistbar" style="margin:0px; padding:0px;">
                <div class="detbar">
                  <table>
                    <tr>
                        <td class="full-width" style="font-size:12px;width:50%;"> <a class="test-ques-stats que-not-attempted lblNotVisited">0</a> Not Visited</td>
                        <td class="full-width" style="font-size:12px;width:50%;"> <a class="test-ques-stats que-not-answered lblNotAttempted">0</a> Not Answered </td>
                    </tr>
                    <tr><td><br></td></tr>
                    <tr>
                        <td class="full-width" style="font-size:12px;width:50%;"> <a class="test-ques-stats que-save lblTotalSaved">0</a> Answered </td>
                        <td class="full-width" style="font-size:12px;width:50%;"></td>
                    </tr>
                    <tr><td><br></td></tr>

                    <tr>
                        <td colspan="2" style="font-size:12px;width:100%;"> <a class="test-ques-stats que-mark lblTotalSaveMarkForReview">0</a> Answered &amp; Marked for Review (will be considered for evaluation) </td>
                    </tr>
                  </table>
                </div>
                <div class="sectionname" style="background-color:#4e85c5;color:white;padding:7px;padding-left: 15px;"><b>Section Wise:</b></div>
                <div class="qlist" style="width:100%;">
                  <div class="ext"><b>Choose a Question: </b><br></div>
                  <ul class="pagination test-questions" style="width:100%;">
                    <?php
                      $mykk = 0;
                      $no23 = 0;
                      $oldkk = 1;
                      $jjmy = 0;
                      if($getanswer == "true"){
                        $sql22= "select * from questionpaper where name='$examname'";
                        $result22=$conn->query($sql22);
                        if($result22->num_rows > 0){
                          $row22=$result22->fetch_assoc();
                          $nn22 = $row22['noofparts'];
                        }

                        if($result22->num_rows > 0){
                          for($jj22=1;$jj22<=$nn22;$jj22++){
                            $kk = 0;
                            $sql23 = "select * from answers_new where examname='$examname' and qindex='$qindex' and cid='$cid' and part='$jj22' order by aid";
                            $result23=$conn->query($sql23);
                            if($result23->num_rows > 0){
                              while($row23=$result23->fetch_assoc()){
                                $kk = $kk + 1;
                                $jjmy = $jjmy + 1;

                                $myclickstatus = $row23['clickstatus'];

                                if($jjmy < 10){
                                    $myno = "0".$jjmy;
                                }else{
                                    $myno = $jjmy;
                                }

                                if($myclickstatus=="save"){
                                  if($jjmy == "01"){
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' class="active nospan nos'.$jj22.'" data-seq="1" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-save" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }else{
                                    if($kk < 10){
                                        $mykk = "0".$kk;
                                    }else{
                                        $mykk = $kk;
                                    }
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' data-seq="1" class="nospan nos'.$jj22.'" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-save" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }
                                }else if($myclickstatus=="savemark"){
                                  if($jjmy == "01"){
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' class="active nospan nos'.$jj22.'" data-seq="1" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-save-mark" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }else{
                                    if($kk < 10){
                                        $mykk = "0".$kk;
                                    }else{
                                        $mykk = $kk;
                                    }
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' data-seq="1" class="nospan nos'.$jj22.'" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-save-mark" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }
                                }else if($myclickstatus=="attempted"){
                                  if($jjmy == "01"){
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' class="active nospan nos'.$jj22.'" data-seq="1" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-not-answered" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }else{
                                    if($kk < 10){
                                        $mykk = "0".$kk;
                                    }else{
                                        $mykk = $kk;
                                    }
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' data-seq="1" class="nospan nos'.$jj22.'" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-not-answered" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }
                                }else if($myclickstatus=="mark"){
                                  if($jjmy == "01"){
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' class="active nospan nos'.$jj22.'" data-seq="1" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-mark" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }else{
                                    if($kk < 10){
                                        $mykk = "0".$kk;
                                    }else{
                                        $mykk = $kk;
                                    }
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' data-seq="1" class="nospan nos'.$jj22.'" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-mark" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }
                                }else{
                                  if($jjmy == "01"){
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' class="active nospan nos'.$jj22.'" data-seq="1" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-not-attempted" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }else{
                                    if($kk < 10){
                                        $mykk = "0".$kk;
                                    }else{
                                        $mykk = $kk;
                                    }
                                    echo '<li ';
                                    ?>
                                    onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                    <?php echo ' data-seq="1" class="nospan nos'.$jj22.'" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-not-attempted" href="javascript:void(0);" data-href="page'.$myno.'">'.$myno.'</a></li>';
                                  }
                                }
                              }
                            }
                          }
                        }
                        }else{
                          $sql22= "select * from questionpaper where name='$examname'";
                          $result22=$conn->query($sql22);
                          if($result22->num_rows > 0){
                            $row22=$result22->fetch_assoc();
                            $nn22 = $row22['noofparts'];
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
                          }
                          if($result22->num_rows > 0){
                            for($jj22=1;$jj22<=$nn22;$jj22++){
                              $sql23 = "select * from questionentry where qpname='$examname' and part='$jj22'";
                              if($jj22=="1"){
                                $limitnoofque = $part1noofque;
                              }elseif($jj22=="1"){
                                $limitnoofque = $part1noofque;
                              }elseif($jj22=="2"){
                                $limitnoofque = $part2noofque;
                              }elseif($jj22=="3"){
                                $limitnoofque = $part3noofque;
                              }elseif($jj22=="4"){
                                $limitnoofque = $part4noofque;
                              }elseif($jj22=="5"){
                                $limitnoofque = $part5noofque;
                              }elseif($jj22=="6"){
                                $limitnoofque = $part6noofque;
                              }elseif($jj22=="7"){
                                $limitnoofque = $part7noofque;
                              }elseif($jj22=="8"){
                                $limitnoofque = $part8noofque;
                              }elseif($jj22=="9"){
                                $limitnoofque = $part9noofque;
                              }elseif($jj22=="10"){
                                $limitnoofque = $part10noofque;
                              }
                              $sql23 .= " LIMIT ".$limitnoofque;
                              $result23=$conn->query($sql23);
                              if($result23->num_rows > 0){
                                $no23=$result23->num_rows;
                                echo '';
                                for ($kk=$oldkk; $kk <=$no23 ; $kk++) {
                                  $jjmy = $jjmy + 1;
                                  if($jjmy < 10){
                                      $mynewno = "0".$jjmy;
                                  }else{
                                      $mynewno = $jjmy;
                                  }

                                  if($jjmy == "01"){
                                     echo '<li ';
                                     ?>
                                     onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                     <?php echo ' class="active nospan nos'.$jj22.'" data-seq="1" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-not-attempted" href="javascript:void(0);" data-href="page'.$mynewno.'">'.$mynewno.'</a></li>';
                                  }else{
                                      if($kk < 10){
                                          $mykk = "0".$kk;
                                      }else{
                                          $mykk = $kk;
                                      }
                                      echo '<li ';
                                      ?>
                                      onclick="setcurrentqueno('<?php echo $kk; ?>');"
                                      <?php echo ' data-seq="1" class="nospan nos'.$jj22.'" id="nos'.$jj22.'" style="position:relative;"><a class="mytest-ques que-not-attempted" href="javascript:void(0);" data-href="page'.$mynewno.'">'.$mynewno.'</a></li>';
                                  }

                                }
                                echo '';
                              }
                            }
                          }
                        }

                     ?>
                   </ul>
                </div>
              </div>
              <input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>">
              <input type="hidden" id="tno" name="tno" value="<?php echo $no; ?>">
              <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">
              <input type="hidden" id="examname" name="examname" value="<?php echo $examname; ?>">
              <input type="hidden" id="totaltime" name="totaltime" value="<?php echo $totaltime; ?>">

              <div class="submitarea" style="position: fixed;width:15%;">
                <center>
                  <a onclick="disableme();" class="btn btn-primary" id="finalsubmit" style="background-color:#4e85c5;color:white;">Submit</a>
                </center>
              </div>
            </div>
          </div>
        <footer>
          <span class="footerid"></span>
        </footer>
    </div>


	<div id="allpagefifth" style="display:none;overflow: hidden;">
        <style type="text/css"> 
          #topheader{
            width:100%;
            background-color:#363636;
            color:yellow;
          }
          
          #subheader{
            width:100%;
            background-color:#BCE8F5;
          }

          #message{

            overflow-y:scroll;
          }

        </style>

        <div class="container-fluid" style="overflow:hidden;margin:0px; padding:0px;">
          <div id="topheader" style="width:100%;"><br><br></div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12" style="padding:0px;margin:0px;padding-left:5px;">
              <div id="subheader" style="padding:1em;margin:0px;width:100%;font-size:20px;">
                <strong>Submit Exam</strong>
              </div>
              <div id="message" style="">
                  <div class="panel panel-default">
                      <div class="panel-body">
                          <div class="col-md-12 text-center">
                              <h4> Thank You, your responses will be submitted for final marking - click OK to complete final submission. <br /> </h4>
                              <input type="submit" onclick="submitexam();" class="btn btn-default btn-lg" id="finalsubmitok" Value="Ok"> <a class="btn btn-default btn-lg" id="btnNoSubmitConfirm" onclick="gotoexamscreen()">Cancel</a>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            </div>
          </div>
        </div>

    </div>
</form>


    <script type="text/javascript">
      var myInterval, AttemptedAns = [],TotalTime = 0;

      function NextQuestion(e) {
          var currentpage = $(".currentpart").val();
          var currentno = $(".part"+currentpage).val();
          var currentqueno = $(".currentqueno").val();
          var noofparts = $(".noofparts").val();

          var currentqueno = $(".currentqueno").val();
          newcurrentqueno = +currentqueno + 1;

          setcurrentqueno(newcurrentqueno);

          var newcurrentpage = +currentpage + 1;
          if(currentqueno == currentno){
            if(newcurrentpage <= noofparts){
                clicksubject(newcurrentpage,'nos'+newcurrentpage);
            }
          }
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
          // CheckNextPrevButtons();
          CheckQueAttemptStatus();

          $(".mytest-ques").click(function(e) {
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
          $('#pallette').addClass('text');
          $('.full_screen').addClass('text');
          $('.collapse_screen').removeClass('text');
      });

      $('.collapse_screen').click(function () {
          $('#quest').removeClass('col-md-12');
          $('#quest').addClass('col-md-10');
          $('#pallette').removeClass('text');
          $('.full_screen').removeClass('text');
          $('.collapse_screen').addClass('text');
      });
    </script>

    <script type="text/javascript">
        $( document ).ready(function() {
           $("#spinner").fadeOut("fast");
        });
    </script>
</body>
<script src="../assets/js/jquery-3.3.1.js"></script>
</html>
