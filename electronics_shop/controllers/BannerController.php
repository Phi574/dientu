<?php
// controllers/BannerController.php

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'list':
        $query = "SELECT * FROM banners ORDER BY id DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $banners = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/admin/banner_list.php';
        break;

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // --- SỬA LẠI ĐOẠN NÀY ---
            $target_dir = "views/assets/img/"; // 1. Phải khai báo biến trước
            
            // 2. Kiểm tra và tạo thư mục nếu chưa có
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true); 
            }
            // ------------------------

            $image_path = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // Tạo tên file ngẫu nhiên
                $new_filename = "banner_" . uniqid() . '.' . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $new_filename)) {
                    $image_path = $target_dir . $new_filename;
                }
            }

            if ($image_path) {
                $sql = "INSERT INTO banners (image) VALUES (?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$image_path]);
            }
            header("Location: index.php?page=admin_banners");
        } else {
            include 'views/admin/banner_add.php';
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $sqlGet = "SELECT image FROM banners WHERE id = ?";
            $stmtGet = $db->prepare($sqlGet);
            $stmtGet->execute([$id]);
            $banner = $stmtGet->fetch(PDO::FETCH_ASSOC);
            
            if ($banner && file_exists($banner['image'])) {
                unlink($banner['image']); 
            }
            $sql = "DELETE FROM banners WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            
            header("Location: index.php?page=admin_banners");
        }
        break;
}
?>