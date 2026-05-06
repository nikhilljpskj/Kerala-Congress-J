<?php

namespace app\controllers;

use app\Core\Controller;
use config\Database;

class HomeController extends Controller {
    
    public function index() {
        $contentModel = new \app\models\Content();
        $galleryModel = new \app\models\Gallery();
        
        $news = $contentModel->getAll('news', 'main', 1);
        $events = $contentModel->getAll('event', 'main', 1);
        $gallery = $galleryModel->getAll('main', 1);
        
        return $this->view('home/index', [
            'news' => array_slice($news, 0, 4),
            'events' => array_slice($events, 0, 4),
            'gallery' => array_slice($gallery, 0, 8)
        ]);
    }

    public function join() {
        return $this->view('home/join');
    }

    public function contact() {
        $locationModel = new \app\models\Location();
        $districts = $locationModel->getDistricts();
        return $this->view('home/contact', ['districts' => $districts]);
    }

    public function storeContact() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'mobile' => $_POST['mobile'] ?? '',
                'district_id' => $_POST['district_id'] ?? null,
                'message' => $_POST['message'] ?? ''
            ];

            if (empty($data['name']) || empty($data['mobile'])) {
                $locationModel = new \app\models\Location();
                $districts = $locationModel->getDistricts();
                return $this->view('home/contact', [
                    'message' => 'Error: Name and Mobile are required.',
                    'districts' => $districts
                ]);
            }

            $contactModel = new \app\models\Contact();
            if ($contactModel->save($data)) {
                $locationModel = new \app\models\Location();
                $districts = $locationModel->getDistricts();
                return $this->view('home/contact', [
                    'message' => 'Thank you for contacting us. We will get back to you soon.',
                    'districts' => $districts
                ]);
            } else {
                $locationModel = new \app\models\Location();
                $districts = $locationModel->getDistricts();
                return $this->view('home/contact', [
                    'message' => 'Error: Something went wrong. Please try again.',
                    'districts' => $districts
                ]);
            }
        }
        $this->redirect('/contact');
    }

    public function about() {
        return $this->view('home/about');
    }

    public function organizations() {
        return $this->view('home/organizations');
    }

    public function media() {
        $galleryModel = new \app\models\Gallery();
        $gallery = $galleryModel->getAll(null, 1);
        return $this->view('home/media', ['gallery' => $gallery]);
    }

    public function youthfront() {
        $contentModel = new \app\models\Content();
        $galleryModel = new \app\models\Gallery();
        $locationModel = new \app\models\Location();
        
        $news = $contentModel->getAll('news', 'kyf', 1);
        $events = $contentModel->getAll('event', 'kyf', 1);
        $gallery = $galleryModel->getAll('kyf', 1);
        $districts = $locationModel->getDistricts();
        
        return $this->view('kyf/index', [
            'districts' => $districts,
            'news' => array_slice($news, 0, 6),
            'events' => array_slice($events, 0, 6),
            'gallery' => array_slice($gallery, 0, 8)
        ]);
    }

    public function kitproc() {
        $contentModel = new \app\models\Content();
        $news = $contentModel->getAll('news', 'kitproc', 1);
        
        return $this->view('kitproc/index', [
            'news' => array_slice($news, 0, 6)
        ]);
    }

    public function kitprocAbout() {
        return $this->view('kitproc/about');
    }

    public function kitprocNews() {
        $contentModel = new \app\models\Content();
        $news = $contentModel->getAll('news', 'kitproc', 1);
        $updates = $contentModel->getAll('update', 'kitproc', 1);
        
        return $this->view('kitproc/news', [
            'news' => $news,
            'updates' => $updates
        ]);
    }

    public function storeMember() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Include db connection logic. It's better to abstract to a Model later, but for exact compatibility let's do this:
            $db = new Database();
            $pdo = $db->getConnection();

            $fname = $_POST['fname'] ?? '';
            $lname = $_POST['lname'] ?? '';
            $membership = $_POST['membership'] ?? '';
            $aadhaar = empty($_POST['aadhaar']) ? 0 : $_POST['aadhaar'];
            $address = $_POST['address'] ?? '';
            $email = $_POST['email'] ?? '';
            $mobile = $_POST['mobile'] ?? '';
            $dateofbirth = empty($_POST['dateofbirth']) ? null : $_POST['dateofbirth'];
            $fathername = $_POST['fathername'] ?? '';
            $religion = $_POST['religion'] ?? '';
            $caste = $_POST['caste'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $blood = $_POST['blood'] ?? '';
            $blood = $_POST['blood'] ?? '';
            $district_id = empty($_POST['district_id']) ? null : $_POST['district_id'];
            $assembly_id = empty($_POST['assembly_id']) ? null : $_POST['assembly_id'];
            $local_body_id = empty($_POST['local_body_id']) ? null : $_POST['local_body_id'];
            $ward = $_POST['ward'] ?? '';
            $reference = $_POST['reference'] ?? '';
            $president = $_POST['president'] ?? '';
            $secretary = $_POST['secretary'] ?? '';

            // Check if mobile already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM members WHERE mobile = ?");
            $stmt->execute([$mobile]);
            $row = $stmt->fetch();

            if ($row['count'] > 0) {
                return $this->view('home/join', ['message' => 'Error: Mobile number already exists.']);
            }

            // Generate Registration Number
            do {
                $reg_no = rand(10000, 99999);
                $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM members WHERE reg_no = ?");
                $stmt->execute([$reg_no]);
                $row = $stmt->fetch();
            } while ($row['count'] > 0);

            // Handle file upload
            $targetFile = "";
            if(!empty($_FILES['photo']['name'])) {
                $targetDir = BASE_PATH . "/public/uploads/";
                $targetFileDb = "uploads/" . basename($_FILES["photo"]["name"]);
                $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
                
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                
                move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
                $targetFile = $targetFileDb; // path for db
            }

            // Insert
            // Insert
            $status = 0;
            $sql = "INSERT INTO members 
                    (reg_no, fname, lname, membership, aadhaar, address, email, mobile, dateofbirth, fathername, religion, caste, gender, blood, photo, district_id, assembly_id, local_body_id, ward, president, secretary, reference, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            try {
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$reg_no, $fname, $lname, $membership, $aadhaar, $address, $email, $mobile, $dateofbirth, $fathername, $religion, $caste, $gender, $blood, $targetFile, $district_id, $assembly_id, $local_body_id, $ward, $president, $secretary, $reference, $status]);
                
                return $this->view('home/join', ['message' => 'Registration Successful']);
            } catch (\Exception $e) {
                return $this->view('home/join', ['message' => 'Error inserting record: ' . $e->getMessage()]);
            }
        }
        
        $this->redirect('/');
    }
}
