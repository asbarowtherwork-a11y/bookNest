<?php
session_start();
include 'config.php';


if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $_SESSION['message'] = 'User already exists';
    }
    else{
    if($pass != $cpass){
        $_SESSION['message'] = 'Confirm password not matched';
    }
    else{

        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$hashed_pass', '$user_type')")or die('query failed');
        $_SESSION['message'] ='Registration successful';
        
        
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
        <title>register</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>

    

    <?php
        if(isset($_SESSION['message'])){
                echo  '
                <div class="message">
                 <span>'.$_SESSION['message'].'</span>
                <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
                </div>
                 ';
                 unset($_SESSION['message']);
            }
        
    ?>
<div class="main-wrapper">
    <div class="form-container">
    <div class="curved-shape"></div>
    <form action="" method="post">
        <h3>Register Now</h3>
        <input type="text" name="name" placeholder="Enter Your Name" required class="box">
        <input type="email" name="email" placeholder="Enter Your Email" required class="box">
        <input type="password" name="password" placeholder="Enter Your Password" required class="box">
        <input type="password" name="cpassword" placeholder="Confirm Your Password" required class="box">
        <select name="user_type" class="box" >
            <option value="user">User</option>
            
        </select>
        <input type="submit" name="submit" value="Register now" class="btn">
        <p>Already have an account?<a href="login.php">Sign in</a></p>
    </form>
    </div>
        </div>
            <?php
            if (isset($_SESSION['message']) && $_SESSION['message'] == 'Registration successful') {
                // Redirect after a short delay to allow message to display
                echo "<script>setTimeout(function() { window.location.href = 'login.php'; }, 500);</script>";
            }

            ?>

    </body>
    </html>