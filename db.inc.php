<?php 
 $servername = "localhost";
 $dbusername = "root";
 $dbpass = "";
 $dbname = "ratingsystem";
 $conn = mysqli_connect($servername, $dbusername, $dbpass, $dbname);

 if(!$conn){
     die("connection to the database failed".mysqli_connect_error());
 }
 
?>