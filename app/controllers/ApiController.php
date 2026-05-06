<?php

namespace app\controllers;

use app\models\Location;

class ApiController {

    private $locationModel;

    public function __construct() {
        $this->locationModel = new Location();
    }

    public function getDistricts() {
        header('Content-Type: application/json');
        try {
            $districts = $this->locationModel->getDistricts();
            echo json_encode(['success' => true, 'data' => $districts]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error fetching districts']);
        }
    }

    public function getAssemblies() {
        header('Content-Type: application/json');
        $districtId = isset($_GET['district_id']) ? (int)$_GET['district_id'] : 0;
        
        if ($districtId <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid district ID']);
            return;
        }

        try {
            $assemblies = $this->locationModel->getAssemblies($districtId);
            echo json_encode(['success' => true, 'data' => $assemblies]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error fetching assemblies']);
        }
    }

    public function getLocalBodies() {
        header('Content-Type: application/json');
        $assemblyId = isset($_GET['assembly_id']) ? (int)$_GET['assembly_id'] : 0;
        
        if ($assemblyId <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid assembly ID']);
            return;
        }

        try {
            $localBodies = $this->locationModel->getLocalBodies($assemblyId);
            echo json_encode(['success' => true, 'data' => $localBodies]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error fetching local bodies']);
        }
    }
}
