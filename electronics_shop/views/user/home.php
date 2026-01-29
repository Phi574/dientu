<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Store - Thế giới công nghệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* CSS CHUẨN ĐỂ HIỂN THỊ ĐẸP */
        :root { --primary-color: #0d6efd; --secondary-color: #0a58ca; }
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        
        /* Navbar & Header */
        .navbar { background-color: #fff !important; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .navbar-brand { font-weight: 800; color: var(--primary-color) !important; font-size: 26px; text-transform: uppercase; letter-spacing: 1px; }
        .nav-link { color: #555 !important; font-weight: 500; transition: 0.3s; }
        .nav-link:hover { color: var(--primary-color) !important; }
        
        .search-box { background: #f1f3f5; border-radius: 30px; padding: 5px 15px; display: flex; align-items: center; }
        .search-input { border: none; background: transparent; outline: none; width: 250px; margin-left: 10px; }
        
        /* Card sản phẩm */
        .card { border: none; border-radius: 12px; transition: all 0.3s; overflow: hidden; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15); }
        .card-img-top { height: 200px; object-fit: contain; padding: 20px; transition: transform 0.5s; }
        .card:hover .card-img-top { transform: scale(1.08); }
        
        .price-tag { color: #dc3545; font-size: 1.1rem; font-weight: 700; }
        .price-old { color: #999; font-size: 0.9rem; text-decoration: line-through; margin-left: 8px; }
        .brand-tag { font-size: 0.8rem; text-transform: uppercase; color: #6c757d; font-weight: 600; letter-spacing: 0.5px; }
        
        .btn-add-cart { background-color: var(--primary-color); color: white; border-radius: 50px; padding: 8px 0; font-weight: 600; border: none; width: 100%; transition: 0.3s; }
        .btn-add-cart:hover { background-color: var(--secondary-color); }
        
        /* Carousel Banner */
        .carousel-item img { height: 400px; object-fit: cover; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top py-3">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-cpu-fill"></i> TECH STORE
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Điện thoại</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Laptop</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Phụ kiện</a></li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <div class="search-box d-none d-lg-flex">
                    <i class="bi bi-search text-muted"></i>
                    <input type="text" class="search-input" placeholder="Bạn tìm gì hôm nay?">
                </div>
                <a href="index.php?page=admin_products" class="btn btn-outline-primary rounded-circle" title="Quản trị viên">
                    <i class="bi bi-person-fill"></i>
                </a>
                <a href="#" class="btn btn-light rounded-circle position-relative text-primary">
                    <i class="bi bi-cart3 fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">0</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<?php
// Logic lấy banner trực tiếp (đơn giản hóa cho View)
$db_banner = new Database();
$conn_banner = $db_banner->getConnection();
$stmt_b = $conn_banner->prepare("SELECT * FROM banners ORDER BY id DESC");
$stmt_b->execute();
$banner_list = $stmt_b->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="mainCarousel" class="carousel slide shadow-sm" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php if(count($banner_list) > 0): ?>
            <?php foreach($banner_list as $index => $b): ?>
            <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
                <img src="<?php echo BASE_URL . $b['image']; ?>" class="d-block w-100" alt="Banner">
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="carousel-item active">
                <div style="height: 400px; background: linear-gradient(45deg, #0d6efd, #0dcaf0); display: flex; align-items: center; justify-content: center; color: white;">
                    <h1>Chào mừng đến với Tech Store</h1>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h6 class="text-primary fw-bold text-uppercase mb-1">Dành riêng cho bạn</h6>
            <h2 class="fw-bold">Sản Phẩm Nổi Bật</h2>
        </div>
        <a href="#" class="btn btn-outline-primary rounded-pill px-4">Xem tất cả <i class="bi bi-arrow-right"></i></a>
    </div>

    <div class="row g-4">
        <?php foreach ($products as $p): ?>
            <?php 
                // XỬ LÝ LOGIC HIỂN THỊ
                // 1. Tính giá sau giảm
                $original_price = $p['price'];
                $discount = isset($p['discount']) ? $p['discount'] : 0;
                $final_price = $original_price * (1 - ($discount / 100));
                
                // 2. Xử lý ảnh (nếu là link ngoài hoặc file nội bộ)
                $img_src = (strpos($p['image'], 'http') !== false) ? $p['image'] : BASE_URL . $p['image'];
                
                // 3. Xử lý Hãng (nếu chưa có thì để trống)
                $brand = isset($p['brand']) ? $p['brand'] : 'CHÍNH HÃNG';
            ?>
            
        <div class="col-6 col-md-3">
            <div class="card h-100 position-relative">
                <?php if($discount > 0): ?>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-3 shadow-sm">-<?php echo $discount; ?>%</span>
                <?php else: ?>
                    <span class="badge bg-success position-absolute top-0 start-0 m-3 shadow-sm">Mới</span>
                <?php endif; ?>

                <a href="index.php?page=product_detail&action=detail&id=<?php echo $p['id']; ?>">
                    <img src="<?php echo $img_src; ?>" class="card-img-top" alt="<?php echo $p['name']; ?>" onerror="this.src='https://via.placeholder.com/300'">
                </a>
                
                <div class="card-body d-flex flex-column pt-1">
                    <div class="brand-tag mb-1"><?php echo $brand; ?></div>

                    <h5 class="card-title fs-6 fw-bold mb-2" style="height: 40px; overflow: hidden;">
                        <a href="index.php?page=product_detail&action=detail&id=<?php echo $p['id']; ?>" class="text-decoration-none text-dark">
                            <?php echo $p['name']; ?>
                        </a>
                    </h5>

                    <div class="mt-auto">
                        <div class="mb-3 d-flex align-items-center flex-wrap">
                            <span class="price-tag"><?php echo number_format($final_price); ?>đ</span>
                            
                            <?php if($discount > 0): ?>
                                <span class="price-old"><?php echo number_format($original_price); ?>đ</span>
                            <?php endif; ?>
                        </div>

                        <button class="btn-add-cart">
                            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-cpu-fill text-primary"></i> TECH STORE</h5>
                <p class="text-secondary small">Hệ thống bán lẻ điện thoại, máy tính, phụ kiện chính hãng uy tín hàng đầu. Cam kết giá tốt nhất thị trường.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold mb-3">Liên hệ</h6>
                <p class="mb-1 small"><i class="bi bi-geo-alt me-2"></i> 123 Đường Công Nghệ, Hà Nội</p>
                <p class="mb-1 small"><i class="bi bi-telephone me-2"></i> 0912.345.678</p>
                <p class="small"><i class="bi bi-envelope me-2"></i> hotro@techstore.vn</p>
            </div>
            <div class="col-md-4 text-md-end">
                <h6 class="fw-bold mb-3">Kết nối với chúng tôi</h6>
                <div class="d-flex justify-content-md-end gap-2">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <div class="text-center text-secondary small">
            &copy; 2024 Tech Store. All rights reserved. Designed by You.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>