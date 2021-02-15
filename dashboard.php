<meta http-equiv="refresh" content="60">
<?php
include 'connection.php';
$curl = curl_init();
date_default_timezone_set("Asia/Jakarta");
$time =date("H:i:s");
$date =date("d/m/Y");

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://platform.antares.id:8443/~/antares-cse/antares-id/powermonitor/nodesatu/la",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "X-M2M-Origin: d744ccad63227f1a:4449aaf08729d6fe",
    "Content-Type: application/json;ty=4",
    "Accept: application/json"
  ),
));

$response = curl_exec($curl);
curl_close($curl);
// echo $response;


// mengubah JSON menjadi array
$data = json_decode($response, TRUE);

foreach ($data as $user) {
   $volt = $user['con'];


   $split = explode("|" , $volt);

    //mencari element array 0
 $voltage = $split[1];
 $current_mA = $split[3];
 $power = $split[5];
 $energy_wh = $split[7];
 $frequency = $split[9];
 $energy = $split[11];
 $current = ($current_mA / 1000);
 $time;
 $date;


$connection->query("INSERT INTO dashboard
                (id, voltage,current,current_mA,power,energy, energy_wh,frequency, time, date)
                VALUES
                (NULL,'$voltage','$current','$current_mA','$power','$energy', '$energy_wh','$frequency', '$time', '$date') ");
}
?>
<!DOCTYPE html>
<html lang="en">

<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Data dari Antares
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
</head>
<body>
<style>
h1 {text-align: center;}
p {text-align: center;}
div {text-align: center;}
</style>
<h1>Data dari Antares</h1>
<p>
  <?php  
   echo $voltage; echo " V";
   ?>
</p>
<p>
  <?php  
   echo $current; echo " A";
   ?>
</p>
<p>
  <?php  
   echo $power; echo " W";
   ?>
</p>
<p>
  <?php  
   echo $energy; echo " kWh";
   ?>
</p>
<p>
  <?php  
   echo $energy_wh; echo " Wh";
   ?>
</p>
<p>
  <?php  
   echo $frequency; echo " Hz";
   ?>
</p>
<p>
timestamp:
  <?php  
   echo $date; echo " "; echo $time;
   ?>
</p>
<p>
  ----------------------------------------
</p>
<div>
<?php
echo "Data JSON: ";
echo $volt;
?>
</div>
</body>
</html>
