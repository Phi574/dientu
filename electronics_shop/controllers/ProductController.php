<?php
// controllers/ProductController.php

$productModel = new Product($db);
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    // 1. HIỂN THỊ DANH SÁCH
    case 'list':
        $stmt = $productModel->read();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/admin/product_list.php';
        break;

    // 2. THÊM SẢN PHẨM (Xử lý form)
    case 'create':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productModel->name = $_POST['name'];
        $productModel->price = $_POST['price'];
        $productModel->description = $_POST['description'];
        
        // --- XỬ LÝ UPLOAD ẢNH ---
        $productModel->image = "views/assets/img/default.png"; // Ảnh mặc định nếu không up
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "views/assets/img/";
            // Tạo tên file ngẫu nhiên để không bị trùng
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $new_filename = uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $productModel->image = $target_file; // Lưu đường dẫn vào DB
            }
        }
        // ------------------------

        if ($productModel->create()) {
            header("Location: index.php?page=admin_products");
        } else {
            echo "Lỗi thêm sản phẩm.";
        }
    } else {
        include 'views/admin/product_add.php';
    }
    break;

    // 3. XÓA SẢN PHẨM
    case 'delete':
        if (isset($_GET['id'])) {
            $productModel->id = $_GET['id'];
            // Bạn cần thêm hàm delete() vào Model Product nhé
            if ($productModel->delete()) { 
                 header("Location: index.php?page=admin_products");
            }
        }
        break;
}
?>