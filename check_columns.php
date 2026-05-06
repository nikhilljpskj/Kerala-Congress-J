<?php
$_SERVER['SERVER_NAME'] = 'localhost';
require 'config/database.php';
$db = new \config\Database();
$pdo = $db->getConnection();
$stmt = $pdo->query('SHOW COLUMNS FROM members');
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Columns in members table:\n";
foreach ($columns as $col) {
    echo "- " . $col['Field'] . " (" . $col['Type'] . ")\n";
}
