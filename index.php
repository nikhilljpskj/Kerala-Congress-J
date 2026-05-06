<?php

// Front Controller at Root for Production Compatibility
require_once __DIR__ . '/vendor/autoload.php';

// Define paths
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
define('CONFIG_PATH', BASE_PATH . '/config');
define('VIEWS_PATH', APP_PATH . '/views');

// Robust BASE_URL detection
$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$baseUrl = str_replace('/index.php', '', $scriptPath);
define('BASE_URL', $baseUrl);

// Autoloader for custom classes
spl_autoload_register(function ($class) {
    // Convert namespace to full file path
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = BASE_PATH . DIRECTORY_SEPARATOR . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Load Configuration
require CONFIG_PATH . '/database.php';

// Initialize Router
require APP_PATH . '/Core/Router.php';
$router = new \app\Core\Router();

// Load Routes
require BASE_PATH . '/routes/web.php';

// Dispatch Request
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

// Remove the base directory from the URI (Handle local vs production)
$basePath = BASE_URL;
if ($basePath && strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

// Remove trailing slash if not root
if ($uri !== '/' && substr($uri, -1) === '/') {
    $uri = rtrim($uri, '/');
}

// Default to '/'
if ($uri === '') {
    $uri = '/';
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$router->dispatch($uri, $method);
