<style>
    /* Admin Sidebar Custom CSS */
    .sidebar { background: #2c3e50; min-height: 100vh; color: #fff; }
    .sidebar .nav-link { color: #bdc3c7; padding: 12px 20px; transition: 0.3s; border-radius: 5px; margin-bottom: 5px; }
    .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #34495e; color: #3498db; font-weight: bold; padding-left: 25px; }
    .sidebar i { margin-right: 10px; width: 20px; text-align: center; }
    .logo-admin { font-size: 24px; font-weight: 800; text-align: center; padding: 20px 0; color: #fff; letter-spacing: 2px; border-bottom: 1px solid #34495e; margin-bottom: 20px; }
</style>

<div class="sidebar p-3">
    <div class="logo-admin"><i class="bi bi-shield-check"></i> ADMIN</div>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_products"><i class="bi bi-box-seam"></i> Sản phẩm</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_orders"><i class="bi bi-receipt"></i> Đơn hàng <span class="badge bg-danger float-end">Mới</span></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_banners"><i class="bi bi-images"></i> Banner</a></li>
        <li class="nav-item mt-5 border-top pt-3"><a class="nav-link text-danger" href="index.php?page=logout"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a></li>
    </ul>
</div>