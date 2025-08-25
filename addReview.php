<?php

session_start();
require 'config.php';


if (isset($_POST['submit_review'])) {
    $product_id = $_POST['product_id'];
    $userName = $_POST['userName'];
    $userReview = $_POST['userReview'];
    $userMessage = $_POST['userMessage'];

    // Insert the review into the reviews table
    $query = "INSERT INTO reviews (product_id, userName, userReview, userMessage) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isis", $product_id, $userName, $userReview, $userMessage);
    $stmt->execute();

    // After inserting the review, update the average rating and total reviews in the ratings table
    $ratingQuery = "SELECT AVG(userReview) AS avg_rating, COUNT(id) AS total_reviews FROM reviews WHERE product_id = ?";
    $stmt = $conn->prepare($ratingQuery);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ratingData = $result->fetch_assoc();

    $avg_rating = $ratingData['avg_rating'];
    $total_reviews = $ratingData['total_reviews'];

    // Update or insert the new average rating into the ratings table
    $updateQuery = "INSERT INTO ratings (product_id, avg_rating, total_reviews) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE avg_rating = ?, total_reviews = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("idiii", $product_id, $avg_rating, $total_reviews, $avg_rating, $total_reviews);
    $stmt->execute();

    $_SESSION['message'] = "Thanks for your review";

    // Redirect after review is added
    header("Location: bestsellers.php" . $id);
    exit;
}
?>
