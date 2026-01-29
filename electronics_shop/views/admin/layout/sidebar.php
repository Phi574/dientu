<style>
    .sidebar { min-height: 100vh; width: 250px; background: #2c3e50; color: #fff; transition: all 0.3s; }
    .sidebar .nav-link { color: #b0b8c1; padding: 12px 20px; font-weight: 500; border-left: 3px solid transparent; transition: 0.2s; }
    .sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,0.05); }
    .sidebar .nav-link.active { color: #3498db; background: rgba(52, 152, 219, 0.1); border-left-color: #3498db; }
    .sidebar i { width: 25px; text-align: center; margin-right: 10px; }
    .logo-box { padding: 25px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 15px; }
</style>

<div class="sidebar d-flex flex-column flex-shrink-0 p-3">
    <a href="index.php?page=admin_dashboard" class="logo-box text-decoration-none text-white d-block text-center mb-3">
        <i class="bi bi-cpu-fill fs-2 text-primary"></i>
        <div class="fw-bold fs-5 mt-2">TECH ADMIN</div>
    </a>
    
    <ul class="nav flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php?page=admin_dashboard" class="nav-link <?php echo ($_GET['page']=='admin_dashboard')?'active':''; ?>">
                <i class="bi bi-speedometer2"></i> Tổng quan
            </a>
        </li>
        <li class="nav-item">
            <a href="index.php?page=admin_products" class="nav-link <?php echo ($_GET['page']=='admin_products')?'active':''; ?>">
                <i class="bi bi-box-seam"></i> Quản lý Sản phẩm
            </a>
        </li>
        
        <li class="nav-item">
            <a href="index.php?page=admin_orders" class="nav-link <?php echo ($_GET['page']=='admin_orders')?'active':''; ?>">
                <i class="bi bi-receipt"></i> Quản lý Đơn hàng
            </a>
        </li>
        
        <li class="nav-item">
            <a href="index.php?page=admin_banners" class="nav-link <?php echo ($_GET['page']=='admin_banners')?'active':''; ?>">
                <i class="bi bi-images"></i> Quản lý Banner
            </a>
        </li>
        
        <li class="nav-item mt-5 pt-3 border-top border-secondary">
            <a href="index.php?page=logout" class="nav-link text-danger" onclick="return confirm('Đăng xuất khỏi hệ thống?');">
                <i class="bi bi-box-arrow-right"></i> Đăng xuất
            </a>
        </li>
    </ul>
</div>