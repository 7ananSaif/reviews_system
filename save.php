<?php 
include("db/db-connect.php");
$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

$date = date("Y-m-d H:i:s");

if(isset($_POST['save']) && $user_id > 0){
    $comment = $_POST['comment'] ?? '';
    $review = $_POST['review'] ?? '';
    $rating = $_POST['rating'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM comments_reviews_ratings WHERE item_id = :product_id AND user_id = :user_id");
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute(); 

    if($stmt->rowCount() == 0){
        $sql = "INSERT INTO comments_reviews_ratings (`comment`, `review`, `rating`, `user_id`, `item_id`) VALUES (:comment, :review, :rating, :user_id, :product_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':review', $review);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        if($stmt->execute()){
            echo "success";
        } else {
            echo "error";
        }
    } else {
        $sql = "UPDATE comments_reviews_ratings SET `comment` = :comment, `review` = :review, `rating` = :rating, `updated_at` = :date WHERE item_id = :product_id AND user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':review', $review);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':user_id', $user_id);
        if($stmt->execute()){
            echo "success";
        } else {
            echo "error";
        }
    }
}
    exit; 
?>