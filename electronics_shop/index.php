<?php
// index.php
session_start();
define('BASE_URL', 'http://localhost/electronics_shop/');
include_once 'config/database.php';
include_once 'models/Product.php';

// Lấy tham số điều hướng từ URL (ví dụ: index.php?page=admin_products)
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Kết nối CSDL
$database = new Database();
$db = $database->getConnection();

switch ($page) {
    // --- KHU VỰC KHÁCH HÀNG ---
    case 'home':
        include 'controllers/HomeController.php'; // Sẽ tạo ở bước 3
        break;
        
    // --- KHU VỰC ADMIN ---
    case 'admin_products':
        include 'controllers/ProductController.php'; // Sẽ tạo ở bước 2
        break;
        
    default:
        echo "404 - Trang không tồn tại";
        break;
    case 'admin_banners':
    include 'controllers/BannerController.php';
    break;
}
?>