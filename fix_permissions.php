<?php
require_once 'config/database.php';

use config\Database;

$db = new Database();
$conn = $db->getConnection();

echo "Starting permission fix...\n";

try {
    // Get permission ID for manage_members
    $stmt = $conn->prepare("SELECT id FROM permissions WHERE slug = 'manage_members'");
    $stmt->execute();
    $perm = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$perm) {
        die("Permission 'manage_members' not found. Please run migration first.\n");
    }

    $permId = $perm['id'];

    // Get role IDs for state_admin and district_admin
    $rolesToFix = ['state_admin', 'district_admin'];
    
    foreach ($rolesToFix as $roleSlug) {
        $stmt = $conn->prepare("SELECT id FROM roles WHERE slug = ?");
        $stmt->execute([$roleSlug]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($role) {
            $roleId = $role['id'];
            // Check if permission already exists
            $checkStmt = $conn->prepare("SELECT * FROM role_permissions WHERE role_id = ? AND permission_id = ?");
            $checkStmt->execute([$roleId, $permId]);
            
            if (!$checkStmt->fetch()) {
                $insertStmt = $conn->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)");
                $insertStmt->execute([$roleId, $permId]);
                echo "Assigned 'manage_members' to '$roleSlug'.\n";
            } else {
                echo "Role '$roleSlug' already has 'manage_members' permission.\n";
            }
        } else {
            echo "Role '$roleSlug' not found.\n";
        }
    }

    echo "Permission fix completed successfully.\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
