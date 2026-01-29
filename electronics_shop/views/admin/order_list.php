<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn hàng - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        /* Layout flex để Sidebar và Content nằm ngang hàng */
        .wrapper { display: flex; min-height: 100vh; }
        .main-content { flex-grow: 1; padding: 20px; overflow-x: hidden; }
        
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); }
        .table th { font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .badge-status { padding: 8px 12px; border-radius: 30px; font-weight: 500; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 5px; }
    </style>
</head>
<body>

<div class="wrapper">
    <?php include 'views/admin/layout/sidebar.php'; ?>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary m-0"><i class="bi bi-receipt"></i> QUẢN LÝ ĐƠN HÀNG</h4>
                <div class="text-muted small">Hôm nay: <?php echo date('d/m/Y'); ?></div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Mã Đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày đặt</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Định nghĩa màu sắc trạng thái
                                $status_map = [
                                    0 => ['label' => 'Mới đặt',        'class' => 'bg-secondary', 'icon' => 'bi-stars'],
                                    1 => ['label' => 'Đang xử lý',     'class' => 'bg-info text-dark', 'icon' => 'bi-headset'],
                                    2 => ['label' => 'Đang đóng gói',  'class' => 'bg-warning text-dark', 'icon' => 'bi-box-seam'],
                                    3 => ['label' => 'Đang giao',      'class' => 'bg-primary',   'icon' => 'bi-truck'],
                                    4 => ['label' => 'Hoàn thành',     'class' => 'bg-success',   'icon' => 'bi-check-circle-fill'],
                                    5 => ['label' => 'Đơn hủy/Lỗi',    'class' => 'bg-danger',    'icon' => 'bi-x-circle-fill']
                                ];
                                
                                if (empty($orders)): ?>
                                    <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-inbox fs-1 d-block mb-2"></i>Chưa có đơn hàng nào!</td></tr>
                                <?php else: foreach($orders as $o): 
                                    $stt = isset($status_map[$o['status']]) ? $status_map[$o['status']] : $status_map[0];
                                ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">#<?php echo $o['id']; ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($o['fullname']); ?></div>
                                        <div class="small text-muted"><i class="bi bi-phone"></i> <?php echo htmlspecialchars($o['phone']); ?></div>
                                        <div class="small text-muted text-truncate" style="max-width: 200px;" title="<?php echo htmlspecialchars($o['address']); ?>">
                                            <i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($o['address']); ?>
                                        </div>
                                    </td>
                                    <td class="fw-bold text-danger"><?php echo number_format($o['total_money']); ?>đ</td>
                                    <td class="text-muted small"><?php echo date('d/m/Y H:i', strtotime($o['created_at'])); ?></td>
                                    <td>
                                        <span class="badge <?php echo $stt['class']; ?> badge-status">
                                            <i class="bi <?php echo $stt['icon']; ?>"></i> <?php echo $stt['label']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form action="index.php?page=admin_order_update" method="POST" class="d-flex align-items-center gap-2">
                                            <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                            <select name="status" class="form-select form-select-sm" style="width: 140px; font-size: 0.85rem;" onchange="if(confirm('Cập nhật trạng thái đơn hàng này?')) this.form.submit()">
                                                <option value="0" <?php echo $o['status']==0?'selected':''; ?>>0. Mới đặt</option>
                                                <option value="1" <?php echo $o['status']==1?'selected':''; ?>>1. Đang xử lý</option>
                                                <option value="2" <?php echo $o['status']==2?'selected':''; ?>>2. Đóng gói</option>
                                                <option value="3" <?php echo $o['status']==3?'selected':''; ?>>3. Đang giao</option>
                                                <option value="4" <?php echo $o['status']==4?'selected':''; ?>>4. Hoàn thành</option>
                                                <option value="5" <?php echo $o['status']==5?'selected':''; ?>>5. Hủy đơn</option>
                                            </select>
                                        </form>
                                    </td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>