<?php
// Repair broken nested PHP tags in views
$dir = __DIR__ . '/app/views';
$it = new RecursiveDirectoryIterator($dir);
$it = new RecursiveIteratorIterator($it);

foreach($it as $file) {
    if($file->isFile() && $file->getExtension() == 'php') {
        $path = $file->getPathname();
        $c = file_get_contents($path);
        $original = $c;
        
        // Match: <?= BASE_URL ? >/<?= ltrim($item["image"], '/') ? >
        // We break the ?> to avoid PHP parser issues in this script
        
        // Match nested tags specifically
        // Replacement: <?= BASE_URL . '/' . ltrim($1, '/') ? >
        
        $c = preg_replace('/<\?=\s*BASE_URL\s*\?>\s*\/\s*<\?=\s*ltrim\s*\(([^)]*)\s*,\s*[\'"]\/[\'"]\s*\)\s*\?>/i', '<?= BASE_URL . \'/\' . ltrim($1, \'/\') ?>', $c);

        if ($c !== $original) {
            file_put_contents($path, $c);
            echo "Repaired: $path\n";
        }
    }
}
echo "Comprehensive repair complete!\n";
?>
