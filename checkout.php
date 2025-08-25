<?php 
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php'); // Redirect to login if not logged in
    exit();
}



// Fetch cart items
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="checkout">
    

    

    <!-- Cart Products Section -->
     <div class="check">
    <div class="checkcart">
    <table>
        
        <?php 
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $grand_total += $cart_item['price'];
            ?>
            <tr>
                <td><img src="uploaded_img/<?php echo $cart_item['image']; ?>"></td>
                <td class="checkname"><?php echo $cart_item['name']; ?></td>
                <td class="checkprice">₹<?php echo $cart_item['price']; ?></td>
            </tr>
        <?php } ?>
    </table>
    </div>
      <div class="checktotal">
        <table>
        <tr class="totalcheck">
            <td colspan="2"><strong>Grand Total:</strong></td>
            <td><strong>₹<?php echo $grand_total; ?></strong></td>
        </tr>
    </table>
   

    <!-- Proceed to Payment -->
    <div class="payment-btn">
    <button onclick="document.getElementById('payment-form').style.display='block'" class="btn">Proceed to Pay</button>
</div>
      
     
<!-- Payment Form -->
<div id="payment-form" style="display: none;">
    <form action="process_payment.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="text" name="name" placeholder="Enter Your Name" required>
        <input type="text" name="payid" placeholder="Enter UPI ID" required>
        <input type="hidden" name="total_price" value="<?php echo $grand_total; ?>">
        <input type="submit" class="checkpay" name="pay_now" value="Submit Payment">
    </form>
</div>
      </div>
        </div>

</section>

<?php include 'footer.php'; ?>

<script src="script.js"></script>

</body>
</html>
