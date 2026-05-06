<?php

namespace app\middleware;

class AuthMiddleware {
    public function handle() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $baseUrl = defined('BASE_URL') ? BASE_URL : '/keralacongress.org.in';
            header("Location: " . $baseUrl . "/admin/login");
            exit;
        }

        return true;
    }
}
