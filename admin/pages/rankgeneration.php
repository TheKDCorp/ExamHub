
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');

  $qpid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['qpid']))));
  $type=addslashes(htmlspecialchars($_GET['type'],ENT_QUOTES));
  
  $sql = "select * from questionpaper where qpid='$qpid'";
  $result=$conn->query($sql);
  if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $qpname=$row['name'];
  }


  $sql = "select * from results where examname='$qpname' order by mymarks desc";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    $rank = 0;
    while($row=$result->fetch_assoc()){
      $rank = $rank + 1;
      $cid = $row['cid'];
      $studentname = $row['studentname'];
      $qindex = $row['qindex'];
      $examname = $row['examname'];
      $resultid = $row['rid'];

      $sqll1="DELETE from resultrank where resultid='$resultid'";
      $conn->query($sqll1);

      $sql5 = "select * from questionpaper where name='$examname'";
      $result5=$conn->query($sql5);
      if($result5->num_rows > 0){
        $row5 = $result5->fetch_assoc();
        $qpid=$row5['qpid'];
      }

      $examid = $qpid;

      $sql1 = "INSERT INTO resultrank(rankid,cid,studentname,qindex,examname,examid,rank,resultid)VALUES(DEFAULT,'$cid','$studentname','$qindex','$examname','$examid','$rank','$resultid')";
      $conn->query($sql1);
    }
  }
  ?>






<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Rank Generation");
});
</script>

<script type="text/javascript">
$(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
                    buttons: [
                  {
                    extend: 'colvis'
                  },{
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
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="card-header">
                  <!-- <div><a href="rankgenerationsubjectwise.php?qpid=<?php echo $qpid; ?>" class="btn btn-info">Subject Wise</a></div>     -->
                  <?php
                    if($type=="a512311409b3798234b19649fa105a27"){
                       echo '<a href="./practiseresults.php" class="btn btn-warning">All Results</a>';
                    }elseif($type=="c08beeed313883b21aadc5a8068f7ba5"){
                      echo '<a href="./results.php" class="btn btn-warning">All Results</a>';
                    }else{
                      $examtype="not defined";
                    }
                   ?>
                     <?php echo '<a href="trackusers.php?en='.$examname.'&type='.md5($type).'" class="btn btn-primary">Track Users</a>';?>
                  
                  <hr>
                </div>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;min-height:800px">
                  
                  <?php 
                    $sql = "SELECT * FROM resultrank";
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
                              $resultid=$row['resultid'];
                              
                              $sql1 = "select * from students where sid='$cid'";
                              $result1 = $conn->query($sql1);
                              if($result1->num_rows > 0){
                                $row1 = $result1->fetch_assoc();
                                $mobileno = $row1['mobileno'];
                              }

                              $sql1 = "select * from results where rid='$resultid'";
                              $result1 = $conn->query($sql1);
                              if($result1->num_rows > 0){
                                $row1 = $result1->fetch_assoc();
                                $examname = $row1['examname'];
                                $cid = $row1['cid'];
                                $qindex = $row1['qindex'];
                                $mymarks = $row1['mymarks'];
                                $correct = $row1['correctquestions'];
                                $incorrect = $row1['incorrectquestions'];
                                $blank = $row1['blank'];
                                $percent = $row1['mypercentile'];
                                $totalmarks = $row1['totalmarks'];
                                $date= $row1['date'];
                                $studentname= $row1['studentname'];
                              }

                             $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='Physics'";
                              $result1 = $conn->query($sql1);
                              if($result1->num_rows > 0){
                                $row1 = $result1->fetch_assoc();
                                $phymarks = $row1['mymarks'];
                                $phycorrect = $row1['questionscorrect'];
                                $phyincorrect = $row1['questionsincorrect'];
                              }

                              $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='Chemistry'";
                              $result1 = $conn->query($sql1);
                              if($result1->num_rows > 0){
                                $row1 = $result1->fetch_assoc();
                                $chemmarks = $row1['mymarks'];
                                $chemcorrect = $row1['questionscorrect'];
                                $chemincorrect = $row1['questionsincorrect'];
                              }

                              $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='Maths'";
                              $result1 = $conn->query($sql1);
                              if($result1->num_rows > 0){
                                $row1 = $result1->fetch_assoc();
                                $mathsmarks = $row1['mymarks'];
                                $mathscorrect = $row1['questionscorrect'];
                                $mathsincorrect = $row1['questionsincorrect'];
                              }

                              echo "<tr><td>" . $srno . "</td>"."<td>" . $studentname . "</td>" ."<td>" . $row['examname'] . "</td>" ."<td>" . date("d-m-Y", strtotime($date)) . "</td>" ."<td>" . $totalmarks . "</td>" ."<td>" . $correct . "</td>" ."<td>". $incorrect . "</td>" ."<td>" . $blank . "</td>" ."<td>" . $phycorrect . "</td>" ."<td>" . $phyincorrect . "</td>" ."<td>" . $phymarks . "</td>" ."<td>" . $chemcorrect . "</td>" ."<td>" . $chemincorrect . "</td>" ."<td>" . $chemmarks . "</td>" ."<td>" . $mathscorrect . "</td>" ."<td>" . $mathsincorrect . "</td>" ."<td>" . $mathsmarks . "</td>" ."</td>" ."<td>" . $mymarks . "</td>"."<td>".$percent."</td>"."<td><a href='examviewdashboard.php?id=".$row['cid']."&qindex=".$row['qindex']."&examname=".$row['examname']."' class='btn btn-info'>View</a></td></tr>";
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
