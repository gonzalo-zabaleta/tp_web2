<?php
class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            if ($username === 'webadmin' && $password === 'admin') {
                $_SESSION['user'] = $username;
                header('Location: ' . BASE_URL . '/admin');
            } else {
                $error = "Invalid username or password";
                require '../views/auth/login.phtml';
            }
        } else {
            require '../views/auth/login.phtml';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}