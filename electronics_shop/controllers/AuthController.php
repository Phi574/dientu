<?php
// controllers/AuthController.php
include_once 'models/User.php';

$userModel = new User($db);
$action = isset($_GET['action']) ? $_GET['action'] : 'view';

/* ================= ĐĂNG NHẬP ================= */
if ($action === 'submit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // 1. Lấy thông tin user từ DB
    $user = $userModel->getUserByUsername($username);

    $login_success = false;

    // 2. Logic kiểm tra mật khẩu "3 trong 1" (Giống code mẫu sinhdoi)
    if ($user) {
        // Cách 1: Mật khẩu chuẩn (Bcrypt) - Khuyên dùng
        if (password_verify($password, $user['password'])) {
            $login_success = true;
        } 
        // Cách 2: Mật khẩu MD5 (Dành cho web cũ chuyển sang)
        elseif ($user['password'] === md5($password)) {
            $login_success = true;
        }
        // Cách 3: Mật khẩu thường (Không mã hóa - Dùng test cho nhanh)
        elseif ($user['password'] === $password) {
            $login_success = true;
        }
    }

    // 3. Xử lý kết quả
    if ($login_success) {
        // Lưu Session chuẩn của dự án Electronics Shop
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['full_name'] = $user['full_name'];

        // Chuyển hướng vào Dashboard
        header("Location: index.php?page=admin_products");
        exit;
    } else {
        // Đăng nhập thất bại -> Trả về form login kèm báo lỗi
        header("Location: index.php?page=login&error=1");
        exit;
    }
} 

/* ================= ĐĂNG XUẤT ================= */
elseif ($page === 'logout') { // Lưu ý: Logic logout nằm ở index.php điều hướng vào đây
    session_destroy();
    header("Location: index.php?page=login");
    exit;
}

/* ================= HIỆN FORM ================= */
else {
    // Nếu đã đăng nhập rồi thì đá vào admin luôn
    if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
        header("Location: index.php?page=admin_products");
    } else {
        include 'views/auth/login.php';
    }
}
?>