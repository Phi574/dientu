<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Store - Thế giới công nghệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* GIAO DIỆN MÀU XANH HIỆN ĐẠI */
        :root { --primary-color: #0d6efd; --secondary-color: #0a58ca; }
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        
        .navbar { background-color: #fff !important; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .navbar-brand { font-weight: 800; color: var(--primary-color) !important; font-size: 26px; text-transform: uppercase; letter-spacing: 1px; }
        .nav-link { color: #555 !important; font-weight: 500; transition: 0.3s; }
        .nav-link:hover { color: var(--primary-color) !important; }
        
        /* Tìm kiếm bo tròn */
        .search-box { background: #f1f3f5; border-radius: 30px; padding: 5px 15px; display: flex; align-items: center; }
        .search-input { border: none; background: transparent; outline: none; width: 250px; margin-left: 10px; }
        
        /* Card sản phẩm */
        .card { border: none; border-radius: 12px; transition: all 0.3s; overflow: hidden; background: #fff; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15); }
        .card-img-top { height: 200px; object-fit: contain; padding: 15px; transition: transform 0.5s; }
        .card:hover .card-img-top { transform: scale(1.05); }
        
        .price-tag { color: var(--primary-color); font-size: 1.2rem; font-weight: bold; }
        .btn-add-cart { background-color: var(--primary-color); color: white; border-radius: 50px; padding: 8px 20px; font-weight: 600; border: none; width: 100%; transition: 0.3s; }
        .btn-add-cart:hover { background-color: var(--secondary-color); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top py-3">
    <div class="container">
        <a class="navbar-brand" href="#">
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
                <a href="index.php?page=admin_products" class="btn btn-outline-primary rounded-circle" title="Admin"><i class="bi bi-person-fill"></i></a>
                <a href="#" class="btn btn-light rounded-circle position-relative text-primary">
                    <i class="bi bi-cart3 fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">2</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<?php
// Đoạn này lấy banner từ DB ngay tại View (hoặc truyền từ Controller sang thì tốt hơn)
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
                <img src="<?php echo BASE_URL . $b['image']; ?>" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Banner">
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
        <a href="#" class="btn btn-outline-primary rounded-pill px-4">Xem tất cả</a>
    </div>

    <div class="row g-4">
        <?php foreach ($products as $p): ?>
        <div class="col-6 col-md-3">
            <div class="card h-100">
                <img src="<?php echo (strpos($p['image'], 'http') !== false) ? $p['image'] : BASE_URL . $p['image']; ?>" 
                     class="card-img-top" alt="<?php echo $p['name']; ?>">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-6 mb-3" style="height: 40px; overflow: hidden;"><?php echo $p['name']; ?></h5>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="price-tag"><?php echo number_format($p['price']); ?>đ</span>
                            <span class="badge bg-light text-secondary border">Mới</span>
                        </div>
                        <button class="btn-add-cart">
                            <i class="bi bi-bag-plus me-1"></i> Chọn mua
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 Tech Store. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>