<?php

require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/SuperAdmin.php';

class UserController {
    private $adminModel;
    private $superAdminModel;

    public function __construct() {
        $this->adminModel = new Admin();
        $this->superAdminModel = new SuperAdmin();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérifier si l'utilisateur est un admin ou un super admin
            $admin = $this->adminModel->getAdminByEmail($email);
            $superAdmin = $this->superAdminModel->getSuperAdminByEmail($email);

            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['user'] = $admin;
                $_SESSION['role'] = 'admin';
                header('Location: /dashboard');
            } elseif ($superAdmin && password_verify($password, $superAdmin['password'])) {
                $_SESSION['user'] = $superAdmin;
                $_SESSION['role'] = 'super_admin';
                header('Location: /dashboard');
            } else {
                echo 'Invalid credentials';
            }
        } else {
            include __DIR__ . '/../views/users/login.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            $role = $_POST['role'];

            if ($role === 'admin') {
                $this->adminModel->createAdmin($data);
            } elseif ($role === 'super_admin') {
                $this->superAdminModel->createSuperAdmin($data);
            }
            header('Location: /login');
        } else {
            include __DIR__ . '/../views/users/register.php';
        }
    }

    public function dashboard() {
        if (isset($_SESSION['user'])) {
            include __DIR__ . '/../views/users/dashboard.php';
        } else {
            header('Location: /login');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
    }
}
