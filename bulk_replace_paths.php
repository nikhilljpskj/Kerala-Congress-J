<?php
$dir = 'n:/XAMPP/htdocs/keralacongress.org.in/app/views';
$it = new RecursiveDirectoryIterator($dir);
$it = new RecursiveIteratorIterator($it);

foreach($it as $file) {
    if($file->isFile() && $file->getExtension() == 'php') {
        $path = $file->getPathname();
        $c = file_get_contents($path);
        
        // Replace hardcoded sub-folder path with BASE_URL constant
        $newC = str_replace('/keralacongress.org.in/', '<?= BASE_URL ?>/', $c);
        
        if ($newC !== $c) {
            file_put_contents($path, $newC);
            echo "Updated: $path\n";
        }
    }
}
?>
