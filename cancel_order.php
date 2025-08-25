<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $user_id = $_SESSION['user_id'];

    // Delete order from the database
    mysqli_query($conn, "UPDATE `orders` SET order_status = 'Cancelled' WHERE id = '$order_id' AND user_id = '$user_id'");

    
    $_SESSION['message'] = "Order has been canceled successfully!";
}

header('location:orders.php');
exit();
?>
