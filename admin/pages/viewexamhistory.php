
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');

  $id=addslashes(htmlspecialchars($_GET['id'],ENT_QUOTES));

  ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Exam History");
});
</script>

<script type="text/javascript">
$(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },

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
              <div class="card-header">
                  <div><a href="students.php" class="btn btn-primary">Students List</a></div>    
                  <hr>              
                </div>
              <div class="card-body">
                <center><h2 class="text">Exam History</h2></center>
                      <hr>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">
                  <?php 

                    $sql = "SELECT * FROM answers_new where cid='$id' group by(examname),(qindex) order by aid desc";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                      
                        <tr>
                          <th>Id</th>
                          <th>Exam Name</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            if($result->num_rows > 0) {
                              $examno=$result->num_rows + 1;
                            while($row = $result->fetch_assoc()) {
                              $examno = $examno - 1;
                              
                              $qpname = $row['examname'];
                              $qindex = $row['qindex'];
                              $examtype = $row['examtype'];
                              $sql2 = "select * from questionpaper where name='$qpname'";
                              $result2=$conn->query($sql2);
                              if($result2->num_rows > 0){
                                $row2 = $result2->fetch_assoc();
                                $qpid = $row2['qpid'];
                              }else{
                                $qpid="";
                              }
                              $cid = $row['cid'];

                              $sql1 = "select * from results where cid='$cid' and examname='$qpname' and qindex='$qindex' and examtype='$examtype'";
                              $result1 = $conn->query($sql1);
                              if($result1->num_rows > 0){
                                $status = "Complete";
                                $rtb = $result1->fetch_assoc();
                                $examdate =date("d-m-Y", strtotime($rtb['date']));
                              }else{
                                $status = "In Complete";
                                $examdate = "";
                              }

                                echo "<tr><td>" . $examno . "</td>"."<td>" . $row['examname'] . "</td>"."<td>" . $examdate . "</td>"."<td>" . $status . "</td>"."<td>";
                                if($status == "Complete"){
                                  echo "<a href='testlist2.php?en=".md5($row['examname'])."&id=".$cid."&type=".md5('originaltest')."' class='btn btn-info'>List Attempts</a>&nbsp&nbsp&nbsp";  
                                  echo "<a href='resetexam.php?en=".md5($row['examname'])."&id=".$cid."&type=".md5('originaltest')."&qindex=".$qindex."' class='btn btn-info'>Reset Exam</a>&nbsp&nbsp&nbsp</tr>";
                                }else{
                                  echo "<a href='resetexam.php?en=".md5($row['examname'])."&id=".$cid."&type=".md5('originaltest')."&qindex=".$qindex."' class='btn btn-info'>Reset Exam</a>&nbsp&nbsp&nbsp</tr>";
                                }
                            
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
