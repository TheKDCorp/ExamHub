  <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<?php 

$sid = htmlspecialchars($_POST['cid'],ENT_QUOTES);
$username = htmlspecialchars($_POST['username'],ENT_QUOTES);
$oldusername = htmlspecialchars($_POST['oldusername'],ENT_QUOTES);
$password = htmlspecialchars($_POST['password'],ENT_QUOTES);

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
	$sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Profile Username|Password Updated','$timestamp')";
	$conn->query($sql);
  }
  if($settings['tracking']=="true"){
    $sql = "update students set page='Profile Submit' where sid='$sid'";
    $conn->query($sql);
  }
}

?>

<script>
	function updatepage(){
      var mysid=<?php echo $sid; ?>;
      var page="Profile Submit";
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

<?php


if($oldusername == $username){
	$sql = "UPDATE students SET password='$password',updated='true' where sid='$sid'";
	$conn->query($sql);
}else{
	$sql = "SELECT * FROM students where username='$username'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		?>
		<div class="panel-header panel-header-sm">
	    </div>
	      <div class="content">
	        <div class="row">
	          <div class="col-md-12">
	            <div class="card">
	              <div class="card-body">
	              	Username is used by someone else... Please use different Username !
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>

		<?php
		exit();
	}else{

		$sql = "select * from students where sid = '$sid'";
		$result=$conn->query($sql);
		if($result->num_rows > 0){
		  $row = $result->fetch_assoc();
		  $previouspassword = $row['password'];
		}else{
		  echo "No. Record Found!!!";
		  exit();
		}

		$sql = "UPDATE students SET password='$password',updated='true' where sid='$sid'";
		$conn->query($sql);
	}
}
 ?>

 <script type="text/javascript">
  window.location = "profile.php";
</script>