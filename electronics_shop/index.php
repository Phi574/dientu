<?php
session_start();
define('BASE_URL', 'http://localhost/electronics_shop/');

include_once 'config/database.php';
include_once 'models/Product.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Kết nối CSDL
$database = new Database();
$db = $database->getConnection();

// --- BẢO MẬT (GATEKEEPER) ---
// Chặn mọi truy cập vào trang admin_... nếu chưa đăng nhập
if (strpos($page, 'admin_') === 0) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: index.php?page=login");
        exit;
    }
}
// ----------------------------------

switch ($page) {
    // --- KHÁCH HÀNG ---
    case 'home':
        include 'controllers/HomeController.php';
        break;
        
    case 'products': // Trang "Xem tất cả" (Shop)
        include 'controllers/ProductController.php';
        break;
        
    case 'product_detail':
        include 'controllers/ProductController.php';
        break;

    // --- ĐĂNG NHẬP / ĐĂNG XUẤT ---
    case 'login':
    case 'logout':
        include 'controllers/AuthController.php';
        break;

    // --- ADMIN (Đã được bảo vệ ở trên) ---
    case 'admin_products':
        include 'controllers/ProductController.php';
        break;
        
    case 'admin_banners':
        include 'controllers/BannerController.php';
        break;
        
    default:
        echo "<h2 class='text-center mt-5'>404 - Trang không tồn tại</h2>";
        break;
}
?>