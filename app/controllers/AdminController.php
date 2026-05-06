<?php

namespace app\controllers;

use app\Core\Controller;
use app\models\Member;
use app\models\User;
use app\models\Location;

class AdminController extends Controller {

    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        
        $memberModel = new Member();
        $districtId = null;
        $isSuperAdmin = in_array('super_admin', $_SESSION['roles']);

        if (!$isSuperAdmin) {
            $userModel = new User();
            $user = $userModel->findByEmail($_SESSION['user_email']);
            $districtId = $user['district_id'] ?? null;
        }

        $stats = $memberModel->getStats($districtId);
        $genderStats = $memberModel->getGenderStats($districtId);
        $districtStats = $isSuperAdmin ? $memberModel->getDistrictStats() : [];

        return $this->view('admin/layout', [
            'pageTitle' => 'Dashboard Overview',
            'contentPath' => VIEWS_PATH . '/admin/dashboard.php',
            'stats' => $stats,
            'genderStats' => $genderStats,
            'districtStats' => $districtStats,
            'isSuperAdmin' => $isSuperAdmin
        ]);
    }

    public function users() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        
        $userModel = new User();
        // Since we are managing district authorities, we fetch them
        $districtAdmins = $userModel->getUsersByRole('district_admin');
        
        $locationModel = new Location();
        $districts = $locationModel->getDistricts();
        
        return $this->view('admin/layout', [
            'pageTitle' => 'District Authorities',
            'contentPath' => VIEWS_PATH . '/admin/users.php',
            'users' => $districtAdmins,
            'districts' => $districts
        ]);
    }

    // Add new district authority
    public function addDistrictAuthority() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = $_POST['password'] ?? '';
            $district_id = empty($_POST['district_id']) ? null : $_POST['district_id'];

            $userModel = new User();
            $userModel->createUser($name, $email, $phone, $password, $district_id, 'district_admin');
        }
        $this->redirect('/admin/users');
    }

    // Update district authority details
    public function updateDistrictAuthority() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $district_id = $_POST['district_id'] ?? null;
            $userModel = new User();
            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'district_id' => $district_id
            ];
            $userModel->updateUser($id, $data);
        }
        $this->redirect('/admin/users');
    }

    // Change password for a district authority
    public function changeAuthorityPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $newPassword = $_POST['new_password'] ?? '';
            $userModel = new User();
            $userModel->changePassword($id, $newPassword);
        }
        $this->redirect('/admin/users');
    }

    private function checkMemberAccess($member) {
        if (in_array('super_admin', $_SESSION['roles'])) {
            return true;
        }
        
        // For roles like district_admin, check the district_id
        $userModel = new User();
        $user = $userModel->findByEmail($_SESSION['user_email']);
        
        if ($user && !empty($user['district_id'])) {
            return $member['district_id'] == $user['district_id'];
        }
        
        // If state_admin or others have access to all, return true here if needed
        if (in_array('state_admin', $_SESSION['roles'])) {
            return true;
        }

        return false;
    }

    // View member details
    public function viewMemberDetails() {
        $id = $_GET['id'] ?? null;
        $memberModel = new Member();
        $member = $memberModel->getById($id);

        if (!$member || !$this->checkMemberAccess($member)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Access denied']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $member]);
    }

    // Delete a member
    public function deleteMember() {
        $id = $_GET['id'] ?? null;
        $memberModel = new Member();
        $member = $memberModel->getById($id);

        if ($member && $this->checkMemberAccess($member)) {
            $memberModel->delete($id);
        }
        $this->redirect('/admin/members');
    }



    public function toggleAuthorityStatus() {
        if (isset($_GET['id'])) {
            $userModel = new User();
            $userModel->toggleUserStatus($_GET['id']);
        }
        $this->redirect('/admin/users');
    }

    public function deleteAuthority() {
        if (isset($_GET['id'])) {
            $userModel = new User();
            $userModel->deleteUser($_GET['id']);
        }
        $this->redirect('/admin/users');
    }

    public function roles() {
        return $this->view('admin/layout', [
            'pageTitle' => 'Roles & Permissions',
            'contentPath' => VIEWS_PATH . '/admin/roles.php'
        ]);
    }

    public function subdistricts() {
        return $this->view('admin/subdistricts');
    }

    public function content() {
        return $this->view('admin/layout', [
            'pageTitle' => 'Content Management',
            'contentPath' => VIEWS_PATH . '/admin/content.php'
        ]);
    }

    public function members() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        
        $memberModel = new Member();
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;
        
        $districtId = null;
        if (!in_array('super_admin', $_SESSION['roles'])) {
            $userModel = new User();
            $user = $userModel->findByEmail($_SESSION['user_email']);
            $districtId = $user['district_id'] ?? null;
        }

        $members = $memberModel->getMembersPaginated($offset, $limit, $districtId);
        $totalMembers = $memberModel->getTotalMemberCount($districtId);
        $totalPages = ceil($totalMembers / $limit);

        return $this->view('admin/layout', [
            'pageTitle' => 'Member Registrations',
            'contentPath' => VIEWS_PATH . '/admin/members.php',
            'members' => $members,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalMembers' => $totalMembers
        ]);
    }

    public function approveMember() {
        if (isset($_GET['id'])) {
            $memberModel = new Member();
            $member = $memberModel->getById($_GET['id']);
            if ($member && $this->checkMemberAccess($member)) {
                $memberModel->approve($_GET['id']);
            }
        }
        $this->redirect('/admin/members');
    }

    public function idCard() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $id = $_GET['id'] ?? null;
        $memberModel = new Member();
        $member = $memberModel->getById($id);

        if (!$member || $member['status'] != 1 || !$this->checkMemberAccess($member)) {
            die("Access Denied or Member not approved yet.");
        }

        // Prepare Data for Template
        // Logo is now in the same folder as the view template (PNG version)
        $logoPath = VIEWS_PATH . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'logo_kc.png';
        
        // Member Photo Logic
        if (!empty($member['photo']) && file_exists(BASE_PATH . DIRECTORY_SEPARATOR . $member['photo'])) {
            $photoPath = BASE_PATH . DIRECTORY_SEPARATOR . $member['photo'];
        } else {
            $photoPath = BASE_PATH . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'Joy Abraham.jfif'; 
        }

        $qrData = "KERALA CONGRESS MEMBERSHIP\n" .
                  "--------------------------\n" .
                  "Name: {$member['fname']} {$member['lname']}\n" .
                  "Reg No: {$member['reg_no']}\n" .
                  "District: " . ($member['district_name'] ?? $member['district']) . "\n" .
                  "Assembly: " . ($member['assembly_name'] ?? $member['assembly']);

        $joiningDate = !empty($member['created_at']) ? date('d M Y', strtotime($member['created_at'])) : date('d M Y');
        $dob = !empty($member['dateofbirth']) ? date('Y-m-d', strtotime($member['dateofbirth'])) : 'N/A';

        // Render Template
        ob_start();
        extract([
            'member' => $member,
            'logoPath' => $logoPath,
            'photoPath' => $photoPath,
            'qrData' => $qrData,
            'joiningDate' => $joiningDate,
            'dob' => $dob
        ]);
        require VIEWS_PATH . '/admin/id_card.php';
        $html = ob_get_clean();

        // Generate PDF
        try {
            // Force Landscape and exact dimensions (190.5mm x 100.54mm)
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8', 
                'format' => [190.5, 100.54],
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 0,
                'margin_bottom' => 0,
                'margin_header' => 0,
                'margin_footer' => 0,
            ]);
            
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($html);
            $mpdf->Output("Member_ID_{$member['reg_no']}.pdf", 'D');
        } catch (\Exception $e) {
            die("Error generating ID card: " . $e->getMessage());
        }
    }
    public function contacts() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        
        $contactModel = new \app\models\Contact();
        $districtId = null;
        if (!in_array('super_admin', $_SESSION['roles'])) {
            $userModel = new User();
            $user = $userModel->findByEmail($_SESSION['user_email']);
            $districtId = $user['district_id'] ?? null;
        }

        $inquiries = $contactModel->getInquiries($districtId);

        return $this->view('admin/layout', [
            'pageTitle' => 'Contact Inquiries',
            'contentPath' => VIEWS_PATH . '/admin/contacts.php',
            'inquiries' => $inquiries
        ]);
    }

    public function viewContactDetails() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $id = $_GET['id'] ?? null;
        $contactModel = new \app\models\Contact();
        $inquiry = $contactModel->getById($id);

        if (!$inquiry) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Not found']);
            return;
        }

        // Scoping check
        if (!in_array('super_admin', $_SESSION['roles'])) {
            $userModel = new User();
            $user = $userModel->findByEmail($_SESSION['user_email']);
            if ($user['district_id'] != $inquiry['district_id']) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Access denied']);
                return;
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $inquiry]);
    }

    public function deleteContact() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $id = $_GET['id'] ?? null;
        $contactModel = new \app\models\Contact();
        $inquiry = $contactModel->getById($id);

        if ($inquiry) {
            // Scoping check
            $hasAccess = in_array('super_admin', $_SESSION['roles']);
            if (!$hasAccess) {
                $userModel = new User();
                $user = $userModel->findByEmail($_SESSION['user_email']);
                if ($user['district_id'] == $inquiry['district_id']) {
                    $hasAccess = true;
                }
            }

            if ($hasAccess) {
                $contactModel->delete($id);
            }
        }
        $this->redirect('/admin/contacts');
    }
}
