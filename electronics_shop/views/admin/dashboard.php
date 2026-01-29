<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quản trị hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f3f4f6; font-family: 'Segoe UI', sans-serif; }
        .wrapper { display: flex; min-height: 100vh; }
        .main-content { flex-grow: 1; padding: 30px; }
        
        /* Stats Card */
        .stats-card { background: #fff; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: transform 0.3s; border: none; height: 100%; }
        .stats-card:hover { transform: translateY(-5px); }
        .stats-icon { width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 15px; }
        
        .bg-icon-primary { background: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-icon-success { background: rgba(25, 135, 84, 0.1); color: #198754; }
        .bg-icon-warning { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
        .bg-icon-danger { background: rgba(220, 53, 69, 0.1); color: #dc3545; }

        .stats-label { color: #6c757d; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .stats-value { font-size: 2rem; font-weight: 800; color: #212529; margin-bottom: 0; }

        /* Table Card */
        .table-card { background: #fff; border-radius: 15px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; }
        .table-header { padding: 20px 25px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
        .table th { font-weight: 600; text-transform: uppercase; font-size: 0.8rem; color: #888; border-bottom-width: 1px; }
    </style>
</head>
<body>

<div class="wrapper">
    <?php include 'views/admin/layout/sidebar.php'; ?>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h3 class="fw-bold text-dark m-0">Tổng quan</h3>
                    <p class="text-muted small m-0">Chào mừng quay trở lại, Admin!</p>
                </div>
                <a href="index.php?page=home" class="btn btn-outline-primary btn-sm rounded-pill px-3" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> Xem Website
                </a>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-icon-success"><i class="bi bi-currency-dollar"></i></div>
                        <div class="stats-label">Doanh thu thực tế</div>
                        <h3 class="stats-value"><?php echo number_format($revenue); ?><span class="fs-6 text-muted fw-normal">đ</span></h3>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-icon-primary"><i class="bi bi-receipt"></i></div>
                        <div class="stats-label">Tổng đơn hàng</div>
                        <h3 class="stats-value"><?php echo number_format($total_orders); ?></h3>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-icon-warning"><i class="bi bi-box-seam"></i></div>
                        <div class="stats-label">Sản phẩm kho</div>
                        <h3 class="stats-value"><?php echo number_format($total_products); ?></h3>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="stats-icon bg-icon-danger"><i class="bi bi-hourglass-split"></i></div>
                        <div class="stats-label">Chờ xử lý</div>
                        <h3 class="stats-value"><?php echo number_format($pending_orders); ?></h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-card">
                        <div class="table-header">
                            <h5 class="fw-bold m-0 text-primary"><i class="bi bi-clock-history"></i> Đơn hàng mới nhất</h5>
                            <a href="index.php?page=admin_orders" class="btn btn-sm btn-light text-primary fw-bold">Xem tất cả <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Mã đơn</th>
                                            <th>Khách hàng</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(empty($recent_orders)): ?>
                                            <tr><td colspan="5" class="text-center py-4 text-muted">Chưa có đơn hàng nào.</td></tr>
                                        <?php else: foreach($recent_orders as $order): ?>
                                        <tr>
                                            <td class="ps-4 fw-bold">#<?php echo $order['id']; ?></td>
                                            <td><?php echo htmlspecialchars($order['fullname']); ?></td>
                                            <td class="fw-bold text-danger"><?php echo number_format($order['total_money']); ?>đ</td>
                                            <td>
                                                <?php 
                                                    if($order['status']==0) echo '<span class="badge bg-secondary">Mới đặt</span>';
                                                    elseif($order['status']==1) echo '<span class="badge bg-info text-dark">Đang xử lý</span>';
                                                    elseif($order['status']==2) echo '<span class="badge bg-warning text-dark">Đóng gói</span>';
                                                    elseif($order['status']==3) echo '<span class="badge bg-primary">Vận chuyển</span>';
                                                    elseif($order['status']==4) echo '<span class="badge bg-success">Hoàn thành</span>';
                                                    else echo '<span class="badge bg-danger">Hủy</span>';
                                                ?>
                                            </td>
                                            <td class="text-muted small"><?php echo date('d/m H:i', strtotime($order['created_at'])); ?></td>
                                        </tr>
                                        <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>