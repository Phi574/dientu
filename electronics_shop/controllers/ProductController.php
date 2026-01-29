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

    case 'index': 
        // Lấy các tham số từ URL
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $brand = isset($_GET['brand']) ? $_GET['brand'] : '';
        $price_range = isset($_GET['price']) ? $_GET['price'] : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

        // Gọi hàm lọc
        $products = $productModel->filter($keyword, $category, $brand, $price_range, $sort);
        
        // Lấy danh sách hãng để hiện checkbox lọc
        $brands = $productModel->getAllBrands();
        
        include 'views/user/products.php';
        break;

    case 'detail':
        if (isset($_GET['id'])) {
            $productModel->id = $_GET['id'];
            $p = $productModel->getOne(); // Lấy thông tin SP
            $gallery = $productModel->getGallery($_GET['id']); // Lấy ảnh phụ
            
            // Xử lý hiển thị giá và ảnh (cho tiện dùng ở View)
            if($p) {
                // Tính giá giảm
                $p['final_price'] = $p['price'] * (1 - ($p['discount'] / 100));
                $p['img_src'] = (strpos($p['image'], 'http') !== false) ? $p['image'] : BASE_URL . $p['image'];
                
                include 'views/user/product_detail.php';
            } else {
                echo "<div class='container mt-5'><h3>Sản phẩm không tồn tại!</h3> <a href='index.php'>Về trang chủ</a></div>";
            }
        }
        break;

    // 2. THÊM SẢN PHẨM (Xử lý form)
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Nhận dữ liệu text
            $productModel->name = $_POST['name'];
            $productModel->brand = $_POST['brand'];      // Mới
            $productModel->price = $_POST['price'];
            $productModel->category = $_POST['category'];
            $productModel->discount = $_POST['discount']; // Mới
            $productModel->description = $_POST['description'];
            
            // 2. Xử lý Upload nhiều ảnh
            $uploaded_files = []; // Mảng chứa đường dẫn các ảnh đã up thành công
            
            if (isset($_FILES['images'])) {
                $files = $_FILES['images'];
                $count = count($files['name']); // Số lượng ảnh được chọn
                $target_dir = "views/assets/img/";

                // Tạo thư mục nếu chưa có
                if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

                // Duyệt qua từng file để upload
                for ($i = 0; $i < $count; $i++) {
                    if ($files['error'][$i] == 0) {
                        // Tạo tên file ngẫu nhiên tránh trùng
                        $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                        $new_name = uniqid() . "_$i." . $ext;
                        $path = $target_dir . $new_name;

                        if (move_uploaded_file($files['tmp_name'][$i], $path)) {
                            $uploaded_files[] = $path;
                        }
                    }
                }
            }

            // 3. Logic chọn ảnh chính
            if (!empty($uploaded_files)) {
                // Lấy ảnh ĐẦU TIÊN làm ảnh chính (Lưu vào bảng products)
                $productModel->image = $uploaded_files[0];
            } else {
                $productModel->image = "views/assets/img/no-image.jpg"; // Ảnh mặc định nếu không up gì
            }

            // 4. Lưu sản phẩm vào Database
            if ($productModel->create()) {
                // Lấy ID của sản phẩm vừa tạo
                $new_product_id = $productModel->getLastId();

                // 5. Lưu các ảnh còn lại vào bảng gallery (product_images)
                // (Lưu tất cả ảnh vào gallery luôn cũng được, hoặc chỉ lưu từ cái thứ 2)
                // Ở đây tôi lưu TẤT CẢ vào gallery để dễ hiển thị slide chi tiết
                foreach ($uploaded_files as $filepath) {
                    $productModel->addGalleryImage($new_product_id, $filepath);
                }

                echo "<script>alert('Thêm sản phẩm thành công!'); window.location.href='index.php?page=admin_products';</script>";
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
    // --- 4. TRANG SỬA (Hiện form) ---
    case 'edit':
        if (isset($_GET['id'])) {
            $productModel->id = $_GET['id'];
            $product = $productModel->getOne(); // Lấy thông tin SP
            $gallery = $productModel->getGallery($_GET['id']); // Lấy ảnh phụ
            
            if($product) {
                include 'views/admin/product_edit.php';
            } else {
                echo "Không tìm thấy sản phẩm!";
            }
        }
        break;

    // --- 5. XỬ LÝ CẬP NHẬT (Lưu dữ liệu) ---
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productModel->id = $_POST['id'];
            $productModel->name = $_POST['name'];
            $productModel->brand = $_POST['brand'];
            $productModel->price = $_POST['price'];
            $productModel->category = $_POST['category'];
            $productModel->discount = $_POST['discount'];
            $productModel->description = $_POST['description'];

            // 1. Xử lý Ảnh Chính
            $image_path = $_POST['old_image']; // Mặc định lấy ảnh cũ
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // Nếu có up ảnh mới -> Upload và thay thế
                $target_dir = "views/assets/img/";
                $new_filename = uniqid() . "_main." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $new_filename)) {
                    $image_path = $target_dir . $new_filename;
                }
            }
            $productModel->image = $image_path;

            // 2. Thực hiện Update thông tin chính
            if ($productModel->update()) {
                
                // 3. Xử lý Ảnh Phụ (Up thêm)
                if (isset($_FILES['gallery'])) {
                    $files = $_FILES['gallery'];
                    $target_dir = "views/assets/img/";
                    
                    for ($i = 0; $i < count($files['name']); $i++) {
                        if ($files['error'][$i] == 0) {
                            $new_name = uniqid() . "_sub$i." . pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                            if (move_uploaded_file($files['tmp_name'][$i], $target_dir . $new_name)) {
                                // Lưu thẳng vào bảng gallery
                                $productModel->addGalleryImage($productModel->id, $target_dir . $new_name);
                            }
                        }
                    }
                }

                // Xong xuôi -> Về trang danh sách
                echo "<script>alert('Cập nhật thành công!'); window.location.href='index.php?page=admin_products';</script>";
            } else {
                echo "Lỗi cập nhật sản phẩm.";
            }
        }
        break;
}
?>