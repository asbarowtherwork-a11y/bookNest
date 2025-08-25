<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

$order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' ORDER BY placed_on DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Orders</title>
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
<?php include 'header.php'; ?>

<section class="orders">
    <h2>Your Orders</h2>
    <table>
        
        <?php while ($order = mysqli_fetch_assoc($order_query)) { ?>
        <tr class="order-row">
            <td>
                <div class="image-container">
            <?php 
    $images = explode(',' ,$order['image']);
    foreach ($images as $img) {
        echo "<img src='uploaded_img/$img' >";
    }
    ?>
    </div>
            </td>
            <td class="product-name"><?php echo $order['total_products']; ?></td>
            <td class="orprice">₹<?php echo $order['total_price']; ?></td>
            <td class="orplace"><?php echo $order['placed_on']; ?></td>
            <td class="orcancel">
            <?php if ($order['order_status'] == 'Cancelled'): ?>
    <span style="color: grey;">Cancelled</span>
<?php else: ?>
    <a href="cancel_order.php?order_id=<?php echo $order['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel</a>
<?php endif; ?>

            </td>
        </tr>
        <?php } ?>
    </table>
</section>

<div class="continue">
<a href="home.php" class="option-btn" style="margin-top:  0;">CONTINUE SHOPPING></a>
</div>

<div class="orderfoot">
<?php include 'footer.php'; ?>
</div>
<script src="script.js"></script>
</body>
</html>
