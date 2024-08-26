<?php
include 'db/db-connect.php';
$requestMethod = $_SERVER['REQUEST_METHOD'];
$user_id = $_SESSION['user_id'];

if ($user_id > 0) {
    $requestData = json_decode(file_get_contents("php://input"), true);
    $sql = "UPDATE comments SET comment = ?, review = ?, rating = ?, updated_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $requestData["comment"], $requestData["review"], $requestData["rating"], $requestData["id"]);
    $stmt->execute();

    $sql = "SELECT * FROM comments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $requestData["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $updatedData = $result->fetch_assoc();
    
}
exit;