<?php
 include_once('../created/headerwithoutloading.php'); 
?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<?php 

  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');

  $sid = "1";
  
 ?>

<script type="text/javascript">
$(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );

        var table1 = $('#example1').DataTable( {
            lengthChange: true,
        } ); 
        table1.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table1.table().container()) );
});

</script>

      <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Recently Added</h5>
                <h4 class="card-title">Students</h4>
              </div>
              <div class="card-body" style="padding-left:2em;overflow-x: scroll;">
                   <?php 
                    $sql = "SELECT * FROM students order by sid desc limit 50";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                          <th>Id</th>
                          <th>Student Name</th>
                          <th>Batch</th>
                          <th>Mobile No.</th>
                          <th>User Name</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                     <tbody>
                        <?php
                            if($result->num_rows > 0) {
                              $srno = 0;
                            while($row = $result->fetch_assoc()) {
                              $srno = $srno + 1;
                              echo "<tr><td>" . $srno . "</td>" ."<td>" . $row['name'] . "</td>" . "<td>" . $row['batch'] . "</td>" ."<td>". $row['mobileno'] . "</td><td>" . $row['username'] . "</td><td><a href='viewstudent.php?id=".$row['sid']."' class='btn btn-info'>View</a>";
                              echo "</td></tr>";
                          }
                      } 
                    ?>
                      </tbody>
                  </table>
              </div>
              <div class="card-footer">
                <div class="stats">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Recent Logs</h5>
                <h4 class="card-title">Logs</h4>
              </div>
              <div class="card-body" style="padding-left:2em;overflow-x: scroll;">
                   <?php 
                    $sql = "SELECT * FROM logs order by lid desc limit 100";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example1" class="table table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                          <th>Id</th>
                          <th>Date & Time</th>
                          <th>Student Name</th>
                          <th>Device Name</th>
                          <th>Mac Address</th>
                          <th>Message</th>
                        </tr>
                      </thead>
                     <tbody>
                        <?php
                            if($result->num_rows > 0) {
                              $srno = 0;
                            while($row = $result->fetch_assoc()) {
                              $srno = $srno + 1;
                              $cid = $row['cid'];
                              $sql2 = "select * from students where sid='$cid'";
                              $result2=$conn->query($sql2);
                              $row2=$result2->fetch_assoc();
                              echo "<tr><td>" . $srno . "</td>" ."<td>" . $row['datetime'] . "</td>" ."<td>" . $row2['name'] . "</td>" . "<td>" . $row['devicename'] . "</td>" ."<td>". $row['macaddress'] . "</td><td>" . $row['message'] . "</td>";
                              echo "</tr>";
                          }
                      } 
                    ?>
                      </tbody>
                  </table>
              </div>
              <div class="card-footer">
                <div class="stats">
                </div>
              </div>
            </div>
          </div>
<!--           <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Score(Mains)</h5>
                <h4 class="card-title">Maths</h4>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExampleformaths"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
        <br>
      

<script>
    $(document).ready(function() {
      
      demo.initDashboardPageCharts();

    });
</script>



