<?php
$username   = $_POST['username'];
$pass       = $_POST['password'];

include 'connection.php';

$ambil = $connection->query("SELECT * FROM user WHERE username='$username' AND password = '$pass' ");
$cocok = $ambil->num_rows;

if ($cocok==1) 
   {
    $_SESSION['user']=$ambil->fetch_assoc();
   //  echo "<div class='alert alert-info'>Login Sukses</div>";
    echo "<meta http-equiv='refresh' content='1;url=splitpage.php'>";          
   }
else 
   {
   // echo "<div class='alert alert-info'>Login Gagal</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.html'>"; 
   } 
?>