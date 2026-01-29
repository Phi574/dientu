<?php
// controllers/AuthController.php
include_once 'models/User.php';

$userModel = new User($db);

// --- SỬA LỖI LOGIC Ở ĐÂY ---
// Mặc định action là login
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Nếu đường dẫn là ?page=logout -> Bắt buộc action phải là logout
if (isset($_GET['page']) && $_GET['page'] === 'logout') {
    $action = 'logout';
}
// ---------------------------

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if ($userModel->login($username, $password)) {
                // Đăng nhập thành công -> Lưu session
                $_SESSION['user_id'] = $userModel->id;
                $_SESSION['username'] = $userModel->username;
                $_SESSION['role'] = $userModel->role;
                $_SESSION['full_name'] = $userModel->full_name;

                header("Location: index.php?page=admin_products");
                exit;
            } else {
                $error_msg = "Tài khoản hoặc mật khẩu không đúng!";
                include 'views/auth/login.php';
            }
        } else {
            // Nếu đã đăng nhập rồi thì đá vào Admin luôn
            if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
                header("Location: index.php?page=admin_products");
                exit;
            }
            include 'views/auth/login.php';
        }
        break;

    case 'logout':
        // 1. Xóa sạch các biến session
        $_SESSION = array();

        // 2. Xóa cookie session của trình duyệt (Quan trọng để không nhớ phiên cũ)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // 3. Hủy session trên server
        session_destroy();
        
        // 4. Chuyển hướng dứt khoát về trang Login
        header("Location: index.php?page=login");
        exit;
        break;
}
?>