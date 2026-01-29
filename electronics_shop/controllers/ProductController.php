<?php
include_once 'models/Product.php';

$database = new Database();
$db = $database->getConnection();

$productModel = new Product($db);

// Lấy action, nếu không có thì tự động chọn dựa theo tên trang
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == '') {
    // Nếu đang ở trang 'products' -> Mở trang danh sách cho Khách (index)
    if (isset($_GET['page']) && $_GET['page'] == 'products') {
        $action = 'index';
    } 
    // Mặc định còn lại -> Mở trang Quản trị (read)
    else {
        $action = 'read';
    }
}

switch ($action) {
    // --- 1. KHÁCH HÀNG: XEM TẤT CẢ SẢN PHẨM ---
    case 'index': 
        // Lấy tham số bộ lọc
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $brand = isset($_GET['brand']) ? $_GET['brand'] : '';
        $price_range = isset($_GET['price']) ? $_GET['price'] : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

        // Gọi hàm lọc nâng cao
        $products = $productModel->filter($keyword, $category, $brand, $price_range, $sort);
        
        // Lấy danh sách hãng để hiện checkbox lọc
        $brands = $productModel->getAllBrands();
        
        include 'views/user/products.php';
        break;

    // --- 2. KHÁCH HÀNG: XEM CHI TIẾT ---
    case 'detail':
        if (isset($_GET['id'])) {
            $productModel->id = $_GET['id'];
            $p = $productModel->getOne();
            $gallery = $productModel->getGallery($_GET['id']);
            
            if($p) {
                // Tính toán giá hiển thị
                $p['final_price'] = $p['price'] * (1 - ($p['discount'] / 100));
                $p['img_src'] = (strpos($p['image'], 'http') !== false) ? $p['image'] : BASE_URL . $p['image'];
                include 'views/user/product_detail.php';
            } else {
                echo "Sản phẩm không tồn tại.";
            }
        }
        break;

    // --- 3. ADMIN: DANH SÁCH SẢN PHẨM ---
    case 'read':
        $stmt = $productModel->read();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/admin/product_list.php';
        break;

    // --- 4. ADMIN: THÊM MỚI ---
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productModel->name = $_POST['name'];
            $productModel->brand = $_POST['brand'];
            $productModel->category = $_POST['category']; // Nhận loại SP
            $productModel->price = $_POST['price'];
            $productModel->discount = $_POST['discount'];
            $productModel->description = $_POST['description'];
            
            // Upload ảnh chính & gallery (như code cũ của bạn)
            $uploaded_files = [];
            if (isset($_FILES['images'])) {
                $files = $_FILES['images'];
                $target_dir = "views/assets/img/";
                if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

                for ($i = 0; $i < count($files['name']); $i++) {
                    if ($files['error'][$i] == 0) {
                        $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                        $new_name = uniqid() . "_$i." . $ext;
                        if (move_uploaded_file($files['tmp_name'][$i], $target_dir . $new_name)) {
                            $uploaded_files[] = $target_dir . $new_name;
                        }
                    }
                }
            }

            $productModel->image = !empty($uploaded_files) ? $uploaded_files[0] : "views/assets/img/no-image.jpg";

            if ($productModel->create()) {
                $new_id = $productModel->getLastId();
                foreach ($uploaded_files as $path) {
                    $productModel->addGalleryImage($new_id, $path);
                }
                echo "<script>alert('Thêm thành công!'); window.location.href='index.php?page=admin_products';</script>";
            }
        } else {
            include 'views/admin/product_add.php';
        }
        break;

    // --- 5. ADMIN: SỬA ---
    case 'edit':
        if (isset($_GET['id'])) {
            $productModel->id = $_GET['id'];
            $product = $productModel->getOne();
            $gallery = $productModel->getGallery($_GET['id']);
            include 'views/admin/product_edit.php';
        }
        break;

    // --- 6. ADMIN: CẬP NHẬT ---
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productModel->id = $_POST['id'];
            $productModel->name = $_POST['name'];
            $productModel->brand = $_POST['brand'];
            $productModel->category = $_POST['category'];
            $productModel->price = $_POST['price'];
            $productModel->discount = $_POST['discount'];
            $productModel->description = $_POST['description'];
            
            // Xử lý ảnh chính (giữ cũ hoặc thay mới)
            $productModel->image = $_POST['old_image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "views/assets/img/";
                $new_name = uniqid() . "_main." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $new_name)){
                    $productModel->image = $target_dir . $new_name;
                }
            }

            if ($productModel->update()) {
                // Xử lý ảnh phụ up thêm
                if (isset($_FILES['gallery'])) {
                    $files = $_FILES['gallery'];
                    $target_dir = "views/assets/img/";
                    for ($i = 0; $i < count($files['name']); $i++) {
                        if ($files['error'][$i] == 0) {
                            $new_name = uniqid() . "_sub$i." . pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                            if (move_uploaded_file($files['tmp_name'][$i], $target_dir . $new_name)) {
                                $productModel->addGalleryImage($productModel->id, $target_dir . $new_name);
                            }
                        }
                    }
                }
                echo "<script>alert('Cập nhật thành công!'); window.location.href='index.php?page=admin_products';</script>";
            }
        }
        break;

    // --- 7. ADMIN: XÓA ---
    case 'delete':
        if (isset($_GET['id'])) {
            $productModel->id = $_GET['id'];
            if ($productModel->delete()) {
                header("Location: index.php?page=admin_products");
            }
        }
        break;
}
?>