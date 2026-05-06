<?php
$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$baseUrl = str_replace('/index.php', '', $scriptPath);
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "BASE_URL Detection: " . $baseUrl . "\n";
echo "SERVER_NAME: " . ($_SERVER['SERVER_NAME'] ?? 'Undefined') . "\n";
echo "HTTP_HOST: " . ($_SERVER['HTTP_HOST'] ?? 'Undefined') . "\n";
