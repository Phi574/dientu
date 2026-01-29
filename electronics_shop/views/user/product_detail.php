<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo $p['name']; ?> - Tech Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .main-image-container { border: 1px solid #eee; border-radius: 10px; overflow: hidden; background: #fff; padding: 20px; display: flex; align-items: center; justify-content: center; height: 400px; }
        .main-image { max-height: 100%; max-width: 100%; object-fit: contain; }
        .thumb-img { width: 70px; height: 70px; object-fit: cover; border: 2px solid #eee; border-radius: 8px; cursor: pointer; transition: 0.2s; }
        .thumb-img:hover, .thumb-img.active { border-color: #0d6efd; opacity: 0.8; }
        .price-final { font-size: 2rem; font-weight: bold; color: #dc3545; }
        .price-old { text-decoration: line-through; color: #6c757d; font-size: 1.1rem; }
        .policy-box { background: #fff; border: 1px solid #e0e0e0; border-radius: 8px; padding: 15px; margin-top: 20px; }
        .policy-item { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-size: 0.9rem; }
        .policy-item i { color: #0d6efd; font-size: 1.2rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="index.php"><i class="bi bi-cpu-fill"></i> TECH STORE</a>
        <div class="ms-auto">
            <a href="index.php" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Tiếp tục mua sắm</a>
            <a href="#" class="btn btn-light position-relative text-primary ms-2">
                <i class="bi bi-cart3 fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="row">
        <div class="col-md-5">
            <div class="main-image-container mb-3">
                <img id="mainImage" src="<?php echo $p['img_src']; ?>" class="main-image" alt="Sản phẩm">
            </div>
            <div class="d-flex gap-2 overflow-auto pb-2">
                <img src="<?php echo $p['img_src']; ?>" class="thumb-img active" onclick="changeImage(this)">
                <?php if(!empty($gallery)): ?>
                    <?php foreach ($gallery as $img): ?>
                        <img src="<?php echo BASE_URL . $img['image_path']; ?>" class="thumb-img" onclick="changeImage(this)">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><?php echo isset($p['brand']) ? $p['brand'] : 'Sản phẩm'; ?></li>
                </ol>
            </nav>

            <h1 class="fw-bold mb-3"><?php echo $p['name']; ?></h1>
            
            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="price-final"><?php echo number_format($p['final_price']); ?>đ</span>
                <?php if($p['discount'] > 0): ?>
                    <span class="price-old"><?php echo number_format($p['price']); ?>đ</span>
                    <span class="badge bg-danger">-<?php echo $p['discount']; ?>%</span>
                <?php endif; ?>
            </div>

            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <h6 class="fw-bold"><i class="bi bi-gift-fill text-danger"></i> Khuyến mãi đặc biệt:</h6>
                    <ul class="mb-0 small ps-3">
                        <li>Tặng gói bảo hành vàng 12 tháng.</li>
                        <li>Miễn phí vận chuyển toàn quốc.</li>
                    </ul>
                </div>
            </div>

            <div class="d-flex gap-3 mb-4">
                <button class="btn btn-primary btn-lg flex-grow-1 fw-bold py-3">MUA NGAY</button>
                <button class="btn btn-outline-primary btn-lg p-3"><i class="bi bi-cart-plus-fill fs-4"></i></button>
            </div>

            <div class="row policy-box">
                <div class="col-6 policy-item"><i class="bi bi-shield-check"></i> Bảo hành chính hãng 12 tháng</div>
                <div class="col-6 policy-item"><i class="bi bi-arrow-repeat"></i> 1 đổi 1 trong 30 ngày</div>
            </div>
            
            <div class="mt-4">
                <h5 class="fw-bold border-bottom pb-2">Mô tả sản phẩm</h5>
                <div class="text-muted mt-2" style="white-space: pre-line;">
                    <?php echo $p['description']; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white py-4 mt-5 text-center">
    <div class="container"><p class="mb-0">&copy; 2024 Tech Store.</p></div>
</footer>

<script>
    function changeImage(element) {
        document.getElementById('mainImage').src = element.src;
        document.querySelectorAll('.thumb-img').forEach(img => img.classList.remove('active'));
        element.classList.add('active');
    }
</script>

</body>
</html>