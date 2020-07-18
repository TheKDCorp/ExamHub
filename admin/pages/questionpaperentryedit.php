 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<?php

$qpid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['qpid']))));

$sql = "select * from questionpaper where qpid='$qpid'";
$result = $conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}else{
  echo "No. Record Found!!!";
  exit();
}


 ?>
<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Question Paper Edit");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="card-header">
                  <div><a href="questionpaperentry.php" class="btn btn-info">Que. Paper List</a></div>
                  <hr>
                </div>
                <form action="questionpaperentryeditsubmit.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <label for="name">Paper Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required="true">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                        <label for="totalmarks">Total Marks</label>
                        <input type="number" class="form-control" id="totalmarks" value="<?php echo $row['totalmarks']; ?>" name="totalmarks" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                        <label for="totalquestions">No. Of Questions</label>
                        <input type="number" class="form-control" id="totalquestions" name="totalquestions" value="<?php echo $row['totalquestions']; ?>" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                        <label for="time">Time (In Mins)</label>
                        <input type="number" class="form-control" id="time" name="time" value="<?php echo $row['time']; ?>" required>
                    </div>
                  </div>
                  <br>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="examdate">Exam Date</label>
                          <input type="date" class="form-control" id="examdate" autocomplete="false" name="examdate" value="<?php echo $row['examdate']; ?>" required>
                      </div>
                      <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                          <label for="examtype">Exam Type</label>
                          <select name="examtype" class="form-control" id="examtype">
                              <option value="originaltest" <?php if($row['examtype']=='originaltest'){echo 'selected';} ?>>Original Test</option>
                              <option value="practisetest" <?php if($row['examtype']=='practisetest'){echo 'selected';} ?>>Practise Test</option>
                          </select>
                      </div>
                      <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                          <label for="batch">Batch</label>
                          <select class="form-control" id="batch" name="batch">
                            <option value="all">All</option>
                            <?php
                              $sql1 = "select * from studentbatchentry";
                              $result1=$conn->query($sql1);
                              if($result1->num_rows > 0){
                                while($row1=$result1->fetch_assoc()){
                                  echo '<option value="'.$row1["name"].'"';
                                  if($row1['name']==$row['batch']){echo ' selected ';}
                                  echo '>'.$row1["name"].'</option>';
                                }
                              }
                             ?>
                            </select>
                      </div>
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="screentype">Exam Screen Type:</label>
                          <select class="form-control" id="screentype" name="screentype">
                            <option value="nta" <?php if($row['screentype'] == "nta"){echo " selected";} ?>>N.T.A</option>
                            <option value="digialm" <?php if($row['screentype'] == "digialm"){echo " selected";} ?>>Digialm</option>
                            </select>
                      </div>
                    </div>
                    <br> 
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="shufflequestions">Shuffle Questions:</label>
                          <select class="form-control" id="shufflequestions" name="shufflequestions">
                            <option value="yes" <?php if($row['shufflequestions'] == "yes"){echo " selected";} ?>>Yes</option>
                            <option value="no" <?php if($row['shufflequestions'] == "no"){echo " selected";} ?>>No</option>
                            </select>
                      </div>
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="srnotype">Sr No. Type:</label>
                          <select class="form-control" id="srnotype" name="srnotype">
                            <option value="numbers" <?php if($row['srnotype'] == "numbers"){echo " selected";} ?>>Numbers</option>
                            <option value="alphabets" <?php if($row['srnotype'] == "alphabets"){echo " selected";} ?>>Alphabets</option>
                            </select>
                      </div>
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="noofattempts">No. Of Attempt's (Blank Refers to Infinite)</label>
                          <input type="number" class="form-control" id="noofattempts" autocomplete="false" name="noofattempts" value="<?php echo $row['noofattempts']; ?>">
                      </div>
                    </div>
                    <br>                  
                    <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $row['subject']; ?>" required>
                    </div>
                       <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="qptype">Exam Category</label>
                          <select name="qptype" class="form-control" id="qptype">
                              <option value="JEE-Mains" <?php if($row['qptype']=="JEE-Mains"){echo 'selected';} ?>>JEE-Mains</option>
                              <option value="NEET" <?php if($row['qptype']=="NEET"){echo 'selected';} ?>>NEET</option>
                              <option value="NTSE" <?php if($row['qptype']=="NTSE"){echo 'selected';} ?>>NTSE</option>
                          </select>
                      </div>
                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                        <label for="noofparts">No. Of Parts</label>
                        <input type="number" class="form-control" id="noofparts" name="noofparts" value="<?php echo $row['noofparts']; ?>" required>
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                        <input type="button" class="form-control btn btn-success" value="Add Fields" style="margin-top:2em;" onclick="addfields($('#noofparts').val())" required>
                    </div>
                  </div>
                  <br>
                  <hr>
                  <div class="parts" id="parts">
                    <?php
                      for($i = 1; $i<=$row['noofparts'];$i++){
                        echo '<div class="row">
                           <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="partname">Part Name: </label><input type="text" class="form-control" name="partname'.$i.'" value="'.$row["part".$i."name"].'"></div>
                           <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="parttopic">Part Topic: </label><input type="text" class="form-control" name="parttopic'.$i.'" value="'.$row["part".$i."topic"].'"></div>
                           <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="partmarks">Part Marks: </label><input type="number" class="form-control" name="partmarks'.$i.'" value="'.$row["part".$i."marks"].'"></div>
                           <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="partnoofque">No of Que.: </label><input type="number" autocomplete="false" class="form-control" name="partnoofque'.$i.'" value="'.$row["part".$i."noofque"].'"></div>
                        </div>
                        <br>';
                      }
                     ?>
                  </div>
                  <hr>
                  <br>
                  <center>
                    <input type="hidden" name="fields" id="fields" value="<?php echo $row['noofparts']; ?>">

                    <input type="hidden" name="qpid" value="<?php echo $row['qpid']; ?>">
                   <button type="submit" class="btn btn-primary">Submit</button>
                  </center>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>


