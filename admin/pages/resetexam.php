
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');

  $examname=addslashes(htmlspecialchars($_GET['en'],ENT_QUOTES));
  $type=addslashes(htmlspecialchars($_GET['type'],ENT_QUOTES));
  $cid=addslashes(htmlspecialchars($_GET['id'],ENT_QUOTES));
  $qindex=addslashes(htmlspecialchars($_GET['qindex'],ENT_QUOTES));

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


$sql = "delete from answers_new where cid='$cid' and examname='$examname' and examtype='$type' and qindex='$qindex'";
$conn->query($sql);

$sql = "delete from answers where cid='$cid' and examname='$examname' and examtype='$type' and qindex='$qindex'";
$conn->query($sql);

$sql = "delete from partresult where cid='$cid' and examname='$examname' and examtype='$type' and qindex='$qindex'";
$conn->query($sql);

$sql = "delete from results where cid='$cid' and examname='$examname' and examtype='$type' and qindex='$qindex'";
$conn->query($sql);

$sql = "delete from testcontinue where studentid='$cid' and examname='$examname' and examtype='$type' and qindex='$qindex'";
$conn->query($sql);

$sql = "delete from examattempted where studentid='$cid' and examname='$examname' and examtype='$type' and qindex='$qindex'";
$conn->query($sql);

  ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Reset Exam");
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
                     echo '<a href="students.php" class="btn btn-primary">List Students</a>';
                  ?>
                  </div>
                  <hr>
              <div class="card-body">
                <h3>Exam Reset: <span style="color:green">Done!</span></h3>
              </div>
            </div>
          </div>
        </div>
      </div>

  <?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>
