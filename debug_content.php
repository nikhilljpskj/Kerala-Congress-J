<?php
require_once __DIR__ . '/config/database.php';
use config\Database;

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->query("SELECT id, title, image, category FROM contents WHERE status = 1 ORDER BY created_at DESC LIMIT 10");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($results, JSON_PRETTY_PRINT);
