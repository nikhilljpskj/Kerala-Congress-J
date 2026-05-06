<?php
require_once __DIR__ . '/config/database.php';
use config\Database;

$jsonFile = 'n:/XAMPP/htdocs/keralacongress.org.in/images_to_import.json';
if (!file_exists($jsonFile)) {
    die("JSON file not found. Run list_images_for_import.php first.\n");
}

$images = json_decode(file_get_contents($jsonFile), true);
$targetDir = 'n:/XAMPP/htdocs/keralacongress.org.in/public/uploads/cms/legacy/';

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$db = new Database();
$conn = $db->getConnection();

$successCount = 0;
$failCount = 0;

foreach ($images as $img) {
    if (!file_exists($img['full_path'])) {
        echo "Source file not found: " . $img['full_path'] . "\n";
        $failCount++;
        continue;
    }

    $ext = pathinfo($img['full_path'], PATHINFO_EXTENSION);
    $cleanName = preg_replace('/[^a-z0-9]/i', '_', pathinfo($img['filename'], PATHINFO_FILENAME));
    $newName = 'legacy_' . $img['category'] . '_' . $cleanName . '_' . uniqid() . '.' . $ext;
    $destPath = $targetDir . $newName;

    if (copy($img['full_path'], $destPath)) {
        $dbPath = '/uploads/cms/legacy/' . $newName;
        $title = ucfirst(str_replace('_', ' ', $cleanName));
        
        $stmt = $conn->prepare("INSERT INTO gallery (title, image_path, category, status, created_at) VALUES (?, ?, ?, ?, NOW())");
        if ($stmt->execute([$title, $dbPath, $img['category'], 1])) {
            $successCount++;
        } else {
            echo "DB Error for: " . $img['filename'] . "\n";
            $failCount++;
        }
    } else {
        echo "Copy Error for: " . $img['filename'] . "\n";
        $failCount++;
    }
}

echo "Import Complete!\n";
echo "Success: $successCount\n";
echo "Failed: $failCount\n";
?>
