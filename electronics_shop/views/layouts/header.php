<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Store - Hệ thống bán lẻ công nghệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root { --primary-color: #0d6efd; --secondary-color: #0a58ca; }
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        
        /* Navbar Custom */
        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .search-box { background: #f3f4f6; border-radius: 20px; padding: 5px 15px; width: 400px; display: flex; align-items: center; }
        .search-input { border: none; background: transparent; outline: none; width: 100%; margin-left: 10px; }
        
        /* Footer link */
        footer a { text-decoration: none; color: #bbb; transition: 0.3s; }
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

        <div class="search-box d-none d-lg-flex mx-auto">
            <form action="index.php" method="GET" class="d-flex align-items-center w-100">
                <input type="hidden" name="page" value="products">
                <button type="submit" class="btn border-0 p-0 text-muted">
                    <i class="bi bi-search"></i>
                </button>
                <input type="text" name="keyword" class="search-input form-control shadow-none border-0 bg-transparent" 
                       placeholder="Bạn cần tìm gì? iPhone 15..." 
                       value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
            </form>
        </div>

        <div class="d-flex align-items-center gap-4 ms-auto">
            <div class="d-none d-xl-flex align-items-center gap-2 text-decoration-none text-dark">
                <i class="bi bi-telephone-fill fs-5 text-primary"></i>
                <div>
                    <small class="d-block text-muted" style="font-size: 11px;">Hotline</small>
                    <span class="fw-bold" style="font-size: 14px;">1900.6789</span>
                </div>
            </div>

            <a href="index.php?page=products" class="btn btn-sm btn-outline-dark fw-bold rounded-pill d-none d-md-block">
                <i class="bi bi-grid"></i> Shop
            </a>

            <a href="index.php?page=cart" class="position-relative text-dark btn btn-light rounded-circle">
                <i class="bi bi-bag-fill fs-5 text-primary"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">
                    <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                </span>
            </a>
            
            <a href="index.php?page=admin_dashboard" class="text-secondary" title="Quản trị viên">
                <i class="bi bi-person-circle fs-4"></i>
            </a>
        </div>
    </div>
</nav>