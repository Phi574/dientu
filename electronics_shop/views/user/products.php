<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tất cả sản phẩm - Tech Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .filter-sidebar { background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .filter-title { font-weight: 700; margin-bottom: 15px; font-size: 1rem; color: #333; display: flex; justify-content: space-between; }
        
        /* Card sản phẩm (Giống trang chủ) */
        .card-product { border: none; border-radius: 12px; background: #fff; transition: all 0.3s; position: relative; overflow: hidden; height: 100%; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .card-product:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img-wrapper { height: 200px; padding: 20px; display: flex; align-items: center; justify-content: center; position: relative; }
        .card-img-top { max-height: 100%; object-fit: contain; }
        .discount-badge { position: absolute; top: 10px; left: 10px; background: #dc3545; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; z-index: 10; }
        .product-name { font-size: 14px; font-weight: 600; color: #333; text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 40px; margin-bottom: 5px; }
        .current-price { color: #d70018; font-weight: 700; font-size: 16px; }
        .old-price { color: #999; text-decoration: line-through; font-size: 13px; margin-left: 5px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="index.php"><i class="bi bi-cpu-fill"></i> TECH STORE</a>
        <div class="d-flex ms-auto gap-3">
             <a href="index.php" class="btn btn-outline-secondary btn-sm"><i class="bi bi-house"></i> Về trang chủ</a>
             <a href="index.php?page=cart" class="position-relative text-dark btn btn-light rounded-circle">
                <i class="bi bi-bag-fill fs-5 text-primary"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">
                    <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                </span>
            </a>
        </div>
    </div>
</nav>

<div class="container my-4">
    <div class="row">
        
        <div class="col-lg-3 mb-4">
            <div class="filter-sidebar">
                <form action="index.php" method="GET">
                    <input type="hidden" name="page" value="products">
                    
                    <div class="mb-4">
                        <h6 class="filter-title">TÌM KIẾM</h6>
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Nhập tên sản phẩm..." value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                            <button class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="filter-title">DANH MỤC</h6>
                        <?php 
                            $cat = isset($_GET['category']) ? $_GET['category'] : ''; 
                            $cats = [
                                'phone' => 'Điện thoại', 'laptop' => 'Laptop', 'tablet' => 'Tablet', 
                                'audio' => 'Tai nghe', 'watch' => 'Đồng hồ', 'pc' => 'PC & Màn hình', 'accessory' => 'Phụ kiện'
                            ];
                        ?>
                        <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">-- Tất cả danh mục --</option>
                            <?php foreach($cats as $key => $label): ?>
                                <option value="<?php echo $key; ?>" <?php echo ($cat == $key) ? 'selected' : ''; ?>><?php echo $label; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <h6 class="filter-title">THƯƠNG HIỆU</h6>
                        <div class="d-flex flex-column gap-2">
                            <?php 
                                $selected_brand = isset($_GET['brand']) ? $_GET['brand'] : '';
                            ?>
                            <label class="small"><input type="radio" name="brand" value="" onchange="this.form.submit()" <?php echo ($selected_brand == '') ? 'checked' : ''; ?>> Tất cả</label>
                            <?php foreach($brands as $b): ?>
                                <label class="small"><input type="radio" name="brand" value="<?php echo $b; ?>" onchange="this.form.submit()" <?php echo ($selected_brand == $b) ? 'checked' : ''; ?>> <?php echo $b; ?></label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="filter-title">MỨC GIÁ</h6>
                        <?php $price = isset($_GET['price']) ? $_GET['price'] : ''; ?>
                        <div class="d-flex flex-column gap-2">
                            <label class="small"><input type="radio" name="price" value="" onchange="this.form.submit()" <?php echo ($price == '') ? 'checked' : ''; ?>> Tất cả mức giá</label>
                            <label class="small"><input type="radio" name="price" value="duoi-5tr" onchange="this.form.submit()" <?php echo ($price == 'duoi-5tr') ? 'checked' : ''; ?>> Dưới 5 triệu</label>
                            <label class="small"><input type="radio" name="price" value="5tr-10tr" onchange="this.form.submit()" <?php echo ($price == '5tr-10tr') ? 'checked' : ''; ?>> Từ 5 - 10 triệu</label>
                            <label class="small"><input type="radio" name="price" value="10tr-20tr" onchange="this.form.submit()" <?php echo ($price == '10tr-20tr') ? 'checked' : ''; ?>> Từ 10 - 20 triệu</label>
                            <label class="small"><input type="radio" name="price" value="tren-20tr" onchange="this.form.submit()" <?php echo ($price == 'tren-20tr') ? 'checked' : ''; ?>> Trên 20 triệu</label>
                        </div>
                    </div>

                    <a href="index.php?page=products" class="btn btn-outline-danger btn-sm w-100">Xóa bộ lọc</a>
                </form>
            </div>
        </div>

        <div class="col-lg-9">
            
            <div class="d-flex justify-content-between align-items-center mb-3 bg-white p-2 rounded shadow-sm">
                <span class="fw-bold small ms-2">Tìm thấy <?php echo count($products); ?> sản phẩm</span>
                <form action="index.php" method="GET" class="d-flex align-items-center gap-2">
                    <input type="hidden" name="page" value="products">
                    <?php foreach($_GET as $key => $val): if($key!='page' && $key!='sort' && !empty($val)): ?>
                        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>">
                    <?php endif; endforeach; ?>
                    
                    <small class="text-muted text-nowrap">Sắp xếp theo:</small>
                    <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 150px;">
                        <option value="newest" <?php echo (isset($_GET['sort']) && $_GET['sort']=='newest') ? 'selected' : ''; ?>>Mới nhất</option>
                        <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort']=='price_asc') ? 'selected' : ''; ?>>Giá tăng dần</option>
                        <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort']=='price_desc') ? 'selected' : ''; ?>>Giá giảm dần</option>
                    </select>
                </form>
            </div>

            <div class="row g-3">
                <?php if(empty($products)): ?>
                    <div class="col-12 text-center py-5">
                        <img src="https://via.placeholder.com/150x150/f0f2f5/999?text=Empty" class="mb-3 rounded-circle">
                        <h5 class="text-muted">Không tìm thấy sản phẩm nào!</h5>
                        <p class="small">Vui lòng thử bỏ bớt bộ lọc hoặc tìm từ khóa khác.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                        <?php 
                            $original_price = $p['price'];
                            $discount = isset($p['discount']) ? $p['discount'] : 0;
                            $final_price = $original_price * (1 - ($discount / 100));
                            $img_src = (strpos($p['image'], 'http') !== false) ? $p['image'] : BASE_URL . $p['image'];
                        ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card-product h-100">
                            <div class="card-img-wrapper">
                                <?php if($discount > 0): ?>
                                    <div class="discount-badge">-<?php echo $discount; ?>%</div>
                                <?php endif; ?>
                                <a href="index.php?page=product_detail&action=detail&id=<?php echo $p['id']; ?>">
                                    <img src="<?php echo $img_src; ?>" class="card-img-top" alt="<?php echo $p['name']; ?>" style="height: 200px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="card-body p-2">
                                <a href="index.php?page=product_detail&action=detail&id=<?php echo $p['id']; ?>" class="product-name">
                                    <?php echo $p['name']; ?>
                                </a>
                                <div>
                                    <span class="current-price"><?php echo number_format($final_price); ?>đ</span>
                                    <?php if($discount > 0): ?>
                                        <span class="old-price"><?php echo number_format($original_price); ?>đ</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php if ($total_products > 10): ?>
        <div class="text-center mt-5 mb-4" id="load-more-container">
            <button class="btn btn-outline-primary rounded-pill px-5 py-2 fw-bold" id="btn-load-more" data-page="1">
                Xem thêm sản phẩm <i class="bi bi-chevron-down ms-1"></i>
            </button>
        </div>
    <?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#btn-load-more').click(function() {
        var btn = $(this);
        var currentPage = parseInt(btn.data('page'));
        var nextPage = currentPage + 1;
        
        // Lấy các tham số lọc hiện tại trên URL
        var urlParams = new URLSearchParams(window.location.search);
        var keyword = urlParams.get('keyword') || '';
        var category = urlParams.get('category') || '';
        var brand = urlParams.get('brand') || '';
        var price = urlParams.get('price') || '';
        var sort = urlParams.get('sort') || '';

        // Hiệu ứng đang tải
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang tải...');
        btn.prop('disabled', true);

        // Gọi AJAX
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                page: 'products',        // Giữ nguyên page hiện tại
                action: 'load_more',     // Gọi vào case load_more trong Controller
                p: nextPage,             // Trang tiếp theo
                keyword: keyword,
                category: category,
                brand: brand,
                price: price,
                sort: sort
            },
            success: function(response) {
                if ($.trim(response) !== "") {
                    // Thêm sản phẩm mới vào cuối danh sách (Thay #product-list bằng ID div chứa sản phẩm của bạn)
                    $('.row.g-3').append(response); // Nếu div bao quanh sản phẩm của bạn class là "row g-3"
                    
                    // Cập nhật số trang
                    btn.data('page', nextPage);
                    btn.html('Xem thêm sản phẩm <i class="bi bi-chevron-down ms-1"></i>');
                    btn.prop('disabled', false);
                } else {
                    // Nếu không còn dữ liệu -> Ẩn nút
                    $('#load-more-container').remove();
                }
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại!');
                btn.html('Xem thêm sản phẩm');
                btn.prop('disabled', false);
            }
        });
    });
});
</script>
<?php include 'views/layouts/footer.php'; ?>
</body>
</html>