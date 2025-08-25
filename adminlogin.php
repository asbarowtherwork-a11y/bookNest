<?php
session_start();

include 'config.php';

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];

    $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND user_type = 'admin'") or die('query failed');

    if(mysqli_num_rows($select_admin) > 0){
        $row = mysqli_fetch_assoc($select_admin);

        if(password_verify($pass, $row['password'])){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        } else {
            $_SESSION['message'] = 'Incorrect password!';
        }
    } else {
        $_SESSION['message'] = 'Admin not found!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
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
        <h3>Admin Login</h3>
        <input type="email" name="email" placeholder="Enter Your Email" required class="box" autocomplete="off">
        <input type="password" name="password" placeholder="Enter Your Password" required class="box">
        <input type="submit" name="submit" value="Login now" class="btn">
    </form>
    </div>
    </div>
</body>
</html>
