<?php
// Kết nối DB và lấy tin nhắn
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM messages ORDER BY created_at ASC";
$stmt = $db->prepare($query);
$stmt->execute();

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($messages);
?>