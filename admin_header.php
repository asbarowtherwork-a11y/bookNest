<?php
    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
            <span>'.$message.'</span>
            <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contents="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>bookNest</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
<header class="header">

    
    <div class="header-2">
        <div class="flex">
        <div class="logo">bookNest</div>
        
        <nav class="navbar">
            <a href="admin_page.php">Home</a>
            <a href="admin_products.php">Products</a>
            <a href="admin_orders.php">Orders</a>
            <a href="admin_users.php">Users</a>
            <a href="admin_messages.php">Messages</a>
        </nav>
        <div class="icons">
          <i class="fa-solid fa-user" id="user-btn"></i>
        </div>
        <div class="account-box">
            <p>Username : <span><?php echo  $_SESSION['admin_name'];?></span></p>
            <p>Email :<span><?php echo $_SESSION['admin_email'];?></span></p>
            <a href="logout.php" class="delete-btn">Logout</a>
        </div>
        </div>
</div>
 </header>
 <!--<script>

    let accountBox =document.querySelector('.header .header-2 .flex .account-box');

    document.querySelector('#user-btn').onclick = () =>{
    accountBox.classList.toggle('active');
    
}

 </script>-->

 
 <script src="admin.js"></script>
    </body>
</html>