<script type="text/javascript">
  demo = {
  initPickColor: function() {
    $('.pick-class-label').click(function() {
      var new_class = $(this).attr('new-class');
      var old_class = $('#display-buttons').attr('data-class');
      var display_div = $('#display-buttons');
      if (display_div.length) {
        var display_buttons = display_div.find('.btn');
        display_buttons.removeClass(old_class);
        display_buttons.addClass(new_class);
        display_div.attr('data-class', new_class);
      }
    });
  },

  initDocChart: function() {
    chartColor = "#FFFFFF";

    // General configuration for the charts with Line gradientStroke
    gradientChartOptionsConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      tooltips: {
        bodySpacing: 4,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
        xPadding: 10,
        yPadding: 10,
        caretPadding: 10
      },
      responsive: true,
      scales: {
        yAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 15,
          bottom: 15
        }
      }
    };

    ctx = document.getElementById('lineChartExample').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

    myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Active Users",
          borderColor: "#f96332",
          pointBorderColor: "#FFF",
          pointBackgroundColor: "#f96332",
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 1,
          pointRadius: 4,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 630]
        }]
      },
      options: gradientChartOptionsConfiguration
    });
  },

  initDashboardPageCharts: function() {

    chartColor = "#FFFFFF";

    // General configuration for the charts with Line gradientStroke
    gradientChartOptionsConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      tooltips: {
        bodySpacing: 4,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
        xPadding: 10,
        yPadding: 10,
        caretPadding: 10
      },
      responsive: 1,
      scales: {
        yAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 15,
          bottom: 15
        }
      }
    };

    gradientChartOptionsConfigurationWithNumbersAndGrid = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      tooltips: {
        bodySpacing: 4,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
        xPadding: 10,
        yPadding: 10,
        caretPadding: 10
      },
      responsive: true,
      scales: {
        yAxes: [{
          gridLines: 0,
          gridLines: {
            zeroLineColor: "transparent",
            drawBorder: false
          }
        }],
        xAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 25,
          top: 15,
          bottom: 15
        }
      }
    };

    var ctx = document.getElementById('bigDashboardChart').getContext("2d");

    var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [' ',' ',
          <?php
            $sql5 = "select distinct(examname) from results where examtype='originaltest' limit 10";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $texamname5 = "";
              while($row5 = $results5->fetch_assoc()){
                $myexamname5 = $row5['examname'];
                $texamname5 = $texamname5 . '"'.$myexamname5.'",';
              }
              $texamname5 = substr(trim($texamname5), 0, -1);
              echo $texamname5;
            }else{
              
            }
          ?>
          ],
        datasets: [{
          label: "Average Marks",
          borderColor: chartColor,
          pointBorderColor: chartColor,
          pointBackgroundColor: "#1e3d60",
          pointHoverBackgroundColor: "#1e3d60",
          pointHoverBorderColor: chartColor,
          pointBorderWidth: 1,
          pointHoverRadius: 7,
          pointHoverBorderWidth: 2,
          pointRadius: 5,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data: [0,0,
          <?php
            $sql5 = "select distinct(examname),avg(mymarks) AS avgmarks from results where examtype='originaltest' group by examname limit 10";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $texamname5 = "";
              while($row5 = $results5->fetch_assoc()){
                $myexamname5 = $row5['avgmarks'];
                $texamname5 = $texamname5 . '"'.$myexamname5.'",';
              }
              $texamname5 = substr(trim($texamname5), 0, -1);
              echo $texamname5;
            }else{
              
            }
          ?>
          ]
        }]
      },
      options: {
        layout: {
          padding: {
            left: 20,
            right: 20,
            top: 0,
            bottom: 0
          }
        },
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: '#fff',
          titleFontColor: '#333',
          bodyFontColor: '#666',
          bodySpacing: 4,
          xPadding: 12,
          mode: "nearest",
          intersect: 0,
          position: "nearest"
        },
        legend: {
          position: "bottom",
          fillStyle: "#FFF",
          display: false
        },
        scales: {
          yAxes: [{
            ticks: {
              fontColor: "rgba(255,255,255,0.4)",
              fontStyle: "bold",
              beginAtZero: true,
              maxTicksLimit: 5,
              padding: 10
            },
            gridLines: {
              drawTicks: true,
              drawBorder: false,
              display: true,
              color: "rgba(255,255,255,0.1)",
              zeroLineColor: "transparent"
            }

          }],
          xAxes: [{
            gridLines: {
              zeroLineColor: "transparent",
              display: false,

            },
            ticks: {
              padding: 10,
              fontColor: "rgba(255,255,255,0.4)",
              fontStyle: "bold"
            }
          }]
        }
      }
    });

