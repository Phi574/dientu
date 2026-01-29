<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Store - Hệ thống bán lẻ công nghệ số 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root { --primary-color: #0d6efd; --secondary-color: #0a58ca; --accent-color: #ffc107; }
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        
        /* Navbar Custom */
        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .search-box { background: #f3f4f6; border-radius: 20px; padding: 5px 15px; width: 400px; display: flex; align-items: center; }
        .search-input { border: none; background: transparent; outline: none; width: 100%; margin-left: 10px; }
        
        /* Slider & Banner Area */
        .hero-section { margin-top: 20px; }
        .carousel-item img { height: 380px; object-fit: cover; border-radius: 8px; }
        .right-banner img { height: 185px; width: 100%; object-fit: cover; border-radius: 8px; transition: transform 0.3s; }
        .right-banner img:hover { transform: scale(1.02); }
        
        /* Policy Bar */
        .policy-section { background: #fff; padding: 20px; border-radius: 8px; margin-top: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .policy-item { display: flex; align-items: center; gap: 10px; font-size: 0.9rem; font-weight: 500; }
        .policy-icon { font-size: 24px; color: var(--primary-color); }

        /* Category Circle */
        .cat-item { text-align: center; cursor: pointer; transition: 0.3s; }
        .cat-item:hover { transform: translateY(-5px); }
        .cat-icon { width: 60px; height: 60px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); color: var(--primary-color); }
        .cat-item:hover .cat-icon { background: var(--primary-color); color: #fff; }

        /* Product Card */
        .section-title { font-weight: 800; text-transform: uppercase; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .card-product { border: none; border-radius: 12px; background: #fff; transition: all 0.3s; position: relative; overflow: hidden; height: 100%; }
        .card-product:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img-wrapper { height: 200px; padding: 20px; display: flex; align-items: center; justify-content: center; position: relative; }
        .card-img-top { max-height: 100%; object-fit: contain; transition: 0.5s; }
        .card-product:hover .card-img-top { transform: scale(1.1); }
        
        .discount-badge { position: absolute; top: 10px; left: 10px; background: #dc3545; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; z-index: 10; }
        .installment-badge { position: absolute; bottom: 10px; left: 10px; background: #f8f9fa; color: #333; padding: 2px 6px; border-radius: 4px; font-size: 11px; border: 1px solid #ddd; }
        
        .card-body { padding: 15px; }
        .product-name { font-size: 15px; font-weight: 600; color: #333; margin-bottom: 5px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 42px; text-decoration: none; }
        .product-name:hover { color: var(--primary-color); }
        
        .price-row { display: flex; align-items: baseline; gap: 8px; margin-bottom: 5px; }
        .current-price { color: #d70018; font-weight: 700; font-size: 18px; }
        .old-price { color: #707070; text-decoration: line-through; font-size: 14px; }
        
        .rating-row { font-size: 12px; color: #ffc107; margin-bottom: 10px; display: flex; align-items: center; }
        .sold-count { color: #777; margin-left: 5px; font-size: 12px; }
        
        .btn-hover-cart { width: 100%; background: #fff; border: 1px solid var(--primary-color); color: var(--primary-color); font-weight: 600; border-radius: 5px; padding: 8px; transition: 0.3s; opacity: 0; transform: translateY(20px); }
        .card-product:hover .btn-hover-cart { opacity: 1; transform: translateY(0); background: var(--primary-color); color: #fff; }

        footer { background: #212529; color: #bbb; padding-top: 50px; }
        footer a { color: #bbb; text-decoration: none; transition: 0.3s; }
        footer a:hover { color: #fff; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <i class="bi bi-cpu-fill text-primary fs-2"></i> 
            <div>
                <span class="d-block lh-1 fw-bold text-primary">TECH</span>
                <span class="d-block lh-1 fs-6 text-dark">STORE</span>
            </div>
        </a>

        <div class="search-box d-none d-lg-flex">
    <form action="index.php" method="GET" class="d-flex align-items-center w-100">
        <input type="hidden" name="page" value="products"> <button type="submit" class="btn border-0 p-0 text-muted ps-3">
            <i class="bi bi-search"></i>
        </button>
        <input type="text" name="keyword" class="search-input form-control shadow-none border-0 bg-transparent" 
               placeholder="Bạn cần tìm gì? iPhone 15..." 
               value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
    </form>
</div>

<div class="d-flex align-items-center gap-3">
    <a href="index.php?page=products" class="btn btn-sm btn-outline-dark fw-bold rounded-pill">
        <i class="bi bi-grid"></i> Tất cả SP
    </a>
</div>

        <div class="d-flex align-items-center gap-4">
            <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                <i class="bi bi-telephone-fill fs-5"></i>
                <div class="d-none d-xl-block">
                    <small class="d-block text-muted" style="font-size: 11px;">Hotline</small>
                    <span class="fw-bold" style="font-size: 14px;">1900.6789</span>
                </div>
            </a>
            
            <a href="index.php?page=cart" class="btn btn-light rounded-circle position-relative text-primary">
                <i class="bi bi-bag-fill fs-4"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">0</span>
            </a>
        </div>
    </div>
</nav>

<div class="container hero-section">
    <div class="row g-3">
        <div class="col-lg-8">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $db_banner = new Database();
                    $conn_banner = $db_banner->getConnection();
                    $stmt_b = $conn_banner->prepare("SELECT * FROM banners ORDER BY id DESC LIMIT 5");
                    $stmt_b->execute();
                    $banner_list = $stmt_b->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php if(count($banner_list) > 0): ?>
                        <?php foreach($banner_list as $index => $b): ?>
                        <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
                            <img src="<?php echo BASE_URL . $b['image']; ?>" class="d-block w-100" alt="Banner">
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="carousel-item active"><img src="https://via.placeholder.com/800x380/0d6efd/ffffff?text=TechStore" class="d-block w-100"></div>
                    <?php endif; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
            </div>
        </div>
        <div class="col-lg-4 d-none d-lg-flex flex-column gap-3">
            <div class="right-banner"><img src="https://cdn.tgdd.vn/Products/Images/44/358086/Slider/vi-vn-macbook-pro-14-inch-m5-16gb-512gb-1.jpg" alt="Promo"></div>
            <div class="right-banner"><img src="https://cdn.tgdd.vn/Products/Images/44/358086/Slider/vi-vn-macbook-pro-14-inch-m5-16gb-512gb-6.jpg" alt="Promo"></div>
        </div>
    </div>

    <div class="policy-section">
        <div class="row text-center text-md-start">
            <div class="col-6 col-md-3 mb-3 mb-md-0 policy-item justify-content-center justify-content-md-start">
                <i class="bi bi-patch-check-fill policy-icon"></i><div>100% Chính hãng<br><span class="text-muted fw-normal" style="font-size: 12px;">Cam kết chất lượng</span></div>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0 policy-item justify-content-center justify-content-md-start">
                <i class="bi bi-truck policy-icon"></i><div>Miễn phí vận chuyển<br><span class="text-muted fw-normal" style="font-size: 12px;">Đơn hàng > 500k</span></div>
            </div>
            <div class="col-6 col-md-3 policy-item justify-content-center justify-content-md-start">
                <i class="bi bi-arrow-repeat policy-icon"></i><div>30 Ngày đổi trả<br><span class="text-muted fw-normal" style="font-size: 12px;">Lỗi NSX</span></div>
            </div>
            <div class="col-6 col-md-3 policy-item justify-content-center justify-content-md-start">
                <i class="bi bi-headset policy-icon"></i><div>Hỗ trợ 24/7<br><span class="text-muted fw-normal" style="font-size: 12px;">1900.6789</span></div>
            </div>
        </div>
    </div>

    <div class="my-5">
        <h5 class="fw-bold mb-4">DANH MỤC NỔI BẬT</h5>
        <?php $cat = isset($_GET['category']) ? $_GET['category'] : ''; ?>
        <div class="d-flex gap-4 overflow-auto pb-3 text-nowrap">
            <a href="index.php?page=home&category=phone" class="text-decoration-none text-dark">
                <div class="cat-item"><div class="cat-icon <?php echo ($cat == 'phone') ? 'bg-primary text-white shadow' : ''; ?>"><i class="bi bi-phone"></i></div><small class="fw-bold <?php echo ($cat == 'phone') ? 'text-primary' : ''; ?>">Điện thoại</small></div>
            </a>
            <a href="index.php?page=home&category=laptop" class="text-decoration-none text-dark">
                <div class="cat-item"><div class="cat-icon <?php echo ($cat == 'laptop') ? 'bg-primary text-white shadow' : ''; ?>"><i class="bi bi-laptop"></i></div><small class="fw-bold <?php echo ($cat == 'laptop') ? 'text-primary' : ''; ?>">Laptop</small></div>
            </a>
            <a href="index.php?page=home&category=tablet" class="text-decoration-none text-dark">
                <div class="cat-item"><div class="cat-icon <?php echo ($cat == 'tablet') ? 'bg-primary text-white shadow' : ''; ?>"><i class="bi bi-tablet"></i></div><small class="fw-bold <?php echo ($cat == 'tablet') ? 'text-primary' : ''; ?>">Tablet</small></div>
            </a>
            <a href="index.php?page=home&category=audio" class="text-decoration-none text-dark">
                <div class="cat-item"><div class="cat-icon <?php echo ($cat == 'audio') ? 'bg-primary text-white shadow' : ''; ?>"><i class="bi bi-earbuds"></i></div><small class="fw-bold <?php echo ($cat == 'audio') ? 'text-primary' : ''; ?>">Tai nghe</small></div>
            </a>
            <a href="index.php?page=home&category=watch" class="text-decoration-none text-dark">
                <div class="cat-item"><div class="cat-icon <?php echo ($cat == 'watch') ? 'bg-primary text-white shadow' : ''; ?>"><i class="bi bi-smartwatch"></i></div><small class="fw-bold <?php echo ($cat == 'watch') ? 'text-primary' : ''; ?>">Đồng hồ</small></div>
            </a>
            <a href="index.php?page=home&category=pc" class="text-decoration-none text-dark">
                <div class="cat-item"><div class="cat-icon <?php echo ($cat == 'pc') ? 'bg-primary text-white shadow' : ''; ?>"><i class="bi bi-pc-display"></i></div><small class="fw-bold <?php echo ($cat == 'pc') ? 'text-primary' : ''; ?>">PC & Màn</small></div>
            </a>
            <a href="index.php?page=home&category=accessory" class="text-decoration-none text-dark">
                <div class="cat-item"><div class="cat-icon <?php echo ($cat == 'accessory') ? 'bg-primary text-white shadow' : ''; ?>"><i class="bi bi-mouse"></i></div><small class="fw-bold <?php echo ($cat == 'accessory') ? 'text-primary' : ''; ?>">Phụ kiện</small></div>
            </a>
            <a href="index.php?page=home" class="text-decoration-none text-dark">
                <div class="cat-item"><div class="cat-icon <?php echo ($cat == '') ? 'bg-primary text-white shadow' : ''; ?>"><i class="bi bi-grid-fill"></i></div><small class="fw-bold <?php echo ($cat == '') ? 'text-primary' : ''; ?>">Tất cả</small></div>
            </a>
        </div>
    </div>

    <div class="mb-5 rounded overflow-hidden">
        <img src="//cdnv2.tgdd.vn/mwg-static/tgdd/Banner/c4/0f/c40fbe43287853a4bf2dc845557a5cef.png" class="w-100 object-fit-cover">
    </div>

    <div class="section-title">
        <span><i class="bi bi-fire text-danger"></i> GỢI Ý CHO BẠN</span>
        <a href="index.php?page=products" class="btn btn-outline-primary btn-sm rounded-pill px-3">Xem tất cả <i class="bi bi-chevron-right"></i></a>
    </div>

    <div class="row g-3 mb-5">
        <?php foreach ($products as $p): ?>
            <?php 
                $original_price = $p['price'];
                $discount = isset($p['discount']) ? $p['discount'] : 0;
                $final_price = $original_price * (1 - ($discount / 100));
                $img_src = (strpos($p['image'], 'http') !== false) ? $p['image'] : BASE_URL . $p['image'];
                $rating = rand(4, 5); $sold = rand(10, 999);
            ?>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2-4">
            <div class="card-product h-100">
                <div class="card-img-wrapper">
                    <?php if($discount > 0): ?>
                        <div class="discount-badge" style="z-index: 10;">-<?php echo $discount; ?>%</div>
                    <?php endif; ?>
                    <a href="index.php?page=product_detail&action=detail&id=<?php echo $p['id']; ?>">
                        <img src="<?php echo $img_src; ?>" class="card-img-top" alt="<?php echo $p['name']; ?>" onerror="this.src='https://via.placeholder.com/300'">
                    </a>
                    <div class="installment-badge">Trả góp 0%</div>
                </div>

                <div class="card-body d-flex flex-column">
                    <a href="index.php?page=product_detail&action=detail&id=<?php echo $p['id']; ?>" class="product-name" title="<?php echo $p['name']; ?>">
                        <?php echo $p['name']; ?>
                    </a>
                    <div class="price-row mt-2">
                        <span class="current-price"><?php echo number_format($final_price, 0, ',', '.'); ?>đ</span>
                        <?php if($discount > 0): ?>
                            <span class="old-price"><?php echo number_format($original_price, 0, ',', '.'); ?>đ</span>
                        <?php endif; ?>
                    </div>
                    <div class="rating-row mt-auto">
                        <?php for($i=0; $i<5; $i++) { echo ($i < $rating) ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>'; } ?>
                        <span class="sold-count">(<?php echo $sold; ?> đã bán)</span>
                    </div>
                    <a href="index.php?page=cart_add&id=<?php echo $p['id']; ?>" class="btn-add-cart text-decoration-none text-center d-block">
                            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ
                        </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer>
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-3 mb-4">
                <h5 class="text-white fw-bold mb-3">TECH STORE</h5>
                <p class="small">Hệ thống bán lẻ điện thoại, máy tính, phụ kiện chính hãng uy tín hàng đầu Việt Nam.</p>
                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <h6 class="text-white fw-bold mb-3">Thông tin hỗ trợ</h6>
                <ul class="list-unstyled small d-flex flex-column gap-2">
                    <li><a href="#">Chính sách bảo hành</a></li>
                    <li><a href="#">Giao hàng & Thanh toán</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h6 class="text-white fw-bold mb-3">Tổng đài hỗ trợ</h6>
                <ul class="list-unstyled small d-flex flex-column gap-2">
                    <li>Mua hàng: <span class="text-white fw-bold">1900.6789</span></li>
                    <li>Bảo hành: <span class="text-white fw-bold">1900.6791</span></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h6 class="text-white fw-bold mb-3">Thanh toán miễn phí</h6>
                <div class="d-flex gap-2 flex-wrap">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" class="rounded bg-white p-1" style="width: 50px; height: 30px; object-fit: contain;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b7/MasterCard_Logo.svg" class="rounded bg-white p-1" style="width: 50px; height: 30px; object-fit: contain;">
                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-MoMo-Square.png" class="rounded" style="width: 50px; height: 30px; object-fit: cover;">
                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-ZaloPay-Square.png" class="rounded" style="width: 50px; height: 30px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <div class="bg-black py-3 text-center small">&copy; 2024 Tech Store. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>