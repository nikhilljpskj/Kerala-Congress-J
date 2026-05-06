<?php

namespace app\Core;

class Controller {
    // Render a view
    protected function view($viewName, $data = []) {
        // Extract data to variables
        extract($data);
        
        $file = VIEWS_PATH . '/' . $viewName . '.php';
        
        if (file_exists($file)) {
            require $file;
        } else {
            echo "View: $viewName not found.";
        }
    }

    // Redirect to a specific URL
    protected function redirect($url) {
        $baseUrl = defined('BASE_URL') ? BASE_URL : '/keralacongress.org.in';
        ob_clean();
        header('Location: ' . $baseUrl . $url);
        exit;
    }
}
