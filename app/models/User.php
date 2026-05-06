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
