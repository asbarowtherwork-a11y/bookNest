<?php
session_start();
// Connect to database
$conn = new mysqli("localhost", "root", "", "shop_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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

// Check if ID is passed in URL
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Fetch book details based on the given ID
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If book found, fetch details
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>Book not found!</p>";
        exit;
    }
} else {
    echo "<p>No book selected.</p>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contents="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>About</title>
        <link rel="stylesheet" href="style.css?v=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="script.js"></script>

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


 <section id="prodetails" class="section-p1">
    <div class="single-pro-image">
        <img src="uploaded_img/<?php echo $row['image']; ?>" width="100%" id="bookImage" alt="<?php echo $row['title']; ?>">
    </div>

    <div class="single-pro-details">
        <h4><?php echo $row['name']; ?></h4>
        <h3>By <?php echo $row['author']; ?></h3>
        <div class="bestmrp">
            <p>MRP: <i class="fa-solid fa-indian-rupee-sign"></i><span><?php echo $row['price']; ?></span></p>
        </div>
        <div class="preview">
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
        
        <div class="describe">
        <div class="button-container">
        <form action="wishlist.php" method="post">
    <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
    <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
    <button type="submit" name="add_to_wishlist" class="wishlist-btn"><i class="fa-solid fa-heart"></i>
    </button>
        
</form>

<form action="" method="POST">
                            <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="price" value="<?php echo htmlspecialchars($row['price']); ?>">
                            <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
                            <button type="submit" name="add_to_cart" class="best_btn">Add to Cart</button>
                        </form>
        </div>
            <h5>Description</h5>
            <span><?php echo $row['description']; ?></span>
        </div>
    </div>
    </section>

    <!--<section id="prodetails" class="section-p1">

        <div class="single-pro-image">
          <img src="images/a1.png" width="100%" id="SoulImage" alt="">
        </div>

        <div class="single-pro-details">
            <h4>Soul</h4>
            <h3>By Olivia Wilson</h3>
            <div class="bestmrp">
                        <p>MRP:<i class="fa-solid fa-indian-rupee-sign"></i><span>499</span></p>
            </div>
            <div class="preview">
            <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star-half-stroke"></i>
            </div>
            
           <div class="describe" ><i class="fa-solid fa-heart"></i>
            <button class="normal">Add To Cart</button>
            <h5>Description</h5>
            <span>The life that Kim and Krickitt Carpenter knew changed completely on November 24, 1993, two months after their wedding, when the rear of their car was hit by a speeding truck. A serious head injury left Krickitt in a coma for several weeks. When she finally woke up, part of her memory was compromised, and she couldn't remember her husband.</span>
        </div>
        </div>

    </section>-->




<section class="home_featured">
            <h1>You Also Might Like</h1>
         <?php include 'recom.php';?>
</section>

<section class="ratingheading">
<h2>Customer Reviews</h2>  
<?php include 'product_detail.php';?>
</section>
<?php include 'footer.php';?>





    </body>
</html>