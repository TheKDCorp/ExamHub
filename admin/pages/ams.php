					
<link rel="stylesheet" href="www.w3schools.com/w3css/4/w3.css">

 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("App Management System");
});
</script>

<style type="text/css">
  #customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}


.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 0px solid #ccc;
    border-top: none;
}

.effect1{
	-webkit-box-shadow: 0 10px 6px -6px #777;
	   -moz-box-shadow: 0 10px 6px -6px #777;
	        box-shadow: 0 10px 6px -6px #777;
}

@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
  #customers{
    width:100%;
  }
  .statdigit{
    font-size:15px;
  }
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:landscape) {
  #customers{
    width:100%;
  }
    .statdigit{
    font-size:15px;
  }
}

</style>
 <!-- <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css"> -->
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/css/util.css">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">

    <script>
    $('.js-pscroll').each(function(){
      var ps = new PerfectScrollbar(this);

      $(window).on('resize', function(){
        ps.update();
      })
    });
      
    
  </script>

  <script type="text/javascript">
    function addclass(cl){
      var element, name, arr;
      element = document.getElementById(cl);
      name = "active";
      arr = element.className.split(" ");
      if (arr.indexOf(name) == -1) {
          element.className += " " + name;
      }
    }
  </script>


      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
 					<div class="container-fluid">
                  <div class="row">
                    <div class="col-xl-4 col-md-4 col-lg-4">
                        <div class="card" style="box-shadow: 2px 2px 2px 2px #17a2b8;">
                            <div class="card-body">
                              <br>
                                <div class="stat-widget-one effec1">
                                  <a href="food_entry.php">
                                    <div class="stat-icon dib"><i class="fa fa-cutlery fa-4x" aria-hidden="true"></i><span class="stat-content dib">
                                        <span class="stat-text" style="font-size:30px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFood Entry</span>
                                    </span></div>
                                    
                                  </a>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4">
                      <a href="calender_events.php">
                        <div class="card" style="box-shadow: 2px 2px 2px 2px #28a745;">
                            <div class="card-body">
                            	<br>
                              <div class="stat-widget-one effec1">
                                  <div class="stat-icon dib"><i class="fa fa-calendar fa-4x" aria-hidden="true"></i>
                                    <span class="stat-content dib">
                                      <span class="stat-text" style="font-size:30px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCalender Events Entry</span>
                                    </span>
                                  </div>
                              </div>   
                            </div>
                              <br>
                        </div>
                      </a>
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4">
                      <a href="galleryentry.php">
                        <div class="card" style="box-shadow: 2px 2px 2px 2px #28a745;">
                            <div class="card-body">
                              <br>
                              <div class="stat-widget-one effec1">
                                  <div class="stat-icon dib"><i class="fa fa-calendar fa-4x" aria-hidden="true"></i>
                                    <span class="stat-content dib">
                                      <span class="stat-text" style="font-size:30px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspGallery Management</span>
                                    </span>
                                  </div>
                              </div>   
                            </div>
                              <br>
                        </div>
                      </a>
                    </div>
                  </div> 
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
