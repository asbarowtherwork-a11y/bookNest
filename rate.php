<?php 
require "db.inc.php";
$POST = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

$POSTI = filter_var_array($_POST, FILTER_SANITIZE_NUMBER_INT);
 
if(isset($POST['starRate'])) {
   $starRate = mysqli_real_escape_string($conn, $POST['starRate']);
   $rateMsg = mysqli_real_escape_string($conn, $POST['rateMsg']);
   $date = mysqli_real_escape_string($conn, $POST['date']);
   $name = mysqli_real_escape_string($conn, $POST['name']);

      
   $sql = $conn->prepare("SELECT * FROM rate WHERE userName=?");
   $sql->bind_param("s", $name);
   $sql->execute();
   $res = $sql->get_result();
   $rst = $res->fetch_assoc();
   $val = $rst["userName"];

   if(!$val) {
   $stmt = $conn->prepare("INSERT INTO rate (userName, userReview, userMessage, dateReviewed) Values (?, ?, ?, ?)");
   $stmt->bind_param("ssss", $name, $starRate, $rateMsg, $date);
   $stmt->execute();
   echo"Inserted Successfully";
   }
   else{
      $stmt = $conn->prepare("UPDATE rate SET userName=?, userReview=?, userMessage=?, dateReviewed=? WHERE userName=?");
      $stmt->bind_param("sssss", $name, $starRate, $rateMsg, $date, $name);
      $stmt->execute();
      echo"Updated Successfully";
      
   }

}
?>