<script type="text/javascript">
  function addfields(num){

    var rt = $("#fields").val();
    if(rt==""){
      var jt = num;
      for(i=1;i<=num;i++){
        $("#parts").append('<div class="row"><div class="col-lg-4 col-md-4 col-xs-4 col-sm-4"><label for="partname">Part Name: </label><input type="text" class="form-control" name="partname'+i+'"></div><div class="col-lg-4 col-md-4 col-xs-4 col-sm-4"><label for="parttopic">Part Topic: </label><input type="text" class="form-control" name="parttopic'+i+'"></div><div class="col-lg-4 col-md-4 col-xs-4 col-sm-4"><label for="partmarks">Part Marks: </label><input type="text" class="form-control" name="partmarks'+i+'"></div></div><br>');
      }
    }else{
      var record = parseInt($("#fields").val()) + parseInt(1);
      var jt = parseInt($("#fields").val()) + parseInt(num);
      var totalnum = parseInt(record) + parseInt(num);

      for(i=record;i<totalnum;i++){
        $("#parts").append('<div class="row"><div class="col-lg-4 col-md-4 col-xs-4 col-sm-4"><label for="partname">Part Name: </label><input type="text" class="form-control" name="partname'+i+'"></div><div class="col-lg-4 col-md-4 col-xs-4 col-sm-4"><label for="parttopic">Part Topic: </label><input type="text" class="form-control" name="parttopic'+i+'"></div><div class="col-lg-4 col-md-4 col-xs-4 col-sm-4"><label for="partmarks">Part Marks: </label><input type="text" class="form-control" name="partmarks'+i+'"></div></div><br>');
      }
    }
      $("#fields").val(jt);
  }
</script>

  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
