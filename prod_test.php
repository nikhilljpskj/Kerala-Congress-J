<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Production Diagnostic</h1>";
echo "PHP Version: " . PHP_VERSION . "<br>";
echo "Server Name: " . $_SERVER['SERVER_NAME'] . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Current File: " . __FILE__ . "<br>";

$path = __DIR__ . '/public/index.php';
if (file_exists($path)) {
    echo "Found public/index.php<br>";
} else {
    echo "FAILED: public/index.php not found at $path<br>";
}

require_once __DIR__ . '/config/database.php';
$db = new \config\Database();
$conn = $db->getConnection();
if ($conn) {
    echo "Database connection successful!<br>";
} else {
    echo "Database connection FAILED.<br>";
}
?>
