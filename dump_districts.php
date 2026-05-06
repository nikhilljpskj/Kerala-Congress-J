<?php
$_SERVER['SERVER_NAME'] = 'localhost';
require_once __DIR__ . '/config/database.php';
$db = new \config\Database();
$pdo = $db->getConnection();
$stmt = $pdo->query("SELECT * FROM districts LIMIT 5");
$results = $stmt->fetchAll();
header('Content-Type: application/json');
echo json_encode($results, JSON_PRETTY_PRINT);
