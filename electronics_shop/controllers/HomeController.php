<?php
// Lấy tất cả sản phẩm ra để hiển thị
$productModel = new Product($db);
$stmt = $productModel->read();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
include 'views/user/home.php';
?>