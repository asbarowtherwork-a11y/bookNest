<?php 
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php'); // Redirect to login if not logged in
    exit();
}

// Fetch user address
$address_query = mysqli_query($conn, "SELECT * FROM `addresses` WHERE user_id = '$user_id' LIMIT 1");
$address_data = mysqli_fetch_assoc($address_query);

// If form is submitted, update or insert address
if(isset($_POST['save_address'])){
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    if($address_data) {
        // Update existing address
        mysqli_query($conn, "UPDATE `addresses` SET phone='$phone', address='$address' WHERE user_id='$user_id'");
    } else {
        // Insert new address
        mysqli_query($conn, "INSERT INTO `addresses` (user_id, phone, address) VALUES ('$user_id', '$phone', '$address')");
    }
    header('location:details.php'); // Reload page after saving
    exit();
}

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
<div class="address-section">
        <?php if ($address_data): ?>
            <p><strong>Address:</strong> <?php echo $address_data['address']; ?></p>
            <p><strong>Contact No:</strong> <?php echo $address_data['phone']; ?></p>
            <button onclick="document.getElementById('address-form').style.display='block'">Edit Address</button>
        <?php else: ?>
            <p>No address found. Please enter your details.</p>
        <?php endif; ?>
    </div>

    <!-- Address Form -->
    <div id="address-form" style="display: <?php echo ($address_data) ? 'none' : 'block'; ?>">
        <form action="" method="post">
            
            <textarea name="address" placeholder="Enter Your Address" required><?php echo $address_data['address'] ?? ''; ?></textarea>
            <input type="text" name="phone" placeholder="Enter Your Number" value="<?php echo $address_data['phone'] ?? ''; ?>" required>
            <input type="submit" class="saveadd" name="save_address" value="Save Address">
        </form>
    </div>
    <div class="detail-btn">
            <a href="checkout.php" class="btn"> Proceed</a>
        </div>

<div class="detailfoot">
    <?php include 'footer.php'; ?>
    </div>

<script src="script.js"></script>

</body>
</html>
