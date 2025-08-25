<?php
include 'config.php';
require 'fetchReviews.php';  // Include the reviews and ratings fetching logic
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
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

<div class="product-reviews">
    
    <h3>Average Rating: 
        <?php 
            $avgRating = round($ratingData['avg_rating'], 2); // Get average rating
            // Display the stars based on the average rating
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $avgRating) {
                    echo '<span class="star">&#9733;</span>';  // Filled star
                } else {
                    echo '<span class="star">&#9734;</span>';  // Empty star
                }
            }
        ?>
    </h3>
    <h4>Total Reviews: <?= $ratingData['total_reviews'] ?></h4>
    <div class="review-bar">
        <div class="filled" style="width: <?= ($avgRating / 5) * 100 ?>%"></div>
    </div>
</div>


<!-- Display all reviews -->
<div class="reviews-list">
    <?php foreach ($reviews as $review): ?>
        <div class="review">
            <strong><?= $review['userName'] ?></strong>
            <div class="review-rating"> <?php
                    $userRating = $review['userReview'];  // Get user rating
                    // Display the stars for user rating
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $userRating) {
                            echo '<span class="star">&#9733;</span>';  // Filled star
                        } else {
                            echo '<span class="star">&#9734;</span>';  // Empty star
                        }
                    }
                ?>
            </div>
            <p><?= $review['userMessage'] ?></p>
            <small>Reviewed on: <?= $review['dateReviewed'] ?></small>
        </div>
    <?php endforeach; ?>
</div>

<!-- Add Review Button -->
<button id="addReviewBtn">Add Review</button>

<!-- Review Modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Add Your Review</h2>
        <form id="reviewForm" method="POST" action="addReview.php">
            <label for="userName">Your Name:</label>
            <input type="text" id="userName" name="userName" required>
            <label for="userReview">Rating:</label>
    <div id="starRating" class="star-rating">
        <span class="star" data-value="1">&#9733;</span>
        <span class="star" data-value="2">&#9733;</span>
        <span class="star" data-value="3">&#9733;</span>
        <span class="star" data-value="4">&#9733;</span>
        <span class="star" data-value="5">&#9733;</span>
    </div>
            <input type="number" id="userReview" name="userReview" min="1" max="5" required>
            <label for="userMessage">Review Message:</label>
            <textarea id="userMessage" name="userMessage" required></textarea>
            <input type="hidden" name="product_id" value="<?= $product_id ?>">
            <button id ="postbtn" type="submit" name="submit_review">Post</button>
        </form>
    </div>
</div>

<script src="review.js"></script>

</body>
</html>
