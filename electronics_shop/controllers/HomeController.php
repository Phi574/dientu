<?php
// controllers/HomeController.php
$productModel = new Product($db);

// Kiểm tra xem người dùng có chọn danh mục không
if (isset($_GET['category']) && !empty($_GET['category'])) {
    // Nếu có, lọc theo danh mục
    $products = $productModel->getByCategory($_GET['category']);
} else {
    // Nếu không, lấy tất cả
    $stmt = $productModel->read();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

include 'views/user/home.php';
?>