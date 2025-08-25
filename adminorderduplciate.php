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

<section class="orders">
    <h1 class="title">placed orders</h1>
    <div class="box-container">
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ")or die('query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                ?> 
        <div class="box">
                <p>user id :<span><?php echo $fetch_orders['user_id'];?></span></p>
                <p>placed on :<span><?php echo $fetch_orders['placed_on'];?></span></p>
                <p>name :<span><?php echo $fetch_orders['name'];?></span></p>
                <p>number :<span><?php echo $fetch_orders['number'];?></span></p>
                <p>email :<span><?php echo $fetch_orders['email'];?></span></p>
                <p>address :<span><?php echo $fetch_orders['address'];?></span></p>
                <p>total products :<span><?php echo $fetch_orders['total_products'];?></span></p>
                <p>total price :<span><?php echo $fetch_orders['total_price'];?></span></p>
                <p>payment status:<span><?php echo $fetch_orders['payment_status'];?></span></p>

        </div>
        <?php
            }
     }else{
    echo '<p class="empty">no orders placed</p>';

     }
        ?>
    </div>

    
</section>
<script src="admin.js"></script>
    

</body>
</html>