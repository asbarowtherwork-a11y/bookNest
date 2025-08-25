<?php 
    session_start();
    include 'config.php';

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        
    }
    if (isset($_POST['add_to_cart'])) { // ✅ Run only when the button is clicked
        if ($user_id) { // ✅ Ensure user is logged in
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';
            $image = $_POST['image'] ?? '';
    
            if ($name && $price && $image) { // ✅ Check if values exist
                // Prevent SQL injection
                $name = mysqli_real_escape_string($conn, $name);
                $price = mysqli_real_escape_string($conn, $price);
                $image = mysqli_real_escape_string($conn, $image);
    
                // Check if product is already in the cart
                $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$name' AND user_id='$user_id'") or die(mysqli_error($conn));
    
                if (mysqli_num_rows($check_cart) > 0) {
                    $_SESSION['message'] = "Already added to cart!";
    
                } else {
                    // ✅ Correct SQL Query
                    $insert_query = "INSERT INTO `cart` (user_id, name, price, image) VALUES ('$user_id', '$name', '$price', '$image')";
                    mysqli_query($conn, $insert_query) or die(mysqli_error($conn));
    
                    $_SESSION['message'] = "Product added to cart!";
    
                }
            } else {
                echo '<script>alert("Error: Missing product details!");</script>';
            }
        } else {
            echo '<script>alert("Error: User not logged in!");</script>';
        }
    }
    
    if (isset($_POST['add_to_wishlist'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
    
        // Check if the item already exists in the wishlist
        $check_query = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND name = ?");
        $check_query->bind_param("is", $user_id, $name);
        $check_query->execute();
        $result = $check_query->get_result();
    
        if ($result->num_rows > 0) {
            $_SESSION['message'] = 'already in wishlist ';
        } else {
            // Insert into wishlist
            $insert_query = $conn->prepare("INSERT INTO wishlist (user_id, name, price, image) VALUES (?, ?, ?, ?)");
            $insert_query->bind_param("isss", $user_id, $name, $price, $image);
    
            if ($insert_query->execute()) {
                $_SESSION['message'] = 'Added to wishlist';
            } else {
                $_SESSION['message'] = 'Failed to add';
            }
        }
    }
    if (isset($_POST['remove'])) {
        $wishlist_id = $_POST['wishlist_id'];
    
        $query = $conn->prepare("DELETE FROM wishlist WHERE id = ? AND user_id = ?");
        $query->bind_param("ii", $wishlist_id, $user_id);
    
        if ($query->execute()) {
            $_SESSION['message'] = 'Removed from wishlist';
        } else {
            $_SESSION['message'] = 'Failed to remove';
        }
    }
    // Fetch wishlist items
    $query = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contents="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>wishlist</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<?php include 'header.php';?>

<section id="wishlist" class="section-p1">
   
    
    <?php if ($result->num_rows > 0) { ?>
        <div class="wishlist-container">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="wishlist-item">
                    <img src="uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <div class="wishlist-details">
                        <h4><?php echo $row['name']; ?></h4>
                        <p><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $row['price']; ?></p>
                        <div class="wishlist-actions">
                        <form action="" method="post">
                            <input type="hidden" name="wishlist_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="remove" class="remove-btn">Remove</button>
                        </form>
                        <form action="" method="POST">
                            <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="price" value="<?php echo htmlspecialchars($row['price']); ?>">
                            <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
                            <button type="submit" name="add_to_cart" class="best_btn">Add to Cart</button>
                        </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p class="wishp">No items in your wishlist</p>
    <?php } ?>
</section>


<div class="wish">
<?php include 'footer.php';?>
</div>

<script src="script.js"></script>

    </body>
</html>