<?php
   date_default_timezone_set("Asia/Jakarta");
   $time =date("H:i:s");
   $date =date("d-m-Y");

  include '../connection.php';

  $x_tanggal1  = mysqli_query($connection, 'SELECT time FROM ( SELECT * FROM dashboard ORDER BY id DESC LIMIT 10) Var1 ORDER BY ID ASC');
  $x_tanggal2  = mysqli_query($connection, 'SELECT time FROM ( SELECT * FROM dashboard ORDER BY id DESC LIMIT 10) Var1 ORDER BY ID ASC');
  $x_tanggal3  = mysqli_query($connection, 'SELECT time FROM ( SELECT * FROM dashboard ORDER BY id DESC LIMIT 12) Var1 ORDER BY ID ASC');
  $y_voltage   = mysqli_query($connection, 'SELECT voltage FROM ( SELECT * FROM dashboard ORDER BY id DESC LIMIT 12) Var1 ORDER BY ID ASC');
  $y_current   = mysqli_query($connection, 'SELECT current_mA FROM ( SELECT * FROM dashboard ORDER BY id DESC LIMIT 12) Var1 ORDER BY ID ASC');
  $y_power   = mysqli_query($connection, 'SELECT power FROM ( SELECT * FROM dashboard ORDER BY id DESC LIMIT 12) Var1 ORDER BY ID ASC');
  $y_energy   = mysqli_query($connection, 'SELECT energy_wh FROM ( SELECT * FROM dashboard ORDER BY id DESC LIMIT 10) Var1 ORDER BY ID ASC');
  $y_frequency   = mysqli_query($connection, 'SELECT frequency FROM ( SELECT * FROM dashboard ORDER BY id DESC LIMIT 10) Var1 ORDER BY ID ASC');

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="refresh" content="60">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Dashboard - Electricity Monitoring
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <link href="../assets/data/data.css" rel="stylesheet" />
  <script>
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
     }
    function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
      }
  </script>
  </head>
