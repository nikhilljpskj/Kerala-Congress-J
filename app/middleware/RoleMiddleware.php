<?php

namespace app\middleware;

class RoleMiddleware {
    
    public function handle($permission = null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $baseUrl = defined('BASE_URL') ? BASE_URL : '/keralacongress.org.in';
            header("Location: " . $baseUrl . "/admin/login");
            exit;
        }

        // If no specific permission is required, general auth is enough (handled by AuthMiddleware anyway)
        if ($permission === null) {
            return true;
        }

        $roles = $_SESSION['roles'] ?? [];
        $permissions = $_SESSION['permissions'] ?? [];

        if (in_array('super_admin', $roles)) {
            return true;
        }

        if (in_array($permission, $permissions)) {
            return true;
        }

        // Forbidden
        http_response_code(403);
        echo "<h1>403 Forbidden - You do not have permission to access this page.</h1>";
        return false;
    }
}
