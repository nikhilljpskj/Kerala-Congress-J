<?php

namespace app\controllers;

use app\Core\Controller;
use app\models\Content;
use app\models\Gallery;

class ContentController extends Controller {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/admin/login');
        }
    }

    public function index() {
        $contentModel = new Content();
        $type = $_GET['type'] ?? null;
        $category = $_GET['category'] ?? null;
        $search = trim($_GET['q'] ?? '');
        $limit = 10;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        
        $totalItems = $contentModel->countAll($type, $category, $search);
        $totalPages = max(1, (int)ceil($totalItems / $limit));
        if ($page > $totalPages) {
            $page = $totalPages;
            $offset = ($page - 1) * $limit;
        }
        $items = $contentModel->getPaginated($type, $category, $search, $offset, $limit);
        
        return $this->view('admin/layout', [
            'pageTitle' => 'Content Management',
            'contentPath' => VIEWS_PATH . '/admin/content.php',
            'items' => $items,
            'type' => $type,
            'category' => $category,
            'search' => $search,
            'currentPage' => $page,
            'totalItems' => $totalItems,
            'perPage' => $limit
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contentModel = new Content();
            
            $imagePath = $this->handleUpload('image');
            
            $data = [
                'type' => $_POST['type'],
                'category' => $_POST['category'],
                'title' => $_POST['title'],
                'slug' => $this->createSlug($_POST['title']),
                'body' => $_POST['body'],
                'image' => $imagePath,
                'event_date' => !empty($_POST['event_date']) ? $_POST['event_date'] : null,
                'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1
            ];
            
            $contentModel->create($data);
            $this->redirect('/admin/content');
        }
        
        return $this->view('admin/layout', [
            'pageTitle' => 'Create New Content',
            'contentPath' => VIEWS_PATH . '/admin/content_form.php'
        ]);
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $contentModel = new Content();
        $item = $contentModel->getById($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = $this->handleUpload('image') ?: $_POST['existing_image'];
            
            $data = [
                'type' => $_POST['type'],
                'category' => $_POST['category'],
                'title' => $_POST['title'],
                'slug' => $this->createSlug($_POST['title']),
                'body' => $_POST['body'],
                'image' => $imagePath,
                'event_date' => !empty($_POST['event_date']) ? $_POST['event_date'] : null,
                'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1
            ];
            
            $contentModel->update($id, $data);
            $this->redirect('/admin/content');
        }
        
        return $this->view('admin/layout', [
            'pageTitle' => 'Edit Content',
            'contentPath' => VIEWS_PATH . '/admin/content_form.php',
            'item' => $item
        ]);
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        $contentModel = new Content();
        $contentModel->delete($id);
        $this->redirect('/admin/content');
    }

    public function gallery() {
        $galleryModel = new Gallery();
        $category = $_GET['category'] ?? null;
        $search = trim($_GET['q'] ?? '');
        $limit = 12;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $totalItems = $galleryModel->countAll($category, $search);
        $totalPages = max(1, (int)ceil($totalItems / $limit));
        if ($page > $totalPages) {
            $page = $totalPages;
            $offset = ($page - 1) * $limit;
        }
        $items = $galleryModel->getPaginated($category, $search, $offset, $limit);
        
        return $this->view('admin/layout', [
            'pageTitle' => 'Gallery Management',
            'contentPath' => VIEWS_PATH . '/admin/gallery.php',
            'items' => $items,
            'category' => $category,
            'search' => $search,
            'currentPage' => $page,
            'totalItems' => $totalItems,
            'perPage' => $limit
        ]);
    }

    public function addGallery() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $galleryModel = new Gallery();
            $imagePath = $this->handleUpload('image');
            
            if ($imagePath) {
                $data = [
                    'title' => $_POST['title'] ?? '',
                    'image_path' => $imagePath,
                    'category' => $_POST['category'] ?? 'main',
                    'status' => 1
                ];
                $galleryModel->create($data);
            }
            $this->redirect('/admin/gallery');
        }
    }

    public function deleteGallery() {
        $id = $_GET['id'] ?? null;
        $galleryModel = new Gallery();
        $item = $galleryModel->getById($id);

        if ($item) {
            $this->deleteGalleryFile($item['image_path'] ?? '');
            $galleryModel->delete($id);
        }
        $this->redirect('/admin/gallery');
    }

    public function bulkDeleteGallery() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ids = $_POST['selected_ids'] ?? [];
            $galleryModel = new Gallery();
            $items = $galleryModel->getByIds($ids);

            foreach ($items as $item) {
                $this->deleteGalleryFile($item['image_path'] ?? '');
            }

            if (!empty($items)) {
                $galleryModel->deleteMany(array_column($items, 'id'));
            }
        }

        $this->redirect('/admin/gallery');
    }

    public function editGallery() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $galleryModel = new Gallery();
            $item = $galleryModel->getById($id);

            if ($item) {
                $imagePath = $this->handleUpload('image') ?: $_POST['existing_image'];
                
                $data = [
                    'title' => $_POST['title'] ?? '',
                    'image_path' => $imagePath,
                    'category' => $_POST['category'] ?? 'main',
                    'status' => 1
                ];
                $galleryModel->update($id, $data);
            }
            $this->redirect('/admin/gallery');
        }
    }

    private function handleUpload($fieldName) {
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
            $uploadDir = BASE_PATH . '/uploads/cms/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = time() . '_' . basename($_FILES[$fieldName]['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetPath)) {
                return '/uploads/cms/' . $fileName;
            }
        }
        return null;
    }

    private function createSlug($string) {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }

    private function deleteGalleryFile($imagePath) {
        $imagePath = trim((string)$imagePath);
        if ($imagePath === '' || preg_match('#^https?://#i', $imagePath)) {
            return false;
        }

        $relativePath = ltrim(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $imagePath), DIRECTORY_SEPARATOR);
        $fullPath = BASE_PATH . DIRECTORY_SEPARATOR . $relativePath;
        $realFile = realpath($fullPath);
        $realBase = realpath(BASE_PATH);

        if (!$realFile || !$realBase || strpos($realFile, $realBase . DIRECTORY_SEPARATOR) !== 0 || !is_file($realFile)) {
            return false;
        }

        return unlink($realFile);
    }
}
