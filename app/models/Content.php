<?php

namespace app\models;

use config\Database;
use PDO;

class Content {
    private $conn;
    private $table = "contents";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll($type = null, $category = null, $status = 1) {
        $query = "SELECT * FROM " . $this->table . " WHERE status = :status";
        
        if ($type) {
            $query .= " AND type = :type";
        }
        if ($category) {
            $query .= " AND category = :category";
        }
        
        $query .= " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        
        if ($type) {
            $stmt->bindParam(':type', $type);
        }
        if ($category) {
            $stmt->bindParam(':category', $category);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
            (type, category, title, slug, body, image, event_date, status) 
            VALUES (:type, :category, :title, :slug, :body, :image, :event_date, :status)";
            
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':body', $data['body']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':event_date', $data['event_date']);
        $stmt->bindParam(':status', $data['status']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
            SET type = :type, category = :category, title = :title, 
                slug = :slug, body = :body, image = :image, 
                event_date = :event_date, status = :status 
            WHERE id = :id";
            
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':body', $data['body']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':event_date', $data['event_date']);
        $stmt->bindParam(':status', $data['status']);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
