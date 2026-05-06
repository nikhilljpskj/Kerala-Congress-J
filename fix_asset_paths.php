<?php
require_once __DIR__ . '/config/database.php';
use config\Database;

// 1. Update Database Gallery Paths
$db = new Database();
$conn = $db->getConnection();
if ($conn) {
    // Remove /public/ prefix if it exists in DB paths
    $stmt = $conn->prepare("UPDATE gallery SET image_path = REPLACE(image_path, '/public/', '/') WHERE image_path LIKE '/public/%'");
    $stmt->execute();
    echo "Database: Gallery paths updated.\n";
}

// 2. Update View Files
$dir = __DIR__ . '/app/views';
if (is_dir($dir)) {
    $it = new RecursiveDirectoryIterator($dir);
    $it = new RecursiveIteratorIterator($it);

    foreach($it as $file) {
        if($file->isFile() && $file->getExtension() == 'php') {
            $path = $file->getPathname();
            $c = file_get_contents($path);
            
            // Remove /public/ from links
            $newC = str_replace('<?= BASE_URL ?>/public/', '<?= BASE_URL ?>/', $c);
            $newC = str_replace('"/public/', '"/', $newC);
            $newC = str_replace("'/public/", "'/", $newC);
            
            if ($newC !== $c) {
                file_put_contents($path, $newC);
                echo "Updated: $path\n";
            }
        }
    }
}

echo "Asset path standardization complete!\n";
?>
