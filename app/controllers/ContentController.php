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
            $mediaType = $_POST['media_type'] ?? 'image';
            $imagePath = '';
            $videoUrl = null;

            if ($mediaType === 'video') {
                $videoUrl = $this->normalizeVideoUrl($_POST['video_url'] ?? '');
                if (!$videoUrl) {
                    $this->redirect('/admin/gallery');
                }
                $imagePath = $this->getVideoThumbnail($videoUrl);
            } else {
                $mediaType = 'image';
                $imagePath = $this->handleUpload('image');
            }
            
            if ($imagePath) {
                $data = [
                    'title' => $_POST['title'] ?? '',
                    'image_path' => $imagePath,
                    'video_url' => $videoUrl,
                    'media_type' => $mediaType,
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
                $mediaType = $_POST['media_type'] ?? ($item['media_type'] ?? 'image');
                $imagePath = $_POST['existing_image'] ?? ($item['image_path'] ?? '');
                $videoUrl = null;

                if ($mediaType === 'video') {
                    $videoUrl = $this->normalizeVideoUrl($_POST['video_url'] ?? ($item['video_url'] ?? ''));
                    if (!$videoUrl) {
                        $this->redirect('/admin/gallery');
                    }
                    if (($item['media_type'] ?? 'image') === 'image') {
                        $this->deleteGalleryFile($item['image_path'] ?? '');
                    }
                    $imagePath = $this->getVideoThumbnail($videoUrl);
                } else {
                    $mediaType = 'image';
                    $uploadedImage = $this->handleUpload('image');
                    if ($uploadedImage) {
                        $this->deleteGalleryFile($item['image_path'] ?? '');
                        $imagePath = $uploadedImage;
                    }
                }
                
                $data = [
                    'title' => $_POST['title'] ?? '',
                    'image_path' => $imagePath,
                    'video_url' => $videoUrl,
                    'media_type' => $mediaType,
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

    private function normalizeVideoUrl($url) {
        $url = trim((string)$url);
        if ($url === '') {
            return null;
        }

        $parts = parse_url($url);
        if (!$parts || empty($parts['host'])) {
            return null;
        }

        $host = strtolower($parts['host']);
        $path = $parts['path'] ?? '';
        $videoId = null;
        $query = [];
        if (!empty($parts['query'])) {
            parse_str($parts['query'], $query);
        }

        if (strpos($host, 'youtu.be') !== false) {
            $videoId = trim($path, '/');
        } elseif (strpos($host, 'youtube.com') !== false || strpos($host, 'youtube-nocookie.com') !== false) {
            if (strpos($path, '/embed/') === 0) {
                $videoId = basename($path);
            } elseif (!empty($query['v'])) {
                $videoId = $query['v'];
            } elseif (strpos($path, '/shorts/') === 0) {
                $videoId = basename($path);
            }
        }

        if (!$videoId || !preg_match('/^[A-Za-z0-9_-]{6,}$/', $videoId)) {
            return null;
        }

        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
        if (!empty($query['si'])) {
            $embedUrl .= '?si=' . rawurlencode($query['si']);
        }

        return $embedUrl;
    }

    private function getVideoThumbnail($videoUrl) {
        $parts = parse_url($videoUrl);
        $path = $parts['path'] ?? '';
        $videoId = basename($path);

        return 'https://img.youtube.com/vi/' . $videoId . '/maxresdefault.jpg';
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
