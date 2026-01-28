<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tech Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        
        /* Sidebar Menu */
        .sidebar { min-height: 100vh; background: #212529; color: #fff; }
        .sidebar .nav-link { color: rgba(255,255,255,0.75); padding: 12px 20px; font-weight: 500; display: flex; align-items: center; gap: 10px; border-radius: 8px; margin-bottom: 5px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #0d6efd; color: #fff; box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3); }
        .sidebar-brand { font-size: 1.5rem; font-weight: bold; padding: 20px; color: #fff; text-decoration: none; display: block; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
        
        /* Main Content */
        .main-content { padding: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; }
        .card-header { background: #fff; border-bottom: 1px solid #eee; padding: 20px; display: flex; justify-content: space-between; align-items: center; }
        
        /* Table Styles */
        .table img { width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #eee; }
        .table th { font-weight: 600; color: #555; background: #f9fafb; border-bottom: 2px solid #eee; }
        .table td { vertical-align: middle; }
        
        /* Buttons */
        .btn-custom { border-radius: 8px; padding: 8px 16px; font-weight: 500; transition: 0.2s; }
        .btn-custom:hover { transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-2 sidebar d-none d-md-block p-3">
            <a href="index.php" class="sidebar-brand">
                <i class="bi bi-cpu-fill text-primary"></i> TECH ADMIN
            </a>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=admin_products">
                        <i class="bi bi-box-seam"></i> Quản lý Sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=admin_banners">
                        <i class="bi bi-images"></i> Quản lý Banner
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#chatModal">
                        <i class="bi bi-chat-dots"></i> Chat Hỗ trợ
                    </a>
                </li>
                <li class="nav-item mt-4 border-top pt-3">
                    <a class="nav-link text-danger" href="index.php">
                        <i class="bi bi-box-arrow-right"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-md-10 main-content">
            
            <div class="d-block d-md-none mb-3">
                <nav class="navbar navbar-dark bg-dark rounded">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">Tech Admin</span>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </nav>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="opacity-75">Tổng sản phẩm</h6>
                                <h3><?php echo count($products); ?></h3>
                            </div>
                            <i class="bi bi-box-seam fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="opacity-75">Doanh thu tạm tính</h6>
                                <h3>0 đ</h3>
                            </div>
                            <i class="bi bi-currency-dollar fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-dark p-3" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#uploadBannerModal">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="opacity-75">Quảng cáo</h6>
                                <h5 class="fw-bold"><i class="bi bi-cloud-arrow-up"></i> Đăng Banner Nhanh</h5>
                            </div>
                            <i class="bi bi-images fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold">Danh sách sản phẩm</h5>
                    <div>
                        <a href="index.php?page=admin_products&action=create" class="btn btn-primary btn-custom">
                            <i class="bi bi-plus-lg"></i> Thêm mới
                        </a>
                        <a href="index.php?page=home" class="btn btn-outline-secondary btn-custom ms-2">
                            <i class="bi bi-eye"></i> Xem Shop
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="10%">Hình ảnh</th>
                                    <th width="30%">Tên sản phẩm</th>
                                    <th width="15%">Giá bán</th>
                                    <th width="25%">Mô tả ngắn</th>
                                    <th width="15%" class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($products)): ?>
                                    <tr><td colspan="6" class="text-center py-4 text-muted">Chưa có sản phẩm nào.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($products as $p): ?>
                                    <tr>
                                        <td class="text-center fw-bold text-muted"><?php echo $p['id']; ?></td>
                                        <td>
                                            <img src="<?php echo (strpos($p['image'], 'http') !== false) ? $p['image'] : BASE_URL . $p['image']; ?>" 
                                                 alt="SP" onerror="this.src='https://via.placeholder.com/50'">
                                        </td>
                                        <td class="fw-bold text-dark"><?php echo $p['name']; ?></td>
                                        <td class="text-danger fw-bold"><?php echo number_format($p['price']); ?> đ</td>
                                        <td class="text-muted small"><?php echo substr($p['description'], 0, 50); ?>...</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-light text-primary border me-1" title="Sửa"><i class="bi bi-pencil-square"></i></a>
                                            <a href="index.php?page=admin_products&action=delete&id=<?php echo $p['id']; ?>" 
                                               class="btn btn-sm btn-light text-danger border" 
                                               onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');" title="Xóa">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="uploadBannerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title fw-bold">Đăng Banner Quảng Cáo Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?page=admin_banners&action=create" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Chọn ảnh Banner (Khuyên dùng: 1200x400px)</label>
                        <input type="file" name="image" class="form-control" required accept="image/*">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning fw-bold">Tải lên ngay</button>
                    </div>
                    <p class="text-muted small mt-2 text-center">*Banner sẽ hiện ngay ngoài trang chủ sau khi tải lên</p>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>