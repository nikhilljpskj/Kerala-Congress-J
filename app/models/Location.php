<?php

namespace app\models;

use PDO;
use config\Database;

class Location {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getDistricts() {
        $stmt = $this->db->query("SELECT id, name FROM districts ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAssemblies($districtId) {
        $stmt = $this->db->prepare("SELECT id, name FROM assemblies WHERE district_id = ? ORDER BY id ASC");
        $stmt->execute([$districtId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLocalBodies($assemblyId) {
        $stmt = $this->db->prepare("SELECT id, name FROM local_bodies WHERE assembly_id = ? ORDER BY id ASC");
        $stmt->execute([$assemblyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
