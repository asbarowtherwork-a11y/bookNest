<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $row = mysqli_fetch_assoc($select_users);


        if(password_verify($pass, $row['password'])){
        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        }
        else if($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');

        }
    }
    else{
    $message[] = 'incorrect email or password';
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contents="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>login</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <div class="icon">
          <i class="fa-solid fa-user" id="login-btn"></i>
          <div class="login-box">
            <a href="adminlogin.php" class="page">Admin</a>
        </div>
        </div>
        

        <div class="main-wrapper">
            
    <div class="form-container">
    <div class="curved-shape"></div>
 
    <form action="" method="post">
        <h3>Login</h3>
        <input type="email" name="email" placeholder="Enter Your Email" required class="box">
        <input type="password" name="password" placeholder="Enter Your Password" required class="box">
        <input type="submit" name="submit" value="Login now" class="btn">
        <p>Don't have an account?<a href="register.php">Sign Up</a></p>
    </form>
    </div>
   
</div>


<script src="login.js"></script>
    </body>
    </html>