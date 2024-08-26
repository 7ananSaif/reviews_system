<?php
include 'db/db-connect.php';
$requestMethod = $_SERVER['REQUEST_METHOD'];
$user_id = $_SESSION['user_id'];

if ($user_id > 0) {
    if ($requestMethod == 'GET') {
        $product_id = $_GET['id'];

        $stmt = $conn->prepare("SELECT * FROM comments_reviews_ratings WHERE item_id = :id");
        $stmt->bindParam(':id', $product_id);

        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reviews);
    } elseif ($requestMethod == 'DELETE') {
        $review_id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM comments_reviews_ratings WHERE id = :id");
        $stmt->bindParam(':id', $review_id);
        $result = $stmt->execute();

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Review deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Error deleting the review']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed']);
    }
}
exit;