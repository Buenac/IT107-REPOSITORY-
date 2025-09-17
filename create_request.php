<?php
session_start();
require_once('../config/db.php');

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $_SESSION['user']['id'];
$doc_type = $data['document_type'];

$stmt = $conn->prepare("INSERT INTO document_requests (user_id, document_type) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $doc_type);

$response = [];
if ($stmt->execute()) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $stmt->error;
}
echo json_encode($response);
?>
