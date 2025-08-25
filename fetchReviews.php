<?php


require 'config.php';

$product_id = $_GET['id'];  // Get the product_id from the URL

// Fetch reviews for the given product
$query = "SELECT * FROM reviews WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$reviews = $result->fetch_all(MYSQLI_ASSOC);

// Fetch the average rating and total reviews
$ratingQuery = "SELECT avg_rating, total_reviews FROM ratings WHERE product_id = ?";
$stmt = $conn->prepare($ratingQuery);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$ratingResult = $stmt->get_result();
$ratingData = $ratingResult->fetch_assoc();
?>
