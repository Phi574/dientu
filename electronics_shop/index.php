<?php
// index.php
session_start();

// Đổi đường dẫn này nếu thư mục của bạn khác tên
define('BASE_URL', 'http://localhost/electronics_shop/');

include_once 'config/database.php';
include_once 'models/Product.php';
// Lưu ý: Không cần include Model User ở đây vì AuthController sẽ tự gọi

// Lấy tham số điều hướng từ URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Kết nối CSDL
$database = new Database();
$db = $database->getConnection();

// --- LOGIC BẢO MẬT (GATEKEEPER) ---
// Nếu vào trang Admin (có chữ 'admin_') mà CHƯA đăng nhập -> Đá về trang Login
if (strpos($page, 'admin_') === 0) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
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

    case 'product_detail':
        include 'controllers/ProductController.php';
        break;
        
    // --- KHU VỰC AUTH (Quan trọng: Đã thêm lại phần này) ---
    case 'login':
    case 'logout':
        include 'controllers/AuthController.php';
        break;

    // --- KHU VỰC ADMIN ---
    case 'admin_products':
        include 'controllers/ProductController.php';
        break;
        
    case 'admin_banners':
        include 'controllers/BannerController.php';
        break;
        
    default:
        // Nếu không tìm thấy trang thì về trang chủ hoặc báo lỗi
        echo "<h2 style='text-align:center; margin-top:50px;'>404 - Trang không tồn tại</h2>";
        echo "<p style='text-align:center;'><a href='index.php'>Về trang chủ</a></p>";
        break;
}
?>