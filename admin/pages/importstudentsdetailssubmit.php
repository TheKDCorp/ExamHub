<?php

  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$class = $_POST['class'];
$section = $_POST['section'];
$fathersname = $_POST['fathersname'];
$mothersname = $_POST['mothersname'];
$mobileno = $_POST['mobileno'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$email = $_POST['email'];
$batch = $_POST['batch'];

$firstno = "true";
if (($handle = fopen("../uploads/studentlist/temporary.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
    	if($firstno=="true"){
    		$firstno = "false";
    		continue;
    	}
    	$sql = "";

        $num = count($data);
    	$sql = 'INSERT INTO students(sid,name,username,password,role,class,section,fathersname,mothersname,mobileno,dob,address,email,loggedin,updated,oldpassword,batch,active) VALUES(DEFAULT,"';
    	if($name=="none"){}else{$sql = $sql . $data[$name];}
    	$sql = $sql . '","';
    	if($username=="none"){}else{$sql = $sql . $data[$username];}
    	$sql = $sql . '","';
    	if($password=="none"){}else{$sql = $sql . $data[$password];}
    	$sql = $sql . '","student","';
    	if($class=="none"){}else{$sql = $sql . $data[$class];}
    	$sql = $sql . '","';
    	if($section=="none"){}else{$sql = $sql . $data[$section];}
    	$sql = $sql . '","';
    	if($fathersname=="none"){}else{$sql = $sql . $data[$fathersname];}
    	$sql = $sql . '","';
    	if($mothersname=="none"){}else{$sql = $sql . $data[$mothersname];}
    	$sql = $sql . '","';
    	if($mobileno=="none"){}else{$sql = $sql . $data[$mobileno];}
    	$sql = $sql . '","';
    	if($dob=="none"){}else{$sql = $sql . $data[$dob];}
    	$sql = $sql . '","';
    	if($address=="none"){}else{$sql = $sql . $data[$address];}
    	$sql = $sql . '","';
    	if($email=="none"){}else{$sql = $sql . $data[$email];}
    	$sql = $sql . '","false","false","';
    	if($password=="none"){}else{$sql = $sql . $data[$password];}
    	$sql = $sql . '","';
    	if($batch=="none"){}else{$sql = $sql . $data[$batch];}
    	$sql = $sql . '","yes")';

    	$conn->query($sql);
    }
    fclose($handle);
}

?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Student List Upload");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3>Student List Uploaded: <span style="color:green">Done!</span></h3>
                <hr>
                <center><a href="students.php" class="btn btn-info">Student List</a></center>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>
