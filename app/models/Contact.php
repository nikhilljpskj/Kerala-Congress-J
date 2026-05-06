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

    public function getInquiries($districtId = null) {
        $where = $districtId ? "WHERE c.district_id = :district_id" : "";
        $sql = "SELECT c.*, d.name as district_name 
                FROM contacts c 
                LEFT JOIN districts d ON c.district_id = d.id 
                $where 
                ORDER BY c.created_at DESC";
        
        $stmt = $this->pdo->prepare($sql);
        if ($districtId) {
            $stmt->bindValue(':district_id', $districtId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
