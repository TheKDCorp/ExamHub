 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>
<?php
$cid = $_COOKIE['user_id'];
$batch = $_COOKIE['user_batch'];
$sid = $cid;

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
    $sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Clicked Mock Test','$timestamp')";
    $conn->query($sql);
  }
  if($settings['tracking']=="true"){
    $sql = "update students set page='Choose Exam' where sid='$sid'";
    $conn->query($sql);
  }
}
?>


<?php
  $sql = "select * from settings limit 1";
  $rs1=$conn->query($sql);
  if($rs1->num_rows > 0){
    $settings = $rs1->fetch_assoc();
  }
 ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Mock Test");
});


   function updatepage(){
      var mysid=<?php echo $sid; ?>;
      var page="Choose Exam";
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

<script type="text/javascript">
  function gotolink(elink){
    
    window.open (elink,"mywindow","status=1,toolbar=0");

  }
</script>


      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
               	<center>
                  <h3>Please Choose Exam To Continue...</h3>
                  <br>
                  <hr>
                  <br>
                  <div class="row">
                    <div class="<?php if($settings['practisetestallowed']=="true"){echo 'col-sm-6';}else{echo 'col-sm-12';} ?>">
                      <center>
                        <h4>Original Test</h4>
                      </center>
                      <hr>
                      <table class="table table-bordered table-striped" style="max-height: 200px;">
                        <tr>
                          <th>Exam Name</th>
                          <th>Date</th>
                          <th>Function</th>
                        </tr>
                        <?php
                        $sql = "select * from questionpaper where examtype='originaltest' and hidden='false' and error='false' order by examdate desc";
                          $result = $conn->query($sql);
                          if($result->num_rows > 0){
                              while($row = $result->fetch_assoc()) {
                                $attempts = $row['noofattempts'];
                                $examtype = $row['examtype'];
                                $examname = $row['name'];
                                $exambatch = $row['batch'];
                                $screentype = $row['screentype'];

                                $sqlyyy      = "select * from testcontinue where examname='$examname' and studentid='$cid' and examtype='$examtype' order by attid desc";

                                $resultyyy=$conn->query($sqlyyy);
                                if($resultyyy->num_rows > 0){
                                  $getanswer = "true";
                                  if($exambatch=="all" OR $batch=="none"){
                                    ?>
                                    <tr>
                                      <td><?php echo $row['name']; ?></td>
                                      <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                      <?php
                                        if($screentype=="nta"){
                                          ?><td><a onclick="gotolink('examnta.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("nta"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="digialm"){
                                          ?><td><a onclick="gotolink('examdigialm.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("digialm"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="self"){
                                          ?><td><a onclick="gotolink('examself.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("self"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }
                                       ?>
                                    </tr>
                                    <?php
                                  }elseif($exambatch==$batch){
                                    ?>
                                    <tr>
                                      <td><?php echo $row['name']; ?></td>
                                      <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                      <?php
                                        if($screentype=="nta"){
                                          ?><td><a onclick="gotolink('examnta.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("nta"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="digialm"){
                                          ?><td><a onclick="gotolink('examdigialm.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("digialm"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="self"){
                                          ?><td><a onclick="gotolink('examself.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("self"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }
                                       ?>
                                    </tr>
                                    <?php
                                  }else{

                                  }
                                }else{
                                  $getanswer = "false";
                                  if($attempts == "0"){
                                    if($exambatch=="all" OR $batch=="none"){
                                      ?>
                                      <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                        <?php
                                        if($screentype=="nta"){
                                          ?><td><a onclick="gotolink('examnta.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("nta"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="digialm"){
                                          ?><td><a onclick="gotolink('examdigialm.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("digialm"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="self"){
                                          ?><td><a onclick="gotolink('examself.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("self"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }
                                       ?>
                                      </tr>
                                      <?php
                                    }elseif($exambatch==$batch){
                                      ?>
                                      <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                        <?php
                                        if($screentype=="nta"){
                                          ?><td><a onclick="gotolink('examnta.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("nta"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="digialm"){
                                          ?><td><a onclick="gotolink('examdigialm.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("digialm"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="self"){
                                          ?><td><a onclick="gotolink('examself.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("self"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }
                                       ?>
                                      </tr>
                                      <?php
                                    }else{
                                    }
                                  }else{
                                    $sql11 = "select * from examattempted where examname='".$row['name']."' and studentid='$cid'";

                                    $result11 = $conn->query($sql11);
                                    if($result11->num_rows >= $attempts){
                                    }else{
                                      if($exambatch=="all" OR $batch=="none"){
                                        ?>
                                        <tr>
                                          <td><?php echo $row['name']; ?></td>
                                          <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                          <?php
                                        if($screentype=="nta"){
                                          ?><td><a onclick="gotolink('examnta.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("nta"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="digialm"){
                                          ?><td><a onclick="gotolink('examdigialm.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("digialm"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }elseif($screentype=="self"){
                                          ?><td><a onclick="gotolink('examself.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("self"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        <?php
                                        }
                                       ?>
                                        </tr>
                                        <?php
                                      }elseif($exambatch==$batch){
                                        ?>
                                        <tr>
                                          <td><?php echo $row['name']; ?></td>
                                          <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                          <?php
                                          if($screentype=="nta"){
                                            ?><td><a onclick="gotolink('examnta.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("nta"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                          <?php
                                          }elseif($screentype=="digialm"){
                                            ?><td><a onclick="gotolink('examdigialm.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("digialm"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                          <?php
                                          }elseif($screentype=="self"){
                                            ?><td><a onclick="gotolink('examself.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("originaltest"); ?>&stype=<?php echo md5("self"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                          <?php
                                          }
                                         ?>
                                          
                                        </tr>
                                        <?php
                                      }else{

                                      }
                                    }
                                  }
                                }
                            }
                          }
                         ?>
                      </table>
                    </div>
                    <?php
                      if($settings['practisetestallowed'] == "true"){
                        ?>
                    <div class="col-sm-6">
                      <center>
                        <h4>Practise Test</h4>
                      </center>
                      <hr>
                      <table class="table table-bordered table-striped" style="max-height: 200px;">
                        <tr>
                          <th>Exam Name</th>
                          <th>Date</th>
                          <th>Function</th>
                        </tr>
                        <?php
                        $sql = "select * from questionpaper where examtype='practisetest' and hidden='false' and error='false' order by examdate desc";
                          $result = $conn->query($sql);
                          if($result->num_rows > 0){
                              while($row = $result->fetch_assoc()) {
                                $attempts = $row['noofattempts'];
                                $examtype = $row['examtype'];
                                $examname = $row['name'];
                                $exambatch = $row['batch'];

                                $sqlyyy      = "select * from testcontinue where examname='$examname' and studentid='$cid' and examtype='$examtype' order by attid desc";
                                $resultyyy=$conn->query($sqlyyy);
                                if($resultyyy->num_rows > 0){
                                  $getanswer = "true";
                                  if($exambatch=="all" OR $batch=="none"){
                                    ?>
                                    <tr>
                                      <td><?php echo $row['name']; ?></td>
                                      <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                      <td><a onclick="gotolink('exam.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("practisetest"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                    </tr>
                                    <?php
                                  }elseif($exambatch==$batch){
                                    ?>
                                    <tr>
                                      <td><?php echo $row['name']; ?></td>
                                      <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                      <td><a onclick="gotolink('exam.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("practisetest"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                    </tr>
                                    <?php
                                  }else{

                                  }
                                  ?>

                                  <?php
                                }else{
                                  $getanswer = "false";
                                  if($attempts == "0"){
                                    if($exambatch=="all" OR $batch=="none"){
                                      ?>
                                      <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                        <td><a onclick="gotolink('exam.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("practisetest"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                      </tr>
                                      <?php
                                    }elseif($exambatch==$batch){
                                      ?>
                                      <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                        <td><a onclick="gotolink('exam.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("practisetest"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                      </tr>
                                      <?php
                                    }else{

                                    }
                                  }else{
                                    $sql11 = "select * from examattempted where examname='".$row['name']."' and studentid='$cid'";
                                    $result11 = $conn->query($sql11);
                                    if($result11->num_rows >= $attempts){
                                    }else{
                                      if($exambatch=="all" OR $batch=="none"){
                                      ?>
                                      <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                        <td><a onclick="gotolink('exam.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("practisetest"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                      </tr>
                                      <?php
                                      }elseif($exambatch==$batch){
                                        ?>
                                        <tr>
                                          <td><?php echo $row['name']; ?></td>
                                          <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                          <td><a onclick="gotolink('exam.php?en=<?php echo md5($row["name"]); ?>&id=<?php echo md5($row["qpid"]); ?>&type=<?php echo md5("practisetest"); ?>')" style="color:white;" class="btn btn-info"><?php if($getanswer=="true"){echo 'Resume Test';}else{ echo 'Take Test';} ?></a></td>
                                        </tr>
                                        <?php
                                      }else{

                                      }
                                    }
                                  }
                                }
                            }
                          }
                         ?>
                      </table>
                    </div>
                  <?php
                        }
                     ?>
                  </div>
                  <br>
                  <br>

                </center>

              </div>
            </div>
          </div>
        </div>
      </div>

<script type="text/javascript">
    $(document).ready(function() {
      var table = $('#example').dataTable({
        "columnDefs": [{
          "defaultContent": "-",
          "targets": "_all",
        }]
      });
      table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
  });
  </script>

  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
