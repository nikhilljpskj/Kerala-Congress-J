<?php
$paths = [
    'n:/XAMPP/htdocs/keralacongress.org.in/public/images',
    'n:/XAMPP/htdocs/keralacongress.org.in/public/assets/images',
    'n:/XAMPP/htdocs/keralacongress.org.in/kitproc_legacy/images/news',
    'n:/XAMPP/htdocs/keralacongress.org.in/kitproc_legacy/images/icco',
    'n:/XAMPP/htdocs/keralacongress.org.in/youthfront_old/images'
];

$results = [];

foreach ($paths as $path) {
    $category = 'main';
    if (strpos($path, 'kitproc_legacy') !== false) $category = 'kitproc';
    if (strpos($path, 'youthfront_old') !== false) $category = 'kyf';
    
    if (!is_dir($path)) continue;
    
    $it = new RecursiveDirectoryIterator($path);
    $display = new RecursiveIteratorIterator($it);
    foreach($display as $file) {
        if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file->getFilename())) {
            $results[] = [
                'full_path' => $file->getRealPath(),
                'filename' => $file->getFilename(),
                'category' => $category
            ];
        }
    }
}

file_put_contents('n:/XAMPP/htdocs/keralacongress.org.in/images_to_import.json', json_encode($results, JSON_PRETTY_PRINT));
echo "Found " . count($results) . " images. Saved to images_to_import.json\n";
?>
