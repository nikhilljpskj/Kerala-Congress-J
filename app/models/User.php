<?php

namespace app\models;

use config\Database;

class User {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND status = 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
    
    public function getUserRoles($userId) {
        $sql = "SELECT r.slug FROM roles r 
                JOIN user_roles ur ON r.id = ur.role_id 
                WHERE ur.user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }
    
    public function getUserPermissions($userId) {
        $sql = "SELECT DISTINCT p.slug FROM permissions p 
                JOIN role_permissions rp ON p.id = rp.permission_id
                JOIN user_roles ur ON rp.role_id = ur.role_id
                WHERE ur.user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function getUsersByRole($roleSlug) {
        $sql = "SELECT u.*, d.name AS district 
                FROM users u
                JOIN user_roles ur ON u.id = ur.user_id
                JOIN roles r ON ur.role_id = r.id
                LEFT JOIN districts d ON u.district_id = d.id
                WHERE r.slug = :role_slug
                ORDER BY u.id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['role_slug' => $roleSlug]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAssignableRoles() {
        $sql = "SELECT * FROM roles 
                WHERE slug IN ('state_admin', 'district_admin', 'content_manager')
                ORDER BY FIELD(slug, 'state_admin', 'district_admin', 'content_manager')";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAdminUsersPaginated($search = '', $roleSlug = '', $offset = 0, $limit = 10) {
        $conditions = ["r.slug IN ('state_admin', 'district_admin', 'content_manager')"];
        $params = [];

        if ($roleSlug !== '') {
            $conditions[] = "r.slug = :role_slug";
            $params[':role_slug'] = [$roleSlug, \PDO::PARAM_STR];
        }
        if ($search !== '') {
            $conditions[] = "(u.name LIKE :search OR u.email LIKE :search OR u.phone LIKE :search OR d.name LIKE :search OR r.name LIKE :search)";
            $params[':search'] = ['%' . $search . '%', \PDO::PARAM_STR];
        }

        $where = "WHERE " . implode(" AND ", $conditions);
        $sql = "SELECT u.*, d.name AS district, r.slug AS role_slug, r.name AS role_name
                FROM users u
                JOIN user_roles ur ON u.id = ur.user_id
                JOIN roles r ON ur.role_id = r.id
                LEFT JOIN districts d ON u.district_id = d.id
                $where
                ORDER BY u.id DESC
                LIMIT :offset, :limit";
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $name => [$value, $type]) {
            $stmt->bindValue($name, $value, $type);
        }
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countAdminUsers($search = '', $roleSlug = '') {
        $conditions = ["r.slug IN ('state_admin', 'district_admin', 'content_manager')"];
        $params = [];

        if ($roleSlug !== '') {
            $conditions[] = "r.slug = :role_slug";
            $params[':role_slug'] = [$roleSlug, \PDO::PARAM_STR];
        }
        if ($search !== '') {
            $conditions[] = "(u.name LIKE :search OR u.email LIKE :search OR u.phone LIKE :search OR d.name LIKE :search OR r.name LIKE :search)";
            $params[':search'] = ['%' . $search . '%', \PDO::PARAM_STR];
        }

        $where = "WHERE " . implode(" AND ", $conditions);
        $sql = "SELECT COUNT(*)
                FROM users u
                JOIN user_roles ur ON u.id = ur.user_id
                JOIN roles r ON ur.role_id = r.id
                LEFT JOIN districts d ON u.district_id = d.id
                $where";
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $name => [$value, $type]) {
            $stmt->bindValue($name, $value, $type);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function getUsersByRolePaginated($roleSlug, $search = '', $offset = 0, $limit = 10) {
        $searchSql = $search !== '' ? " AND (u.name LIKE :search OR u.email LIKE :search OR u.phone LIKE :search OR d.name LIKE :search)" : "";
        $sql = "SELECT u.*, d.name AS district 
                FROM users u
                JOIN user_roles ur ON u.id = ur.user_id
                JOIN roles r ON ur.role_id = r.id
                LEFT JOIN districts d ON u.district_id = d.id
                WHERE r.slug = :role_slug
                $searchSql
                ORDER BY u.id DESC
                LIMIT :offset, :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':role_slug', $roleSlug, \PDO::PARAM_STR);
        if ($search !== '') {
            $stmt->bindValue(':search', '%' . $search . '%', \PDO::PARAM_STR);
        }
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countUsersByRole($roleSlug, $search = '') {
        $searchSql = $search !== '' ? " AND (u.name LIKE :search OR u.email LIKE :search OR u.phone LIKE :search OR d.name LIKE :search)" : "";
        $sql = "SELECT COUNT(*)
                FROM users u
                JOIN user_roles ur ON u.id = ur.user_id
                JOIN roles r ON ur.role_id = r.id
                LEFT JOIN districts d ON u.district_id = d.id
                WHERE r.slug = :role_slug
                $searchSql";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':role_slug', $roleSlug, \PDO::PARAM_STR);
        if ($search !== '') {
            $stmt->bindValue(':search', '%' . $search . '%', \PDO::PARAM_STR);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function createUser($name, $email, $phone, $password, $district_id, $roleSlug) {
        try {
            $this->pdo->beginTransaction();

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $this->pdo->prepare("INSERT INTO users (name, email, phone, password, district_id, status) VALUES (?, ?, ?, ?, ?, 1)");
            $stmt->execute([$name, $email, $phone, $hashedPassword, $district_id]);
            
            $userId = $this->pdo->lastInsertId();

            $roleStmt = $this->pdo->prepare("SELECT id FROM roles WHERE slug = ?");
            $roleStmt->execute([$roleSlug]);
            $role = $roleStmt->fetch();

            if ($role) {
                $urStmt = $this->pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");
                $urStmt->execute([$userId, $role['id']]);
            }

            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function updateUserRole($userId, $roleSlug) {
        $roleStmt = $this->pdo->prepare("SELECT id FROM roles WHERE slug = ?");
        $roleStmt->execute([$roleSlug]);
        $role = $roleStmt->fetch();

        if (!$role) {
            return false;
        }

        $this->pdo->beginTransaction();
        try {
            $deleteStmt = $this->pdo->prepare("DELETE FROM user_roles WHERE user_id = ?");
            $deleteStmt->execute([$userId]);

            $insertStmt = $this->pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");
            $insertStmt->execute([$userId, $role['id']]);

            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function toggleUserStatus($userId) {
        // Find current status
        $stmt = $this->pdo->prepare("SELECT status FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();

        if ($user) {
            $newStatus = $user['status'] == 1 ? 0 : 1;
            $updateStmt = $this->pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
            return $updateStmt->execute([$newStatus, $userId]);
        }
        return false;
    }

    public function updateUser($userId, $data) {
        $sql = "UPDATE users SET name = :name, email = :email, phone = :phone, district_id = :district_id WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'district_id' => $data['district_id'],
            'id' => $userId
        ]);
    }

    public function getAllPermissions() {
        $stmt = $this->pdo->query("SELECT * FROM permissions ORDER BY id ASC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getRolesWithPermissions() {
        $sql = "SELECT r.*, GROUP_CONCAT(p.slug ORDER BY p.id) AS permission_slugs
                FROM roles r
                LEFT JOIN role_permissions rp ON r.id = rp.role_id
                LEFT JOIN permissions p ON rp.permission_id = p.id
                GROUP BY r.id
                ORDER BY FIELD(r.slug, 'super_admin', 'state_admin', 'district_admin', 'content_manager', 'subdistrict_admin'), r.name";
        $stmt = $this->pdo->query($sql);
        $roles = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($roles as &$role) {
            $role['permission_slugs'] = $role['permission_slugs'] ? explode(',', $role['permission_slugs']) : [];
        }

        return $roles;
    }

    public function updateRolePermissions($roleId, $permissionIds) {
        $roleStmt = $this->pdo->prepare("SELECT slug FROM roles WHERE id = ?");
        $roleStmt->execute([$roleId]);
        $role = $roleStmt->fetch();

        if (!$role || $role['slug'] === 'super_admin') {
            return false;
        }

        $permissionIds = array_values(array_filter(array_map('intval', (array)$permissionIds)));

        $this->pdo->beginTransaction();
        try {
            $deleteStmt = $this->pdo->prepare("DELETE FROM role_permissions WHERE role_id = ?");
            $deleteStmt->execute([$roleId]);

            if (!empty($permissionIds)) {
                $insertStmt = $this->pdo->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)");
                foreach ($permissionIds as $permissionId) {
                    $insertStmt->execute([$roleId, $permissionId]);
                }
            }

            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function changePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        return $stmt->execute([
            'password' => $hashedPassword,
            'id' => $userId
        ]);
    }

    public function deleteUser($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$userId]);
    }
}
