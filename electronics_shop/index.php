<?php
session_start();
define('BASE_URL', 'http://localhost/electronics_shop/');

include_once 'config/database.php';
include_once 'models/Product.php';

include_once 'controllers/CartController.php';
include_once 'controllers/OrderController.php'; 
include_once 'controllers/DashboardController.php';
// --------------------------------------------------------

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Kết nối CSDL
$database = new Database();
$db = $database->getConnection();

// Khởi tạo các Controller mới
$cartController = new CartController($db);
$orderController = new OrderController($db);
$dashboardController = new DashboardController($db);

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
        
    case 'products': // Trang "Xem tất cả"
        include 'controllers/ProductController.php';
        break;
        
    case 'product_detail':
        include 'controllers/ProductController.php';
        break;

    // --- GIỎ HÀNG & THANH TOÁN (USER) ---
    case 'cart':
        $cartController->index();
        break;
    case 'cart_add':
        $cartController->add();
        break;
    case 'cart_delete':
        $cartController->delete();
        break;
    case 'checkout':
        $cartController->checkout();
        break;

    // --- ĐĂNG NHẬP / ĐĂNG XUẤT ---
    case 'login':
    case 'logout': 
        include 'controllers/AuthController.php';
        break;

    // --- ADMIN ---

    case 'admin_dashboard':
        $dashboardController->index();
        break;

    case 'admin_products':
        include 'controllers/ProductController.php';
        break;
        
    case 'admin_orders':
        $orderController->list(); // Gọi hàm hiển thị danh sách đơn
        break;

    case 'admin_order_update':
        $orderController->updateStatus(); // Gọi hàm cập nhật trạng thái
        break;

    case 'admin_banners':
        include 'controllers/BannerController.php';
        break;
        
    case 'admin_order_detail':
        $orderController->detail();
        break;

    case 'admin_order_delete':
        $orderController->delete();
        break;

    // --- CÁC TRANG TĨNH ---
    case 'warranty':
        include 'views/policy/warranty.php';
        break;

    case 'shipping':
        include 'views/policy/shipping.php';
        break;
        
    default:
        echo "<div style='text-align:center; margin-top:50px;'>
                <h2>404 - Trang không tồn tại</h2>
                <a href='index.php'>Quay về trang chủ</a>
              </div>";
        break;
}
?>