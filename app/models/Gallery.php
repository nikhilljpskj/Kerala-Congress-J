<?php

namespace app\models;

use config\Database;
use PDO;

class Gallery {
    private $conn;
    private $table = "gallery";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->ensureMediaColumns();
    }

    public function getAll($category = null, $status = 1) {
        $query = "SELECT * FROM " . $this->table . " WHERE status = :status";
        
        if ($category) {
            $query .= " AND category = :category";
        }
        
        $query .= " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        
        if ($category) {
            $stmt->bindParam(':category', $category);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginated($category = null, $search = '', $offset = 0, $limit = 12, $status = 1) {
        $conditions = ["status = :status"];
        $params = [':status' => [(int)$status, PDO::PARAM_INT]];

        if ($category) {
            $conditions[] = "category = :category";
            $params[':category'] = [$category, PDO::PARAM_STR];
        }
        if ($search !== '') {
            $conditions[] = "(title LIKE :search OR category LIKE :search OR image_path LIKE :search OR video_url LIKE :search OR media_type LIKE :search)";
            $params[':search'] = ['%' . $search . '%', PDO::PARAM_STR];
        }

        $where = "WHERE " . implode(" AND ", $conditions);
        $query = "SELECT * FROM " . $this->table . " $where ORDER BY created_at DESC LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($query);
        foreach ($params as $name => [$value, $type]) {
            $stmt->bindValue($name, $value, $type);
        }
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll($category = null, $search = '', $status = 1) {
        $conditions = ["status = :status"];
        $params = [':status' => [(int)$status, PDO::PARAM_INT]];

        if ($category) {
            $conditions[] = "category = :category";
            $params[':category'] = [$category, PDO::PARAM_STR];
        }
        if ($search !== '') {
            $conditions[] = "(title LIKE :search OR category LIKE :search OR image_path LIKE :search OR video_url LIKE :search OR media_type LIKE :search)";
            $params[':search'] = ['%' . $search . '%', PDO::PARAM_STR];
        }

        $where = "WHERE " . implode(" AND ", $conditions);
        $query = "SELECT COUNT(*) FROM " . $this->table . " $where";
        $stmt = $this->conn->prepare($query);
        foreach ($params as $name => [$value, $type]) {
            $stmt->bindValue($name, $value, $type);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByIds($ids) {
        $ids = array_values(array_filter(array_map('intval', (array)$ids)));
        if (empty($ids)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $query = "SELECT * FROM " . $this->table . " WHERE id IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($ids);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
            (title, image_path, video_url, media_type, category, status) 
            VALUES (:title, :image_path, :video_url, :media_type, :category, :status)";
            
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':image_path', $data['image_path']);
        $stmt->bindParam(':video_url', $data['video_url']);
        $stmt->bindParam(':media_type', $data['media_type']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':status', $data['status']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
            SET title = :title, 
                category = :category, 
                image_path = :image_path, 
                video_url = :video_url,
                media_type = :media_type,
                status = :status 
            WHERE id = :id";
            
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':image_path', $data['image_path']);
        $stmt->bindParam(':video_url', $data['video_url']);
        $stmt->bindParam(':media_type', $data['media_type']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteMany($ids) {
        $ids = array_values(array_filter(array_map('intval', (array)$ids)));
        if (empty($ids)) {
            return false;
        }

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $query = "DELETE FROM " . $this->table . " WHERE id IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($ids);
    }

    private function ensureMediaColumns() {
        $columns = $this->conn->query("SHOW COLUMNS FROM " . $this->table)->fetchAll(PDO::FETCH_COLUMN);

        if (!in_array('media_type', $columns, true)) {
            $this->conn->exec("ALTER TABLE " . $this->table . " ADD COLUMN media_type VARCHAR(20) NOT NULL DEFAULT 'image' AFTER image_path");
        }

        if (!in_array('video_url', $columns, true)) {
            $this->conn->exec("ALTER TABLE " . $this->table . " ADD COLUMN video_url VARCHAR(500) NULL AFTER image_path");
        }
    }
}
