<?php
require_once 'config/database.php';
use config\Database;

$db = new Database();
$conn = $db->getConnection();

$result = $conn->query("DESCRIBE members");
$columns = $result->fetchAll(PDO::FETCH_ASSOC);

foreach ($columns as $col) {
    echo $col['Field'] . "\n";
}
