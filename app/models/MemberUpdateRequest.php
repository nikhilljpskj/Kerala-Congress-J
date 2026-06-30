<?php

namespace app\models;

use config\Database;
use PDO;

class MemberUpdateRequest {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function findMemberByIdentifier($identifier) {
        $identifier = trim($identifier);
        if ($identifier === '') {
            return false;
        }

        $sql = "SELECT m.id, m.reg_no, m.fname, m.lname, m.email, m.mobile, m.photo, m.district, m.district_id,
                       d.name AS district_name
                FROM members m
                LEFT JOIN districts d ON m.district_id = d.id
                WHERE m.mobile = :identifier OR m.email = :identifier
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['identifier' => $identifier]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($memberId, $identifier, $requestedChanges, $photoPath = null) {
        $sql = "INSERT INTO member_update_requests
                    (member_id, requested_by, requested_changes, requested_photo, status)
                VALUES
                    (:member_id, :requested_by, :requested_changes, :requested_photo, 'pending')";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'member_id' => $memberId,
            'requested_by' => $identifier,
            'requested_changes' => $requestedChanges,
            'requested_photo' => $photoPath
        ]);
    }

    public function getPaginated($districtId = null, $search = '', $status = '', $offset = 0, $limit = 10) {
        $conditions = [];
        $params = [];

        if ($districtId) {
            $conditions[] = "m.district_id = :district_id";
            $params[':district_id'] = [(int)$districtId, PDO::PARAM_INT];
        }
        if ($status !== '') {
            $conditions[] = "r.status = :status";
            $params[':status'] = [$status, PDO::PARAM_STR];
        }
        if ($search !== '') {
            $conditions[] = "(m.reg_no LIKE :search OR m.fname LIKE :search OR m.lname LIKE :search OR m.mobile LIKE :search OR m.email LIKE :search OR r.requested_by LIKE :search)";
            $params[':search'] = ['%' . $search . '%', PDO::PARAM_STR];
        }

        $where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
        $sql = "SELECT r.*, m.reg_no, m.fname, m.lname, m.email, m.mobile, m.district, m.district_id,
                       d.name AS district_name, u.name AS reviewed_by_name
                FROM member_update_requests r
                JOIN members m ON r.member_id = m.id
                LEFT JOIN districts d ON m.district_id = d.id
                LEFT JOIN users u ON r.reviewed_by = u.id
                $where
                ORDER BY r.id DESC
                LIMIT :offset, :limit";
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $name => [$value, $type]) {
            $stmt->bindValue($name, $value, $type);
        }
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll($districtId = null, $search = '', $status = '') {
        $conditions = [];
        $params = [];

        if ($districtId) {
            $conditions[] = "m.district_id = :district_id";
            $params[':district_id'] = [(int)$districtId, PDO::PARAM_INT];
        }
        if ($status !== '') {
            $conditions[] = "r.status = :status";
            $params[':status'] = [$status, PDO::PARAM_STR];
        }
        if ($search !== '') {
            $conditions[] = "(m.reg_no LIKE :search OR m.fname LIKE :search OR m.lname LIKE :search OR m.mobile LIKE :search OR m.email LIKE :search OR r.requested_by LIKE :search)";
            $params[':search'] = ['%' . $search . '%', PDO::PARAM_STR];
        }

        $where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
        $sql = "SELECT COUNT(*)
                FROM member_update_requests r
                JOIN members m ON r.member_id = m.id
                LEFT JOIN districts d ON m.district_id = d.id
                $where";
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $name => [$value, $type]) {
            $stmt->bindValue($name, $value, $type);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function getById($id) {
        $sql = "SELECT r.*, m.reg_no, m.fname, m.lname, m.email, m.mobile, m.district_id
                FROM member_update_requests r
                JOIN members m ON r.member_id = m.id
                WHERE r.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status, $reviewedBy, $adminNote = '') {
        $sql = "UPDATE member_update_requests
                SET status = :status, reviewed_by = :reviewed_by, reviewed_at = NOW(), admin_note = :admin_note
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'status' => $status,
            'reviewed_by' => $reviewedBy,
            'admin_note' => $adminNote,
            'id' => $id
        ]);
    }
}