<body class="" onload="startTime()" >
  <div class="wrapper">
    <div class="sidebar">
      <div class="sidebar-wrapper">
        <div class="logo">
           <h4 align="center" class="simple-text logo-normal"> <?php echo " "; echo $date; echo " ";?> <div id="txt"></div></h4>
           
        </div>
        <ul class="nav">
          <li class="active ">
            <a href="dashboard_page.php">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="history_page.php">
              <i class="tim-icons icon-puzzle-10"></i>
              <p>History</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">

              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="../assets/img/anime3.png" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="../logout.php" class="nav-item dropdown-item">Log out</a></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
         <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Main Menu</h5>
                    <h2 class="card-title">Voltage, Current, Power</h2>
                  </div>
                  <div class="col-sm-6">
                    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                      <label class="btn btn-sm btn-primary btn-simple active" id="0">
                        <input type="radio" name="options" checked>
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Voltage (V)</span>
                        <span class="d-block d-sm-none">
                          <i class="tim-icons icon-single-02"></i>
                        </span>
                      </label>
                      <label class="btn btn-sm btn-primary btn-simple" id="1">
                        <input type="radio" class="d-none d-sm-none" name="options">
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Current (A)</span>
                        <span class="d-block d-sm-none">
                          <i class="tim-icons icon-gift-2"></i>
                        </span>
                      </label>
                      <label class="btn btn-sm btn-primary btn-simple" id="2">
                        <input type="radio" class="d-none" name="options">
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Power (Watt)</span>
                        <span class="d-block d-sm-none">
                          <i class="tim-icons icon-tap-02"></i>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="mainChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Additional</h5>
                <h3 class="card-title">Energy (Wh)</h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="energyChart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Additional</h5>
                <h3 class="card-title">Frequency (Hz)</h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="frequencyChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <footer class="footer">
        <div class="container-fluid">

          <div class="copyright">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script> made by
            <a href="javascript:void(0)" target="_blank">ainuzzahrohs</a> for Final Project
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <!-- saduran dari data.js -->
  <script>
    data = {
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
              },
              scaleLabel: {
                display: true,
                labelString: 'Value',
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
              },
              scaleLabel: {
                display: true,
                labelString: 'Time',
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
      },

      initDashboardPageCharts: function() {

        gradientChartOptionsConfigurationWithTooltipBlue = {
          maintainAspectRatio: false,
          legend: {
            display: false
          },

          tooltips: {
            backgroundColor: '#f5f5f5',
            titleFontColor: '#333',
            bodyFontColor: '#666',
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
          },
          responsive: true,
          scales: {
            yAxes: [{
              barPercentage: 1.6,
              gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.0)',
                zeroLineColor: "transparent",
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 10,
                padding: 20,
                fontColor: "#2380f7"
              },
              scaleLabel: {
                display: true,
                labelString: 'Value',
              }
            }],

            xAxes: [{
              barPercentage: 1.6,
              gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.1)',
                zeroLineColor: "transparent",
              },
              ticks: {
                padding: 20,
                fontColor: "#2380f7"
              },
              scaleLabel: {
                display: true,
                labelString: 'Time',
              }
            }]
          }
        };

        gradientChartOptionsConfigurationWithTooltipPurple = {
          maintainAspectRatio: false,
          legend: {
            display: false
          },

          tooltips: {
            backgroundColor: '#f5f5f5',
            titleFontColor: '#333',
            bodyFontColor: '#666',
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
          },
          responsive: true,
          scales: {
            yAxes: [{
              barPercentage: 1.6,
              gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.0)',
                zeroLineColor: "transparent",
              },
              ticks: {
                stepSize: 1,
                padding: 20,
                fontColor: "#9a9a9a"
              },
              scaleLabel: {
                display: true,
                labelString: 'Value',
              }
            }],

            xAxes: [{
              barPercentage: 1.6,
              gridLines: {
                drawBorder: false,
                color: 'rgba(225,78,202,0.1)',
                zeroLineColor: "transparent",
              },
              ticks: {
                padding: 20,
                fontColor: "#9a9a9a"
              },
              scaleLabel: {
                display: true,
                labelString: 'Time',
              }
            }]
          }
        };

        gradientChartOptionsConfigurationWithTooltipOrange = {
          maintainAspectRatio: false,
          legend: {
            display: false
          },

          tooltips: {
            backgroundColor: '#f5f5f5',
            titleFontColor: '#333',
            bodyFontColor: '#666',
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
          },
          responsive: true,
          scales: {
            yAxes: [{
              barPercentage: 1.6,
              gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.0)',
                zeroLineColor: "transparent",
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 10,
                padding: 20,
                fontColor: "#ff8a76"
              }
            }],

            xAxes: [{
              barPercentage: 1.6,
              gridLines: {
                drawBorder: false,
                color: 'rgba(220,53,69,0.1)',
                zeroLineColor: "transparent",
              },
              ticks: {
                padding: 20,
                fontColor: "#ff8a76"
              }
            }]
          }
        };

        gradientChartOptionsConfigurationWithTooltipGreen = {
          maintainAspectRatio: false,
          legend: {
            display: false
          },

          tooltips: {
            backgroundColor: '#f5f5f5',
            titleFontColor: '#333',
            bodyFontColor: '#666',
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
          },
          responsive: true,
          scales: {
            yAxes: [{
              barPercentage: 1.6,
              gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.0)',
                zeroLineColor: "transparent",
              },
              ticks: {
                suggestedMin: 40,
                suggestedMax: 60,
                stepSize: 5,
                padding: 20,
                fontColor: "#9e9e9e"
              },
              scaleLabel: {
                display: true,
                labelString: 'Value',
              }
            }],

            xAxes: [{
              barPercentage: 1.6,
              gridLines: {
                drawBorder: false,
                color: 'rgba(0,242,195,0.1)',
                zeroLineColor: "transparent",
              },
              ticks: {
                padding: 20,
                fontColor: "#9e9e9e"
              },
              scaleLabel: {
                display: true,
                labelString: 'Time',
              }
            }]
          }
        };


        gradientBarChartConfiguration = {
          maintainAspectRatio: false,
          legend: {
            display: false
          },

          tooltips: {
            backgroundColor: '#f5f5f5',
            titleFontColor: '#333',
            bodyFontColor: '#666',
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
          },
          responsive: true,
          scales: {
            yAxes: [{

              gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.1)',
                zeroLineColor: "transparent",
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 10,
                padding: 20,
                fontColor: "#9e9e9e"
              },
              scaleLabel: {
                display: true,
                labelString: 'Value',
              }
            }],

            xAxes: [{

              gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.1)',
                zeroLineColor: "transparent",
              },
              ticks: {
                padding: 20,
                fontColor: "#9e9e9e"
              },
              scaleLabel: {
                display: true,
                labelString: 'Time',
              }
            }]
          }
        };

        var ctx = document.getElementById("energyChart").getContext("2d");

        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

        var data = {
          labels: [<?php while ($b = mysqli_fetch_array($x_tanggal1)) { echo '"' . $b['time'] . '",';}?>],
          datasets: [{
            label: "Energy",
            fill: true,
            backgroundColor: gradientStroke,
            borderColor: '#d048b6',
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: '#d048b6',
            pointBorderColor: 'rgba(255,255,255,0)',
            pointHoverBackgroundColor: '#d048b6',
            pointBorderWidth: 20,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 5,
            pointRadius: 4,
            data: [<?php while ($b = mysqli_fetch_array($y_energy)) { echo  $b['energy_wh'] . ',';}?>],
          }]
        };

        var myChart = new Chart(ctx, {
          type: 'line',
          data: data,
          options: gradientChartOptionsConfigurationWithTooltipPurple
        });


        var ctxGreen = document.getElementById("frequencyChart").getContext("2d");

        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)'); 
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); 

        var data = {
          labels: [<?php while ($b = mysqli_fetch_array($x_tanggal2)) { echo '"' . $b['time'] . '",';}?>],
          datasets: [{
            label: "Frequency",
            fill: true,
            backgroundColor: gradientStroke,
            borderColor: '#d048b6',
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: '#d048b6',
            pointBorderColor: 'rgba(255,255,255,0)',
            pointHoverBackgroundColor: '#d048b6',
            pointBorderWidth: 20,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,
            data: [<?php while ($b = mysqli_fetch_array($y_frequency)) { echo  $b['frequency'] . ',';}?>],
          }]
        };

        var myChart = new Chart(ctxGreen, {
          type: 'line',
          data: data,
          options: gradientChartOptionsConfigurationWithTooltipGreen

        });



        var chart_labels = [<?php while ($b = mysqli_fetch_array($x_tanggal3)) { echo '"' . $b['time'] . '",';}?>];
        var chart_data = [<?php while ($b = mysqli_fetch_array($y_voltage)) { echo  $b['voltage'] . ',';}?>];


        var ctx = document.getElementById("mainChart").getContext('2d');

        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
        gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors
        var config = {
          type: 'line',
          data: {
            labels: chart_labels,
            datasets: [{
              label: "Main Data",
              fill: true,
              backgroundColor: gradientStroke,
              borderColor: '#d346b1',
              borderWidth: 2,
              borderDash: [],
              borderDashOffset: 0.0,
              pointBackgroundColor: '#d346b1',
              pointBorderColor: 'rgba(255,255,255,0)',
              pointHoverBackgroundColor: '#d346b1',
              pointBorderWidth: 20,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 15,
              pointRadius: 4,
              data: chart_data,
            }]
          },
          options: gradientChartOptionsConfigurationWithTooltipPurple
        };
        
        var myChartData = new Chart(ctx, config);
        $("#0").click(function() {
          var data = myChartData.config.data;
          data.datasets[0].data = chart_data;
          data.labels = chart_labels;
          myChartData.update();
        });
        $("#1").click(function() {
          var chart_data = [<?php while ($b = mysqli_fetch_array($y_current)) { echo  $b['current_mA'] . ',';}?>];
          var data = myChartData.config.data;
          data.datasets[0].data = chart_data;
          data.labels = chart_labels;
          myChartData.update();
        });

        $("#2").click(function() {
          var chart_data = [<?php while ($b = mysqli_fetch_array($y_power)) { echo  $b['power'] . ',';}?>];
          var data = myChartData.config.data;
          data.datasets[0].data = chart_data;
          data.labels = chart_labels;
          myChartData.update();
        });
      },
    };

  </script>
   <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      data.initDashboardPageCharts();

    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>

</body>

</html>