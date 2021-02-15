<?php
include '../connection.php';
date_default_timezone_set("Asia/Jakarta");
   $time =date("H:i:s");
   $date =date("d-m-Y");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="refresh" content="60">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    History - Electricity Monitoring
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
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

<body class="" onload="startTime()">
  <div class="wrapper">
    <div class="sidebar">
      <div class="sidebar-wrapper">
        <div class="logo">
        <h4 align="center" class="simple-text logo-normal"> <?php echo " "; echo $date; echo " ";?> <div id="txt"></div></h4>
        </div>
        <ul class="nav">
          <li>
            <a href="dashboard_page.php">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="active ">
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
            <a class="navbar-brand" href="javascript:void(0)">History</a>
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
                  <p class="d-lg-none">
                    Reset Database
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="../logout.php" class="nav-item dropdown-item">Log out</a></li>
                  <li class="nav-link"><a href="../reset.php" class="nav-item dropdown-item">Reset Database</a></li>
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
          <div class="container">
          <form action="">
            <div class="form-group col-md-4">
              <form method="get">
                <label>Pick Date</label>
                <input type="date" name="tanggal">
                <input type="submit" value="FILTER">
              </form>
            </div>
          </form>
          </div>
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Voltage (V)</th>
                        <th>Current (A)</th>
                        <th>Current (mA)</th>
                        <th>Power (Watt)</th>
                        <th>Energy (kWh)</th>
                        <th>Energy (Wh)</th>
                        <th>Frequency</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(isset($_GET['tanggal'])){
                       $tgl = $_GET['tanggal'];
                       $sql = mysqli_query($connection,"SELECT voltage,current,current_mA,power,energy,energy_wh,frequency,time,date FROM dashboard WHERE dateid ='$tgl'");
                      }
                      else{
                        $sql = mysqli_query($connection,"SELECT voltage,current,current_mA,power,energy,energy_wh,frequency,time,date,dateid FROM dashboard ORDER BY ID DESC");
                      }
                      while($insert=mysqli_fetch_array($sql))
                      {
                        echo "<tr>
                          <td>$insert[date]</td>
                          <td>$insert[time]</td> 
                          <td>$insert[voltage]</td>
                          <td>$insert[current]</td>
                          <td>$insert[current_mA]</td>
                          <td>$insert[power]</td>
                          <td>$insert[energy]</td>
                          <td>$insert[energy_wh]</td>
                          <td>$insert[frequency]</td>
                        </tr>";
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
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
</body>

</html>
