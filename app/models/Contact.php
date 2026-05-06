<?php

namespace app\models;

use config\Database;
use PDO;

class Contact {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function save($data) {
        $sql = "INSERT INTO contacts (name, email, mobile, district_id, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['mobile'],
            $data['district_id'] ?: null,
            $data['message']
        ]);
    }

    public function getInquiries($districtId = null, $search = '', $offset = null, $limit = null) {
        $conditions = [];
        $params = [];

        if ($districtId) {
            $conditions[] = "c.district_id = :district_id";
            $params[':district_id'] = [(int)$districtId, PDO::PARAM_INT];
        }
        if ($search !== '') {
            $conditions[] = "(c.name LIKE :search OR c.email LIKE :search OR c.mobile LIKE :search OR c.message LIKE :search OR d.name LIKE :search)";
            $params[':search'] = ['%' . $search . '%', PDO::PARAM_STR];
        }

        $where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";
        $sql = "SELECT c.*, d.name as district_name 
                FROM contacts c 
                LEFT JOIN districts d ON c.district_id = d.id 
                $where 
                ORDER BY c.created_at DESC";

        if ($offset !== null && $limit !== null) {
            $sql .= " LIMIT :offset, :limit";
        }
        
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $name => [$value, $type]) {
            $stmt->bindValue($name, $value, $type);
        }
        if ($offset !== null && $limit !== null) {
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countInquiries($districtId = null, $search = '') {
        $conditions = [];
        $params = [];

        if ($districtId) {
            $conditions[] = "c.district_id = :district_id";
            $params[':district_id'] = [(int)$districtId, PDO::PARAM_INT];
        }
        if ($search !== '') {
            $conditions[] = "(c.name LIKE :search OR c.email LIKE :search OR c.mobile LIKE :search OR c.message LIKE :search OR d.name LIKE :search)";
            $params[':search'] = ['%' . $search . '%', PDO::PARAM_STR];
        }

        $where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";
        $sql = "SELECT COUNT(*)
                FROM contacts c
                LEFT JOIN districts d ON c.district_id = d.id
                $where";
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $name => [$value, $type]) {
            $stmt->bindValue($name, $value, $type);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function getById($id) {
        $sql = "SELECT c.*, d.name as district_name 
                FROM contacts c 
                LEFT JOIN districts d ON c.district_id = d.id 
                WHERE c.id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM contacts WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
