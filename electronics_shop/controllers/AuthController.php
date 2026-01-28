<?php
include_once 'models/User.php';

$userModel = new User($db);
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($userModel->login($username, $password)) {
                // Đăng nhập thành công -> Lưu Session
                $_SESSION['user_id'] = $userModel->id;
                $_SESSION['username'] = $userModel->username;
                $_SESSION['role'] = $userModel->role;
                $_SESSION['full_name'] = $userModel->full_name;

                // Chuyển hướng vào trang Admin
                header("Location: index.php?page=admin_products");
                exit;
            } else {
                $error_msg = "Sai tài khoản hoặc mật khẩu!";
                include 'views/auth/login.php';
            }
        } else {
            // Nếu đã đăng nhập rồi thì vào thẳng admin
            if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
                header("Location: index.php?page=admin_products");
            } else {
                include 'views/auth/login.php';
            }
        }
        break;

    case 'logout':
        session_destroy(); // Xóa sạch session
        header("Location: index.php?page=login");
        break;
}
?>