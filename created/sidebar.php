<?php 

include_once('../includes/dbcon.php');

$sql = "select * from settings limit 1";
$result = $conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}

 
?> 

<div class="sidebar" data-color="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="./index.php" class="simple-text logo-mini">
          MVA
        </a>
        <a href="./index.php" class="simple-text logo-normal">
          Examination System
        </a>
      </div>
      <?php $filename = basename($_SERVER['PHP_SELF']) ?>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="<?php if($filename=='index.php' || $filename=="indexnew.php"){echo 'active';} ?>">
            <a href="index.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="<?php if($filename=='chooseexam.php'){echo 'active';} ?>">
            <a href="chooseexam.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Mock Test</p>
            </a>
          </li>
          <li class="<?php if($filename=='history.php'){echo 'active';} ?>">
            <a href="history.php">
              <i class="now-ui-icons location_map-big"></i>
              <p>Original Test Results</p>
            </a>
          </li>
          <?php if($row['practisetestallowed']=="true"){
           ?>
           <li class="<?php if($filename=='history1.php'){echo 'active';} ?>">
            <a href="history1.php">
              <i class="now-ui-icons location_map-big"></i>
              <p>Practise Test Results</p>
            </a>
          </li>
           <?php 
          } ?>
          <li class="<?php if($filename=='profile.php'){echo 'active';} ?>">
            <a href="profile.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>My Profile</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>Developed By "Digi MVA" Group</p>
            </a>
          </li>
        </ul>
      </div>
    </div>