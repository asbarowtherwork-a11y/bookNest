<?php 
    session_start();
    include 'config.php';

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        /*header('location:login.php');*/
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

<?php include 'admin_header.php';?>

    <section class="dashboard">
        <h1 class="title">dashboard</h1>
        <div class="box-container">

        <div class="box">
            <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`")or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?php echo $number_of_orders;?></h3>
            <p>orders placed</p>
        </div>

        <div class="box">
            <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products`")or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
            ?>
            <h3><?php echo $number_of_products;?></h3>
            <p>Products added</p>
        </div>

        <div class="box">
            <?php 
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'")or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $number_of_users;?></h3>
            <p>Users</p>
        </div>

        <div class="box">
            <?php 
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'")or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
            ?>
            <h3><?php echo $number_of_admins;?></h3>
            <p>Admins</p>
        </div>

        <div class="box">
            <?php 
            $select_account = mysqli_query($conn, "SELECT * FROM `users`")or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
            ?>
            <h3><?php echo $number_of_account;?></h3>
            <p>Total users</p>
        </div>

        <div class="box">
            <?php 
            $select_messages = mysqli_query($conn, "SELECT * FROM `messages`")or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
            ?>
            <h3><?php echo $number_of_messages;?></h3>
            <p>Message</p>
        </div>
        
        </div>
    </section>
    <script src="admin.js"></script>
</body>
</html>