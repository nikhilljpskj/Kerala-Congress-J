<?php
$img = 'images/logo_kc.svg';
if (file_exists(__DIR__ . '/' . $img)) {
    echo "File exists: " . __DIR__ . '/' . $img . "<br>";
    echo "Web path test: <img src='" . $img . "' alt='test'>";
} else {
    echo "File NOT found: " . __DIR__ . '/' . $img;
}
?>
