<?php 
    session_start();
    include 'config.php';

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        
    }
    if(isset($_GET['remove'])){
        $remove_id = $_GET['remove'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
        header('location:cart.php');
    };
    if(isset($_GET['delete_all'])){
        mysqli_query($conn, "DELETE FROM `cart`");
        header('location:cart.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contents="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>Cart</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        


    </head>
    <body>
<?php include 'header.php';?>


<section class="shopping-cart">
    
    <!--h1 class="title">products added</h1>-->

    <div class="box-container">
        <table>
            <tbody>
        <?php
        $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'")or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    $sub_total = $fetch_cart['price']; // Ensure it's treated as a number
        $grand_total += $sub_total;
                    ?>
                    <div class="box">
                        
                            <tr>
                            <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>"alt=""></td>
                            <td><div class="name"><?php echo $fetch_cart['name']; ?></div></td>
                            <td><div class="price">MRP: <i class="fa-solid fa-indian-rupee-sign"></i><?php echo $fetch_cart['price']; ?></div></td>
                            <form action="" method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                <!--input type="number" min="1" value=""> quantity-->
                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                            </form>
                            <input type="hidden" value="<?php echo $sub_total = number_format($fetch_cart['price']);?>">
                            <td><a href="cart.php?remove=<?php echo $fetch_cart['id'];?>" onclick="return confirm('remove item from cart?')" class="delete-btn">Remove</a></td>
                            </tr>
                            
                    </div>
                    <?php
                    

                }
            }else{
                    echo '<p class="empty">Your Cart Is Empty</p>'; 
            }
        ?>
        <tr class="table-bottom">
            <td>Total Products:<?php echo $cart_rows_number; ?></td>
            <td >Grand Total</td>
            <td>MRP:  <i class="fa-solid fa-indian-rupee-sign"></i><?php echo $grand_total; ?></td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn">Delete All</a></td>
        </tr>
            </tbody>
        </table>
        <div class="checkout-btn">
            <a href="details.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>"> Proceed To Checkout</a>
        </div>
    </div>

</section>


<div class="cartfoot">
<?php include 'footer.php';?>
</div>

<script src="script.js"></script>

    </body>
</html>