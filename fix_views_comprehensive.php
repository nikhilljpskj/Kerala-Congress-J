<?php
// Comprehensive path fixer
$dir = __DIR__ . '/app/views';
if (is_dir($dir)) {
    $it = new RecursiveDirectoryIterator($dir);
    $it = new RecursiveIteratorIterator($it);

    foreach($it as $file) {
        if($file->isFile() && $file->getExtension() == 'php') {
            $path = $file->getPathname();
            $c = file_get_contents($path);
            
            // Handle various ways /public might be prepended
            $original = $c;
            
            // Case 1: BASE_URL-linked public
            $c = str_replace('<?= BASE_URL ?>/public/', '<?= BASE_URL ?>/', $c); // With slash
            $c = str_replace('<?= BASE_URL ?>/public', '<?= BASE_URL ?>', $c);   // Without slash (handles /public<?=)
            
            // Case 2: Hardcoded /public/ in quotes
            $c = str_replace('"/public/', '"/', $c);
            $c = str_replace("'/public/", "'/", $c);
            
            // Case 3: Mixed PHP/HTML paths like src="/public<?=
            $c = str_replace('src="/public<?=', 'src="<?= BASE_URL ?><?=', $c);
            $c = str_replace("src='/public<=", "src='<?= BASE_URL ?><?=", $c);

            // Case 4: Base URL inside PHP tags (like in media.php)
            $c = str_replace('"<?= BASE_URL ?>/', 'BASE_URL . "/', $c);
            $c = str_replace("'<?= BASE_URL ?>/", "BASE_URL . '/", $c);
            
            if ($c !== $original) {
                file_put_contents($path, $c);
                echo "Fixed: $path\n";
            }
        }
    }
}
echo "Comprehensive view fix complete!\n";
?>
