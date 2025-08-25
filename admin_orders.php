<?php
session_start();
include 'config.php';

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
    exit();
}

$orders_query = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY placed_on DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="orders">
    <h2 class="adminhe">All Orders</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Products</th>
            <th>Name</th>
            <th>Amt</th>
            <th>Address</th>
            <th>Number</th>
            <th>Order Date</th>
            <th>Status</th>
        </tr>
        <?php while ($order = mysqli_fetch_assoc($orders_query)) { ?>
        <tr class="adminrow">
            <td class="adminna"><?php echo $order['name']; ?></td>
            <td class="adminem"><?php echo $order['email']; ?></td>
            <td class="adminim">
            <?php 
    $images = explode(',', $order['image']);
    foreach ($images as $img) {
        echo "<img src='uploaded_img/$img'>";
    }
    ?>
            </td>
            <td class="adminpr"><?php echo $order['total_products']; ?></td>
            <td class="adminpri">₹<?php echo $order['total_price']; ?></td>
            <td class="adminad"><?php echo $order['address']; ?></td>
            <td class="adminnum"><?php echo $order['number']; ?></td>
            <td class="adminplace"><?php echo $order['placed_on']; ?></td>
            <td>
    <?php 
        if ($order['order_status'] == 'Cancelled') {
            echo "<span style='color: red; font-weight: bold;'>Cancelled</span>";
        } else {
            echo "<span style='color: green; font-weight: bold;'>Active</span>";
        }
    ?>
</td>
        </tr>
        <?php } ?>
    </table>
</section>

<?php include 'footer.php'; ?>

</body>
</html>
