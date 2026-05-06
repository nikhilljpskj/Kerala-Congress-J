<?php

namespace app\controllers;

use app\Core\Controller;
use app\models\User;

class AuthController extends Controller {

    public function adminLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/admin/dashboard');
        }
        return $this->view('admin/login');
    }

    public function adminAuthenticate() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['roles'] = $userModel->getUserRoles($user['id']);
                $_SESSION['permissions'] = $userModel->getUserPermissions($user['id']);

                $this->redirect('/admin/dashboard');
            } else {
                return $this->view('admin/login', ['error' => 'Invalid email or password']);
            }
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        $this->redirect('/admin/login');
    }
}
