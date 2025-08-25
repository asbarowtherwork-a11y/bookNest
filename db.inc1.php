<?php 
 $servername = "localhost";
 $dbusername = "username";
 $dbpass = "password";
 $dbname = "database_name";
 $conn = mysqli_connect($servername, $dbusername, $dbpass, $dbname);

 if(!$conn){
     die("connection to the database failed".mysqli_connect_error());
 }
 
?>