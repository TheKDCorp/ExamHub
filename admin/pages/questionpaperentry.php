
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');
  ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Question Paper List");
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
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                },

            ],
            "columnDefs": [
              { "visible": false, "targets": [5,6,7] }
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
              <div class="card-body" style="min-height:60em;">
                <div class="card-header">
                  <div><a href="questionpaperentryaddnew.php" class="btn btn-primary">Add New</a></div>    
                  <hr>              
                </div>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">
                  
                  <?php 
                    $sql = "SELECT * FROM questionpaper where error='false' order by qpid desc";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                         <tr>
                          <th>Q.P. ID</th>
                          <th>Name</th>
                          <th>Total Marks</th>
                          <th>No. Of Que</th>
                          <th>Time</th>
                          <th>Subject</th>
                          <th>Noofattempts</th>
                          <th>Visible</th>
                          <th>Exam Date</th>
                          <th>Exam Type</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                          if ($result->num_rows > 0) {
                            $srno = 0;

                            $sql = "select * from settings limit 1";
                            $rs1=$conn->query($sql);
                            if($rs1->num_rows > 0){
                              $settings = $rs1->fetch_assoc();
                            }
                            
                            if($settings['practisetestallowed']=="true"){
                              while($row = $result->fetch_assoc()) {
                                  $srno = $srno + 1;
                                  if($row['hidden']=='true'){
                                    $visible = "False";
                                   }else{
                                    $visible = "True";
                                   }
                                  echo "<tr><td>" . $srno . "</td>" ."<td>" . $row['name'] . "</td>" ."<td>" . $row['totalmarks'] . "</td>" ."<td>" . $row['totalquestions'] . "</td>" ."<td>" . $row['time']."<td>" . $row['subject'] ."</td>"."<td>" . $row['noofattempts'] ."</td>"."<td>" . $visible ."</td>"."<td>" . date("d-m-Y", strtotime($row['examdate'])) . "</td>" ."<td>" . $row['examtype'] . "</td>"."<td><a href='questionpaperentryedit.php?qpid=".$row['qpid']."' class='btn btn-info'>Edit</a>&nbsp&nbsp&nbsp<a href='questionpaperentrydelete.php?qpid=".$row['qpid']."' class='btn btn-danger'>Delete</a>&nbsp&nbsp&nbsp";
                                    if($row['examtype']=='originaltest'){
                                      echo "<a href='converttopractise.php?qpid=".$row['qpid']."' class='btn btn-info'>Convert To Practise Test</a>";
                                    }elseif($row['examtype']=='practisetest'){
                                      echo "<a href='converttooriginal.php?qpid=".$row['qpid']."' class='btn btn-info'>Convert To Original Test</a>";
                                    }
                                    if($row['hidden']=="true"){
                                      echo "<a href='publishtest.php?qpid=".$row['qpid']."' class='btn btn-info'>Publish Exam</a>&nbsp&nbsp&nbsp";
                                    }else{
                                      echo "<a href='unpublishtest.php?qpid=".$row['qpid']."' class='btn btn-info'>UnPublish Exam</a>&nbsp&nbsp&nbsp";
                                      echo "<a href='generateresult.php?en=".$row['name']."&type=".'originaltest'."' class='btn btn-info'>Publish Result</a>";
                                    }
                                  echo "</td></tr>";
                              }
                            }else{
                              while($row = $result->fetch_assoc()) {
                                if($row['examtype']=="practisetest"){
                                }else{
                                   $srno = $srno + 1;
                                   if($row['hidden']=='true'){
                                    $visible = "False";
                                   }else{
                                    $visible = "True";
                                   }
                                    echo "<tr><td>" . $srno . "</td>" ."<td>" . $row['name'] . "</td>" ."<td>" . $row['totalmarks'] . "</td>" ."<td>" . $row['totalquestions'] . "</td>" ."<td>" . $row['time'] . "</td>"."<td>" . $row['subject'] ."</td>"."<td>" . $row['noofattempts'] ."</td>"."<td>" . $visible ."</td>"."<td>" . date("d-m-Y", strtotime($row['examdate'])) . "</td>" ."<td>" . $row['examtype'] . "</td><td><a href='questionpaperentryedit.php?qpid=".$row['qpid']."' class='btn btn-info'>Edit</a>&nbsp&nbsp&nbsp<a href='questionpaperentrydelete.php?qpid=".$row['qpid']."' class='btn btn-danger'>Delete</a>&nbsp&nbsp&nbsp<a href='generateanswerkey.php?qpid=".$row['qpid']."' class='btn btn-info'>Answer Key</a>&nbsp&nbsp&nbsp<a href='questionentryforexam.php?qpid=".$row['qpid']."' class='btn btn-info'>Question Entry</a>&nbsp&nbsp&nbsp";
                                    if($row['hidden']=="true"){
                                      echo "<a href='publishtest.php?qpid=".$row['qpid']."' class='btn btn-info'>Publish Exam</a>&nbsp&nbsp&nbsp";
                                    }else{
                                      echo "<a href='unpublishtest.php?qpid=".$row['qpid']."' class='btn btn-info'>UnPublish Exam</a>&nbsp&nbsp&nbsp";
                                      echo "<a href='generateresult.php?en=".$row['name']."&type=".'originaltest'."' class='btn btn-info'>Publish Result</a>";
                                    }
                                    echo "</td></tr>";
                                }
                                
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
