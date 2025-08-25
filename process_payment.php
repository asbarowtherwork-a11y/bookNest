<?php
session_start();
include 'config.php';

if(isset($_POST['pay_now'])){
    $user_id = $_POST['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $payid = mysqli_real_escape_string($conn, $_POST['payid']);
    $total_price = $_POST['total_price'];

    // Generate a Fake Transaction ID
    $transid = "TXN" . rand(100000, 999999);

    // Fetch User Details
    $user_query = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($user_query);
    $email = $user_data['email'];

    // Fetch Address
    $address_query = mysqli_query($conn, "SELECT * FROM `addresses` WHERE user_id = '$user_id'");
    $address_data = mysqli_fetch_assoc($address_query);
    $address = $address_data['address'];
    $number = $address_data['phone'];

    // Fetch Cart Items
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
    $total_products = "";
    $product_images = [];
    while ($cart_item = mysqli_fetch_assoc($cart_query)) {

        echo "Fetched Product: " . $cart_item['name'] . "<br>"; // Debugging
    echo "Fetched Image: " . $cart_item['image'] . "<br>"; // Debugging

        $total_products .= $cart_item['name'] . ", ";
        $product_images[] = $cart_item['image'];
    }

    $image = implode(',', $product_images);
    echo "Final Image String: " . $image . "<br>"; // Debugging
    // Insert into Orders Table
    $insert_order = mysqli_query($conn, "INSERT INTO `orders` (user_id, image, name, number, email, address, total_products, total_price, placed_on, payment_status, transid, payid) 
    VALUES ('$user_id', '$image', '$name', '$number', '$email', '$address', '$total_products', '$total_price', NOW(), 'success', '$transid', '$payid')");

    if($insert_order){
        // Clear Cart
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'");
        $_SESSION['message'] = 'Payment Successful';
        header("Location: orders.php");
        exit();
    } else {
        echo "Payment failed. Try again.";
    }
}
?>
