<?php

namespace app\models;

use config\Database;
use PDO;

class Member {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    /**
     * Get all members for Super Admin
     */
    public function getAllMembers() {
        $sql = "SELECT m.*, d.name AS district_name, a.name AS assembly_name, lb.name AS local_body_name 
                FROM members m
                LEFT JOIN districts d ON m.district_id = d.id
                LEFT JOIN assemblies a ON m.assembly_id = a.id
                LEFT JOIN local_bodies lb ON m.local_body_id = lb.id
                ORDER BY m.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get paginated members
     */
    public function getMembersPaginated($offset, $limit, $districtId = null) {
        $where = $districtId ? "WHERE m.district_id = :district_id" : "";
        $sql = "SELECT m.*, d.name AS district_name, a.name AS assembly_name, lb.name AS local_body_name 
                FROM members m
                LEFT JOIN districts d ON m.district_id = d.id
                LEFT JOIN assemblies a ON m.assembly_id = a.id
                LEFT JOIN local_bodies lb ON m.local_body_id = lb.id
                $where
                ORDER BY m.id DESC
                LIMIT :offset, :limit";
        
        $stmt = $this->pdo->prepare($sql);
        if ($districtId) {
            $stmt->bindValue(':district_id', $districtId, PDO::PARAM_INT);
        }
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get total member count for pagination
     */
    public function getTotalMemberCount($districtId = null) {
        $where = $districtId ? "WHERE district_id = :district_id" : "";
        $sql = "SELECT COUNT(*) FROM members $where";
        $stmt = $this->pdo->prepare($sql);
        if ($districtId) {
            $stmt->execute(['district_id' => $districtId]);
        } else {
            $stmt->execute();
        }
        return $stmt->fetchColumn();
    }

    /**
     * Get members for a specific district (for District Admin)
     */
    public function getMembersByDistrict($districtId) {
        $sql = "SELECT m.*, d.name AS district_name, a.name AS assembly_name, lb.name AS local_body_name 
                FROM members m
                LEFT JOIN districts d ON m.district_id = d.id
                LEFT JOIN assemblies a ON m.assembly_id = a.id
                LEFT JOIN local_bodies lb ON m.local_body_id = lb.id
                WHERE m.district_id = :district_id
                ORDER BY m.id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['district_id' => $districtId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a specific member by ID
     */
    public function getById($id) {
        $sql = "SELECT m.*, d.name AS district_name, a.name AS assembly_name, lb.name AS local_body_name 
                FROM members m
                LEFT JOIN districts d ON m.district_id = d.id
                LEFT JOIN assemblies a ON m.assembly_id = a.id
                LEFT JOIN local_bodies lb ON m.local_body_id = lb.id
                WHERE m.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Approve a member (set status to 1)
     */
    public function approve($id) {
        $stmt = $this->pdo->prepare("UPDATE members SET status = 1 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Reject/Delete a member
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM members WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Get member counts (total, pending, approved)
     */
    public function getStats($districtId = null) {
        $where = $districtId ? "WHERE district_id = :district_id" : "";
        $params = $districtId ? ['district_id' => $districtId] : [];

        $sql = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as pending,
                    SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as approved
                FROM members $where";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get district-wise member counts
     */
    public function getDistrictStats() {
        $sql = "SELECT d.name, COUNT(m.id) as count 
                FROM districts d
                LEFT JOIN members m ON d.id = m.district_id
                GROUP BY d.id, d.name
                ORDER BY count DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get gender-wise member counts
     */
    public function getGenderStats($districtId = null) {
        $where = $districtId ? "WHERE district_id = :district_id" : "";
        $params = $districtId ? ['district_id' => $districtId] : [];

        $sql = "SELECT gender, COUNT(*) as count 
                FROM members 
                $where
                GROUP BY gender";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
