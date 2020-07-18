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
          <li class="<?php if($filename=='index.php' || $filename=="indexnew.php"){echo 'active';} ?>" id="dashboard">
            <a href="index.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li id="studentbatchentry" class="<?php if($filename=='studentbatchentry.php'){echo 'active';} ?>">
            <a href="studentbatchentry.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Student Batch Entry</p>
            </a>
          </li>
          <li id="questionpaperentry" class="<?php if($filename=='questionpaperentry.php'){echo 'active';} ?>">
            <a href="questionpaperentry.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Question Paper Entry</p>
            </a>
          </li>
          <li id="questionentry" class="<?php if($filename=='questionentry.php'){echo 'active';} ?>">
            <a href="./questionentry.php">
              <i class="now-ui-icons location_map-big"></i>
              <p>Question Bank</p>
            </a>
          </li>
          <li id="results" class="<?php if($filename=='results.php'){echo 'active';} ?>">
            <a href="./results.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Original Test Results</p>
            </a>
          </li>
          <?php if($row['practisetestallowed']=="true"){
           ?>
           <li id="results" class="<?php if($filename=='practiseresults.php'){echo 'active';} ?>">
            <a href="./practiseresults.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Practise Test Results</p>
            </a>
          </li>
           <?php 
          } ?>
          <li id="students" class="<?php if($filename=='students.php'){echo 'active';} ?>">
            <a href="./students.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>Students</p>
            </a>
          </li>
          <!-- <li id="sendmessages" class="<?php if($filename=='send_messages.php'){echo 'active';} ?>">
            <a href="send_messages.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Send Messages</p>
            </a>
          </li> -->
          <li id="ams" class="<?php if($filename=='ams.php'){echo 'active';} ?>">
            <a href="ams.php">
              <i class="now-ui-icons education_atom"></i>
              <p>AMS</p>
            </a>
          </li> 
          <li id="preferences" class="<?php if($filename=='preferences.php'){echo 'active';} ?>">
            <a href="preferences.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Preferences</p>
            </a>
          </li>
          <li id="adminaccount" class="<?php if($filename=='adminaccount.php'){echo 'active';} ?>">
            <a href="adminaccount.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Admin Account</p>
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