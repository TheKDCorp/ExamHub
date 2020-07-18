
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
    $("#mytitle").text("Question Bank");
});
</script>
<script type="text/javascript">
  MathJax.Hub.Config({
  tex2jax: {
         inlineMath: [ ['$','$'], ['\\(','\\)'] ]
  }
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
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                    }
                },
            ],
            "columnDefs": [
              { "visible": false, "targets": [2,3,5,7,8,9,10] }
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
                  <div><a href="questionentryaddnew.php" class="btn btn-primary">Add New</a></div>    
                  <hr>              
                </div>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">
                  
                  <?php 
                    $sql = "SELECT * FROM questionentry order by qid desc limit 300";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                         <tr>
                          <th>Q. ID</th>
                          <th>QP. Name</th>
                          <th>Pos. Marks</th>
                          <th>Neg. Marks</th>
                          <th>Part</th>
                          <th>Level</th>
                          <th>Question</th>
                          <th>Option 1</th>
                          <th>Option 2</th>
                          <th>Option 3</th>
                          <th>Option 4</th>
                          <th>Correct Answer</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            if ($result->num_rows > 0) {
                              $srno=0;
                            while($row = $result->fetch_assoc()) {
                              $srno = $srno + 1;
                              
                                $correctanswer=$row['correctoption'];
                                $qpid=$row['qpid'];
                               
                                $sql = "select * from settings limit 1";
                                $rs1=$conn->query($sql);
                                if($rs1->num_rows > 0){
                                  $settings = $rs1->fetch_assoc();
                                }

                                if($settings['srnotype']=="alphabets"){
                                  if($correctanswer=="1"){
                                    $correctoption=strtoupper("a");
                                  }elseif($correctanswer=="2"){
                                    $correctoption=strtoupper("b");;
                                  }
                                  elseif($correctanswer=="3"){
                                    $correctoption=strtoupper("c");;
                                  }
                                  elseif($correctanswer=="4"){
                                    $correctoption=strtoupper("d");;
                                  }
                                }else{
                                  $correctoption=$correctanswer;
                                }

                                 if($row['question']!=""){
                                  $question = $row['question'];
                                }else{
                                  $question = "<img src='../uploads/questions/".md5($row['imgid']).".jpg'";
                                }

                                if($row['option1']!=""){
                                  $option1 = $row['option1'];
                                }else{
                                  if ($row['opt1img']=="") {
                                    $option1 = "";
                                  }else{
                                    $option1 = "<img src='../uploads/questions/options/".md5($row['opt1img']).".jpg'";
                                  }
                                }

                                if($row['option2']!=""){
                                  $option2 = $row['option2'];
                                }else{
                                  if ($row['opt2img']=="") {
                                    $option2 = "";
                                  }else{
                                    $option2 = "<img src='../uploads/questions/options/".md5($row['opt2img']).".jpg'";
                                  }
                                }

                                if($row['option3']!=""){
                                  $option3 = $row['option3'];
                                }else{
                                  if ($row['opt3img']=="") {
                                    $option3= "";
                                  }else{
                                    $option3 = "<img src='../uploads/questions/options/".md5($row['opt3img']).".jpg'";
                                  }
                                }

                                if($row['option4']!=""){
                                  $option4 = $row['option4'];
                                }else{
                                  if ($row['opt4img']=="") {
                                    $option4 = "";
                                  }else{
                                    $option4 = "<img src='../uploads/questions/options/".md5($row['opt4img']).".jpg'";
                                  }
                                }


                               echo "<tr><td>" . $srno . "</td>" ."<td>".$row['qpname']."</td>"."<td>".$row['positivemarks']."</td>"."<td>".$row['negativemarks']."</td>"."<td>".$row['part']."</td>"."<td>".$row['level']."</td>"."<td>".$question."</td>"."<td>".$option1."</td>"."<td>".$option2."</td>"."<td>".$option3."</td>"."<td>".$option4."</td>"."<td>" . $correctoption . "</td><td><a href='questionentryedit.php?id=".$row['qid']."' class='btn btn-info'>Edit</a>&nbsp&nbsp&nbsp<a href='questionentrydelete.php?id=".$row['qid']."&qpid=".$qpid."' class='btn btn-danger'>Delete</a></td></tr>";
            
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
