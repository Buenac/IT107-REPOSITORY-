<?php
session_start();
require_once('../config/db.php');

$user_id = $_SESSION['user']['id'];
$role = $_SESSION['user']['role'];

if ($role == 'admin') {
    $sql = "SELECT dr.*, u.name FROM document_requests dr JOIN users u ON dr.user_id = u.id";
} else {
    $sql = "SELECT * FROM document_requests WHERE user_id = $user_id";
}

$result = $conn->query($sql);
$requests = [];

while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}

echo json_encode($requests);
?>
