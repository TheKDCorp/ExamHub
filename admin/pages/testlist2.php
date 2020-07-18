
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');

  $examname=addslashes(htmlspecialchars($_GET['en'],ENT_QUOTES));
  $type=addslashes(htmlspecialchars($_GET['type'],ENT_QUOTES));
  $cid=addslashes(htmlspecialchars($_GET['id'],ENT_QUOTES));

  if ($type==""){
    echo "Please Choose Test Type";
    exit();
  }

  if($type=="a512311409b3798234b19649fa105a27"){
     $type="practisetest";
  }elseif($type=="c08beeed313883b21aadc5a8068f7ba5"){
    $type="originaltest";
  }else{
    $type="not defined";
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


  ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Exam Attempts");
});
</script>

<script type="text/javascript">
$(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
                  buttons: [
                  {
                    extend: 'colvis'
                  },
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                    }
                },

            ],
            "columnDefs": [
              { "visible": false, "targets": [7,8,9,11,12,14,15] }
            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
    });
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <div>
                  <?php
                    if($type=="practisetest"){
                       echo '<a href="./practiseresults.php" class="btn btn-warning">All Results</a>';
                    }elseif($type=="originaltest"){
                      echo '<a href="./results.php" class="btn btn-warning">All Results</a>';
                    }else{
                      $examtype="not defined";
                    }
                   ?>
                     <?php echo '<a href="trackusers.php?en='.$examname.'&type='.md5($type).'" class="btn btn-primary">Track Users</a>';?>
                  </div>
                  <hr>
              <div class="card-body">
                <div class="table-responsive" style="overflow-y:scroll;padding-left:20px;min-height:800px;">
                  <?php 
                    $sql = "SELECT * FROM results where examname='$examname' and examtype='$type' and cid='$cid'";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                      <tr>
                        <td colspan="8"></td>
                        <td colspan="3">Physics</td>
                        <td colspan="3">Chemistry</td>
                        <td colspan="3">Maths</td>
                        <td colspan="3"></td>
                      </tr>
                        <tr>
                          <th>Id</th>
                          <th>Student Name</th>
                          <th>Exam Name</th>
                          <th>Date</th>
                          <th>Total Marks</th>
                          <th>Correct</th>
                          <th>Incorrect</th>
                          <th>Blank</th>
                          
                          <th>Correct Q.</th>
                          <th>Incorrect Q.</th>
                          <th>Marks</th>

                          <th>Correct Q.</th>
                          <th>Incorrect Q.</th>
                          <th>Marks</th>

                          <th>Correct Q.</th>
                          <th>Incorrect Q.</th>
                          <th>Marks</th>

                          <th>Marks Obtained</th>
                          <th>Percentile</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            if($result->num_rows > 0) {
                              $srno = 0;
                            while($row = $result->fetch_assoc()) {

                              $srno = $srno + 1;

                              $cid = $row['cid'];
                              $qindex = $row['qindex'];
                              $examname = $row['examname'];

                              $samplesql = "select * from questionpaper where name = '$examname'";
                              $sampleresult = $conn->query($samplesql);
                              if($sampleresult->num_rows > 0){
                                $samplerow = $sampleresult->fetch_assoc();
                                $part1name = $samplerow['part1name'];
                                $part2name = $samplerow['part2name'];
                                $part3name = $samplerow['part3name'];
                              }

                              $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='".$part1name."'";
                              $result1 = $conn->query($sql1);
                              if($result1->num_rows > 0){
                                $row1 = $result1->fetch_assoc();
                                $phymarks = $row1['mymarks'];
                                $phycorrect = $row1['questionscorrect'];
                                $phyincorrect = $row1['questionsincorrect'];
                              }

                              $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='".$part2name."'";
                              $result1 = $conn->query($sql1);
                              if($result1->num_rows > 0){
                                $row1 = $result1->fetch_assoc();
                                $chemmarks = $row1['mymarks'];
                                $chemcorrect = $row1['questionscorrect'];
                                $chemincorrect = $row1['questionsincorrect'];
                              }

                              $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='".$part3name."'";
                              $result1 = $conn->query($sql1);
                              if($result1->num_rows > 0){
                                $row1 = $result1->fetch_assoc();
                                $mathsmarks = $row1['mymarks'];
                                $mathscorrect = $row1['questionscorrect'];
                                $mathsincorrect = $row1['questionsincorrect'];
                              }

                                echo "<tr><td>" . $srno . "</td>"."<td>" . $row['studentname'] . "</td>" ."<td>" . $row['examname'] . "</td>" ."<td>" . date("d-m-Y", strtotime($row['date'])) . "</td>" ."<td>" . $row['totalmarks'] . "</td>" ."<td>" . $row['correctquestions'] . "</td>" ."<td>". $row['incorrectquestions'] . "</td>" ."<td>" . $row['blank'] . "</td>" ."<td>" . $phycorrect . "</td>" ."<td>" . $phyincorrect . "</td>" ."<td>" . $phymarks . "</td>" ."<td>" . $chemcorrect . "</td>" ."<td>" . $chemincorrect . "</td>" ."<td>" . $chemmarks . "</td>" ."<td>" . $mathscorrect . "</td>" ."<td>" . $mathsincorrect . "</td>" ."<td>" . $mathsmarks . "</td>" ."</td>" ."<td>" . $row['mymarks'] . "</td>"."<td>" . $row['mypercentile'] . "</td>"."<td><a href='examviewdashboard.php?id=".$row['cid']."&qindex=".$row['qindex']."&examname=".$row['examname']."' class='btn btn-info'>View</a></td></tr>";
                            
                          }
                      } 
                    ?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  <?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>
