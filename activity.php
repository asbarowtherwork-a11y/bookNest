<?php
// Start session and connect to database
session_start();
    include 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch arrivals
$sql = "SELECT * FROM products WHERE category = 'active'";
$result = $conn->query($sql);


$ratings = []; // Array to store ratings for each product

// Query to fetch average rating and total reviews for each product
$rating_query = "SELECT product_id, AVG(avg_rating) AS avg_rating, COUNT(product_id) AS total_reviews FROM ratings GROUP BY product_id";
$rating_result = $conn->query($rating_query);

// Store rating data in an array for easy access
while ($row = $rating_result->fetch_assoc()) {
    $ratings[$row['product_id']] = [
        'avg_rating' => round($row['avg_rating'], 2) ?? 0,
        'total_reviews' => $row['total_reviews'] ?? 0
    ];
}
$user_id = $_SESSION['user_id'] ?? null; // Avoid undefined variable error

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
?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
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

<?php include 'header.php'; ?>


<div class="best">
    <h1>Activity Books</h1>
    <div class="best_box">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="best_card">
                    <div class="best_image">
                        <a href="bestpreview.php?id=<?php echo $row['id']; ?>">
                            <img src="uploaded_img/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        </a>
                    </div>
                    <div class="best_tag">
                        <p><?php echo htmlspecialchars($row["name"]); ?></p>
                        <div class="mrp"><p>MRP:<i class="fa-solid fa-indian-rupee-sign"></i><?php echo htmlspecialchars($row["price"]); ?></p></div>
                        <div class="best_icon">
                        <?php 
            $product_id = $row['id'];
            $avg_rating = $ratings[$product_id]['avg_rating'] ?? 0; // Get average rating
            $total_reviews = $ratings[$product_id]['total_reviews'] ?? 0; // Get total reviews
            
            // Loop to display stars based on average rating
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $avg_rating) {
                    echo '<span class="star">&#9733;</span>'; // Filled star
                } else {
                    echo '<span class="star">&#9734;</span>'; // Empty star
                }
            }
            ?>
       
                        </div>

                        <!-- ✅ Correct Form Inside Loop -->
                        <form action="" method="POST">
                            <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="price" value="<?php echo htmlspecialchars($row['price']); ?>">
                            <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
                            <button type="submit" name="add_to_cart" class="best_btn">Add to Cart</button>
                        </form>

                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No arrivals available.</p>";
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
<script src="script.js"></script>

</body>
</html>
