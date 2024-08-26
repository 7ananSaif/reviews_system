<?php

include 'db/db-connect.php';
$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

if ($user_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM comments_reviews_ratings WHERE item_id = :id");
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($reviews);
}