var cardStatsMiniLineColor = "#fff",
      cardStatsMiniDotColor = "#fff";

    ctx = document.getElementById('lineChartExampleWithNumbersAndGrid').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

    myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      data: {
        labels: [' ',' ',

    <?php
            $cid5 = $sid;
            $sql5 = "select * from results where cid='$cid5' and examtype='originaltest'";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $tdate5 = "";
              while($row5 = $results5->fetch_assoc()){
                $mydate5 = date("d-m-Y", strtotime($row5['date']));
                $tdate5 = $tdate5 . '"'.$mydate5.'",';
              }
              $tdate5 = substr(trim($tdate5), 0, -1);
              echo $tdate5;
            }else{
              
            }
          ?>

  ],
        datasets: [{
          label: "Chemistry",
          borderColor: "#f96332",
          pointBorderColor: "#FFF",
          pointBackgroundColor: "#f96332",
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 1,
          pointRadius: 4,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data: ["0","0",
          <?php
            $cid = $sid;
            $sql = "select * from results where cid='$cid' and examtype='originaltest'";
            $results = $conn->query($sql);
            if($results->num_rows > 0){
              $tmarks = "";
              while($row = $results->fetch_assoc()){
                $qindex = $row['qindex'];
                $cid = $row['cid'];
                $examname = $row['examname'];
                $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='chemistry' and examtype='originaltest'";
                $results1 = $conn->query($sql1);
                if($results1->num_rows > 0){
                  $row1 = $results1->fetch_assoc();
                  $mymarks = $row1['mymarks'];
                  $tmarks = $tmarks . '"'.$mymarks.'",';
                }
              }
              $tmarks = substr(trim($tmarks), 0, -1);
              echo $tmarks;
            }else{
              
            }
          ?>
          ]
        }]
      },
      options: gradientChartOptionsConfigurationWithNumbersAndGrid
    });

    ctx = document.getElementById('lineChartExampleWithNumbers').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#18ce0f');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, hexToRGB('#18ce0f', 0.4));

    myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      data: {
        labels: [' ',' ',
        <?php
            $cid5 = $sid;
            $sql5 = "select * from results where cid='$cid5' and examtype='originaltest'";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $tdate5 = "";
              while($row5 = $results5->fetch_assoc()){
                $mydate5 = date("d-m-Y", strtotime($row5['date']));
                $tdate5 = $tdate5 . '"'.$mydate5.'",';
              }
              $tdate5 = substr(trim($tdate5), 0, -1);
              echo $tdate5;
            }else{
              
            }
          ?>

        ],
        datasets: [{
          label: "Physics",
          borderColor: "#18ce0f",
          pointBorderColor: "#FFF",
          pointBackgroundColor: "#18ce0f",
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 1,
          pointRadius: 4,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data: [0,0,
          <?php
            $cid = $sid;
            $sql = "select * from results where cid='$cid' and examtype='originaltest'";
            $results = $conn->query($sql);
            if($results->num_rows > 0){
              $tmarks = "";
              while($row = $results->fetch_assoc()){
                $qindex = $row['qindex'];
                $cid = $row['cid'];
                $examname = $row['examname'];
                $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='physics' and examtype='originaltest'";
                $results1 = $conn->query($sql1);
                if($results1->num_rows > 0){
                  $row1 = $results1->fetch_assoc();
                  $mymarks = $row1['mymarks'];
                  $tmarks = $tmarks . '"'.$mymarks.'",';
                }
              }
              $tmarks = substr(trim($tmarks), 0, -1);
              echo $tmarks;
            }else{
              
            }
          ?>
          ]
        }]
      },
      options: gradientChartOptionsConfigurationWithNumbersAndGrid
    });

        ctx = document.getElementById('lineChartExampleformaths').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#18ce0f');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

    myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      data: {
        labels: [' ',' ',
        <?php
            $cid5 = $sid;
            $sql5 = "select * from results where cid='$cid5' and examtype='originaltest'";
            $results5 = $conn->query($sql5);
            if($results5->num_rows > 0){
              $tdate5 = "";
              while($row5 = $results5->fetch_assoc()){
                $mydate5 = date("d-m-Y", strtotime($row5['date']));
                $tdate5 = $tdate5 . '"'.$mydate5.'",';
              }
              $tdate5 = substr(trim($tdate5), 0, -1);
              echo $tdate5;
            }else{
              
            }
          ?>
          ],
        datasets: [{
          label: "Maths",
          backgroundColor: gradientFill,
          borderColor: "#2CA8FF",
          pointBorderColor: "#FFF",
          pointBackgroundColor: "#2CA8FF",
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 1,
          pointRadius: 4,
          fill: true,
          borderWidth: 1,
          data: [0,0,<?php
            $cid = $sid;
            $sql = "select * from results where cid='$cid' and examtype='originaltest'";
            $results = $conn->query($sql);
            if($results->num_rows > 0){
              $tmarks = "";
              while($row = $results->fetch_assoc()){
                $qindex = $row['qindex'];
                $cid = $row['cid'];
                $examname = $row['examname'];
                $sql1 = "select * from partsresult where cid='$cid' and qindex='$qindex' and examname='$examname' and partname='maths' and examtype='originaltest'";
                $results1 = $conn->query($sql1);
                if($results1->num_rows > 0){
                  $row1 = $results1->fetch_assoc();
                  $mymarks = $row1['mymarks'];
                  $tmarks = $tmarks . '"'.$mymarks.'",';
                }
              }
              $tmarks = substr(trim($tmarks), 0, -1);
              echo $tmarks;
            }else{
             
            }
          ?>]
        }]
      },
      options: gradientChartOptionsConfigurationWithNumbersAndGrid
    });

    // var e = document.getElementById("barChartSimpleGradientsNumbers").getContext("2d");

    // gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    // gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    // gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

    // var a = {
    //   type: "bar",
    //   data: {
    //     labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    //     datasets: [{
    //       label: "Active Countries",
    //       backgroundColor: gradientFill,
    //       borderColor: "#2CA8FF",
    //       pointBorderColor: "#FFF",
    //       pointBackgroundColor: "#2CA8FF",
    //       pointBorderWidth: 2,
    //       pointHoverRadius: 4,
    //       pointHoverBorderWidth: 1,
    //       pointRadius: 4,
    //       fill: true,
    //       borderWidth: 1,
    //       data: [80, 99, 86, 96, 123, 85, 100, 75, 88, 90, 123, 155]
    //     }]
    //   },
    //   options: {
    //     maintainAspectRatio: false,
    //     legend: {
    //       display: false
    //     },
    //     tooltips: {
    //       bodySpacing: 4,
    //       mode: "nearest",
    //       intersect: 0,
    //       position: "nearest",
    //       xPadding: 10,
    //       yPadding: 10,
    //       caretPadding: 10
    //     },
    //     responsive: 1,
    //     scales: {
    //       yAxes: [{
    //         gridLines: 0,
    //         gridLines: {
    //           zeroLineColor: "transparent",
    //           drawBorder: false
    //         }
    //       }],
    //       xAxes: [{
    //         display: 0,
    //         gridLines: 0,
    //         ticks: {
    //           display: false
    //         },
    //         gridLines: {
    //           zeroLineColor: "transparent",
    //           drawTicks: false,
    //           display: false,
    //           drawBorder: false
    //         }
    //       }]
    //     },
    //     layout: {
    //       padding: {
    //         left: 0,
    //         right: 0,
    //         top: 15,
    //         bottom: 15
    //       }
    //     }
    //   }
    // };

    var viewsChart = new Chart(e, a);
  }

};
</script>


  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer2.php'); ?>
