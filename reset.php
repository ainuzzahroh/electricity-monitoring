<?php
header("location: ./pages/history_page.php");
$connection = new mysqli("localhost","root","","antares_revisi");
$sql = mysqli_query($connection, ('TRUNCATE TABLE dashboard;'));
?>