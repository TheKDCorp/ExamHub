
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');

  $examname=addslashes(htmlspecialchars($_GET['en'],ENT_QUOTES));
  $type=addslashes(htmlspecialchars($_GET['type'],ENT_QUOTES));

  if ($type==""){
    echo "Please Choose Test Type";
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

<?php 
  $sql2 = "select * from questionpaper where name='$examname' and examtype='$type'";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();
  $noofparts = $row2['noofparts'] * 3;
  $novisible = "";
  for($jj=1;$jj <= $noofparts;$jj++){
    if($jj=="1"){
      $mynovisible = 10+$jj;
      $novisible = "".$mynovisible;
    }else{
      if($jj%3=="0"){ 

      }else{
        $mynovisible = 10+$jj;
        $novisible = $novisible .",". $mynovisible;
      } 
    }
  }
?>

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
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                      columns: ':visible',
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                      columns: ':visible'
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                      columns: ':visible'
                    }
                },

            ],
            "columnDefs": [
              { "visible": false, "targets": [<?php echo $novisible; ?>] }
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
              <div class="card-body" style="min-height:60em;">
                <div class="table-responsive" style="overflow-y:scroll;padding-left:20px;min-height:800px;">
                  <?php 
                    $sql = "SELECT * FROM results where examname='$examname' and examtype='$type'";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                      <tr>
                        <td colspan="11"></td>
                        <?php 
                            $sql2 = "select * from questionpaper where name='$examname' and examtype='$type'";
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();
                            $noofparts = $row2['noofparts'];
                            for($jj=1;$jj <= $noofparts;$jj++){
                              echo "<td colspan='3'>".$row2['part'.$jj.'name']."</td>";
                            }
                           ?>
                        <td colspan="3"></td>
                      </tr>
                        <tr>
                          <th>Id</th>
                          <th>Student Name</th>
                          <th>Mobile No</th>
                          <th>Class</th>
                          <th>Section</th>
                          <th>Exam Name</th>
                          <th>Date</th>
                          <th>Total Marks</th>
                          <th>Correct Ans.</th>
                          <th>Incorrect Ans.</th>
                          <th>Blank</th>
                          
                         <?php 
                            $sql2 = "select * from questionpaper where name='$examname' and examtype='$type'";
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();
                            $noofparts = $row2['noofparts'];
                            for($jj=1;$jj <= $noofparts;$jj++){
                              echo "<th>Correct Ans.</th>
                                    <th>Incorrect Ans.</th>
                                    <th>Marks</th>";
                            }
                           ?>

                          <th>Marks Obtained</th>
                          <th>Percentage</th>
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
                              $sqlstudent = "select * from students where sid='$cid'";
                              $resultstudent = $conn->query($sqlstudent);
                              if($resultstudent->num_rows > 0){
                                $rowstudent = $resultstudent->fetch_assoc();
                                $mobileno = $rowstudent['mobileno'];
                                $class = $rowstudent['class'];
                                $section = $rowstudent['section'];
                              }else{

                              }
                                $qindex = $row['qindex'];
                                $examname = $row['examname'];
                              echo "<tr><td>" . $srno . "</td>"."<td>" . $row['studentname'] . "</td>" ."<td>" . $mobileno . "</td>" ."<td>" . $class . "</td>". "<td>" . $section . "</td>" ."<td>" . $row['examname'] . "</td>" ."<td>" . date("d-m-Y", strtotime($row['date'])) . "</td>" ."<td>" . $row['totalmarks'] . "</td>" ."<td>" . $row['correctquestions'] . "</td>" ."<td>". $row['incorrectquestions'] . "</td>" ."<td>" . $row['blank'] . "</td>";
                              
                              $sql2 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and examtype='$type'";
                              $result2 = $conn->query($sql2);
                              while($row2=$result2->fetch_assoc()){
                                echo "<td>" . $row2['questionscorrect'] . "</td>" ."<td>" . $row2['questionsincorrect'] . "</td>" . "<td>" . $row2['mymarks'] . "</td>";
                              } 

                              echo "<td>" . $row['mymarks'] . "</td>"."<td>" . $row['mypercentile'] . "</td>"."<td><a href='examviewdashboard.php?id=".$row['cid']."&qindex=".$row['qindex']."&examname=".$row['examname']."' class='btn btn-info'>View</a></td></tr>";
                            
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