<?php
require_once 'config/database.php';
use config\Database;

$db = new Database();
$conn = $db->getConnection();

$result = $conn->query("DESCRIBE members");
$columns = $result->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($columns);
echo "</pre>";
