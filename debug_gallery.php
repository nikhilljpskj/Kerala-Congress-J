<?php
require_once __DIR__ . '/connect.php';
$stmt = $con->query("SELECT id, title, image_path FROM gallery LIMIT 20");
if ($stmt) {
    while($row = $stmt->fetch_assoc()) {
        echo "ID: " . $row['id'] . " | Path: " . $row['image_path'] . "\n";
    }
} else {
    echo "Error: " . $con->error;
}
?>
