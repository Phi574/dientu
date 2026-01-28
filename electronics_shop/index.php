<?php
// index.php
session_start();
define('BASE_URL', 'http://localhost/electronics_shop/');

include_once 'config/database.php';
include_once 'models/Product.php';

// Lấy tham số điều hướng
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Kết nối CSDL
$database = new Database();
$db = $database->getConnection();

// --- LOGIC BẢO MẬT (GATEKEEPER) ---
// Nếu trang bắt đầu bằng chữ "admin_" VÀ người dùng CHƯA đăng nhập
if (strpos($page, 'admin_') === 0) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        // Đá về trang login ngay lập tức
        header("Location: index.php?page=login");
        exit;
    }
}
// ----------------------------------

switch ($page) {
    // --- KHU VỰC KHÁCH HÀNG ---
    case 'home':
        include 'controllers/HomeController.php';
        break;
        
    // --- KHU VỰC AUTH (Đăng nhập/Đăng xuất) ---
    case 'login':
    case 'logout':
        include 'controllers/AuthController.php';
        break;

    // --- KHU VỰC ADMIN (Đã được bảo vệ ở trên) ---
    case 'admin_products':
        include 'controllers/ProductController.php';
        break;
        
    case 'admin_banners':
        include 'controllers/BannerController.php';
        break;
        
    default:
        echo "404 - Trang không tồn tại";
        break;
}
?>