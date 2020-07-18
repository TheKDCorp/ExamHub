
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');
  ?>


 <?php 

$sid = $_COOKIE["user_id"];

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
    $sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Clicked Original Test Results','$timestamp')";
    $conn->query($sql);
  }
  if($settings['tracking']=="true"){
    $sql = "update students set page='Previous Test List' where sid='$sid'";
    $conn->query($sql);
  }
}

 ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Exam History");
});

    function updatepage(){
      var mysid=<?php echo $sid; ?>;
      var page="Previous Test List";
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
$(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
                    buttons: [
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
                <center><h2 class="text">Original Exam</h2></center>
                      <hr>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">
                  <?php 
                    $cid = $sid;
                    $sql = "SELECT * FROM results where cid='$cid' and examtype='originaltest' group by(examname) order by rid desc";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                      
                        <tr>
                          <th>Id</th>
                          <th>Exam Name</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            if($result->num_rows > 0) {
                              $examno=0;
                            while($row = $result->fetch_assoc()) {
                              $examno = $examno + 1;
                                echo "<tr><td>" . $examno . "</td>"."<td>" . $row['examname'] . "</td><td><a href='testlist.php?en=".md5($row['examname'])."&type=".md5('originaltest')."' class='btn btn-info'>List Attempts</a></td></tr>";
                            
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
