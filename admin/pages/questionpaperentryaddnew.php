 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Question Paper Entry");
});
</script>

<?php
$sql = "SELECT * FROM questionpaper";
$result = $conn->query($sql);
 ?>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form action="questionpaperentryaddnewsubmit.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          <label for="name">Paper Name:</label>
                          <input type="text" class="form-control" autocomplete="false" id="name" name="name" required="true" autofocus="true">
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="totalmarks">Total Marks</label>
                          <input type="number" class="form-control" id="totalmarks" autocomplete="false" name="totalmarks" required>
                      </div>
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="totalquestions">No. Of Questions</label>
                          <input type="number" class="form-control" id="totalquestions" autocomplete="false" name="totalquestions" required>
                      </div>
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="time">Time (In Minutes)</label>
                          <input type="number" class="form-control" id="time" autocomplete="false" name="time" required>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="examdate">Exam Date</label>
                          <input type="date" class="form-control" id="examdate" autocomplete="false" name="examdate" required>
                      </div>
                      <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                          <label for="examtype">Exam Type</label>
                          <select name="examtype" class="form-control" id="examtype">
                              <option value="originaltest">Original Test</option>
                              <?php
                                $sql = "select * from settings limit 1";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                  $row = $result->fetch_assoc();
                                }

                              ?>
                              <?php if($row['practisetestallowed']=="true"){?>
                                <option value="practisetest">Practise Test</option>
                              <?php } ?>
                          </select>
                      </div>
                      <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                          <label for="batch">Batch</label>
                          <select class="form-control" id="batch" name="batch">
                            <option value="all">All</option>
                            <?php
                              $sql = "select * from studentbatchentry";
                              $result=$conn->query($sql);
                              if($result->num_rows > 0){
                                while($row=$result->fetch_assoc()){
                                  echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                }
                              }
                             ?>
                            </select>
                      </div>
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="screentype">Exam Screen Type:</label>
                          <select class="form-control" id="screentype" name="screentype">
                            <option value="nta">N.T.A</option>
                            <option value="digialm">Digialm</option>
                            </select>
                      </div>
                    </div>
                    <br>                   
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="shufflequestions">Shuffle Questions:</label>
                          <select class="form-control" id="shufflequestions" name="shufflequestions">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                          </select>
                      </div>
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="srnotype">Sr No. Type:</label>
                          <select class="form-control" id="srnotype" name="srnotype">
                            <option value="numbers">Numbers</option>
                            <option value="alphabets">Alphabets</option>
                          </select>
                      </div>
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="noofattempts">No. Of Attempt's (Blank Refers to Infinite)</label>
                          <input type="number" class="form-control" id="noofattempts" autocomplete="false" name="noofattempts">
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="subject">Subject</label>
                          <input type="text" class="form-control" id="subject" autocomplete="false" name="subject" required>
                      </div>
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="qptype">Exam Category</label>
                          <select name="qptype" class="form-control" id="qptype">
                              <option value="JEE-Mains" selected>JEE-Mains</option>
                              <option value="NEET">NEET</option>
                              <option value="NTSE">NTSE</option>
                          </select>
                      </div>

                      <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                          <label for="noofparts">No. Of Parts</label>
                          <input type="number" class="form-control" id="noofparts" autocomplete="false" name="noofparts" required>
                      </div>
                      <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                          <input type="button" class="form-control btn btn-info" autocomplete="false" value="Add Fields" style="margin-top:2em;" onclick="addfields($('#noofparts').val())" required>
                      </div>
                    </div>
                    <br>
                    <hr>
                    <div class="parts" id="parts">

                    </div>

                    <hr>
                    <br>
                    <center>
                      <input type="hidden" name="fields" id="fields" value="">
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
        $("#parts").append('<div class="row"><div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="partname">Part Name: </label><input type="text" autocomplete="false" class="form-control" name="partname'+i+'"></div><div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="parttopic">Part Topic: </label><input type="text" autocomplete="false" class="form-control" name="parttopic'+i+'"></div><div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="partmarks">Part Marks: </label><input type="number" autocomplete="false" class="form-control" name="partmarks'+i+'"></div><div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="partnoofque">No of Que.: </label><input type="number" autocomplete="false" class="form-control" name="partnoofque'+i+'"></div></div><br>');
      }
    }else{
      var record = parseInt($("#fields").val()) + parseInt(1);
      var jt = parseInt($("#fields").val()) + parseInt(num);
      var totalnum = parseInt(record) + parseInt(num);

      for(i=record;i<totalnum;i++){
        $("#parts").append('<div class="row"><div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="partname">Part Name: </label><input type="text" autocomplete="false" class="form-control" name="partname'+i+'"></div><div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="parttopic">Part Topic: </label><input type="text" autocomplete="false" class="form-control" name="parttopic'+i+'"></div><div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="partmarks">Part Marks: </label><input type="number" autocomplete="false" class="form-control" name="partmarks'+i+'"></div><div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label for="partnoofque">No of Que.: </label><input type="number" autocomplete="false" class="form-control" name="partnoofque'+i+'"></div></div><br>');
      }
    }
      $("#fields").val(jt);
  }
</script>

  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
