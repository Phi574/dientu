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
        .main-content { padding: 20px; transition: 0.3s; flex-grow: 1; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); }
        .badge-status { min-width: 100px; }
    </style>
</head>
<body>

<div class="d-flex" style="min-height: 100vh;">
    <?php include 'views/admin/layout/sidebar.php'; ?>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                <h4 class="fw-bold text-primary m-0"><i class="bi bi-receipt"></i> QUẢN LÝ ĐƠN HÀNG</h4>
                
                <form action="index.php" method="GET" class="d-flex gap-2 shadow-sm p-2 bg-white rounded">
                    <input type="hidden" name="page" value="admin_orders">
                    
                    <input type="text" name="keyword" class="form-control border-0 bg-light" 
                           placeholder="Mã đơn, Tên, SĐT..." 
                           value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                    
                    <select name="status" class="form-select border-0 bg-light" style="width: 150px;">
                        <option value="">Tất cả TT</option>
                        <option value="0" <?php echo (isset($_GET['status']) && $_GET['status']=='0')?'selected':''; ?>>Mới đặt</option>
                        <option value="1" <?php echo (isset($_GET['status']) && $_GET['status']=='1')?'selected':''; ?>>Đang xử lý</option>
                        <option value="4" <?php echo (isset($_GET['status']) && $_GET['status']=='4')?'selected':''; ?>>Hoàn thành</option>
                        <option value="5" <?php echo (isset($_GET['status']) && $_GET['status']=='5')?'selected':''; ?>>Đã hủy</option>
                    </select>
                    
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    <a href="index.php?page=admin_orders" class="btn btn-light text-muted" title="Reset"><i class="bi bi-arrow-counterclockwise"></i></a>
                </form>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Mã</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Cập nhật nhanh</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $status_map = [
                                    0 => ['label' => 'Mới đặt', 'class' => 'bg-secondary'],
                                    1 => ['label' => 'Đang xử lý', 'class' => 'bg-info text-dark'],
                                    2 => ['label' => 'Đóng gói', 'class' => 'bg-warning text-dark'],
                                    3 => ['label' => 'Đang giao', 'class' => 'bg-primary'],
                                    4 => ['label' => 'Hoàn thành', 'class' => 'bg-success'],
                                    5 => ['label' => 'Đã hủy', 'class' => 'bg-danger']
                                ];
                                
                                if (empty($orders)): ?>
                                    <tr><td colspan="6" class="text-center py-5 text-muted">Không tìm thấy đơn hàng nào!</td></tr>
                                <?php else: foreach($orders as $o): 
                                    $stt = isset($status_map[$o['status']]) ? $status_map[$o['status']] : $status_map[0];
                                ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">#<?php echo $o['id']; ?></td>
                                    <td>
                                        <div class="fw-bold"><?php echo htmlspecialchars($o['fullname']); ?></div>
                                        <div class="small text-muted"><?php echo htmlspecialchars($o['phone']); ?></div>
                                    </td>
                                    <td class="fw-bold text-danger"><?php echo number_format($o['total_money']); ?>đ</td>
                                    <td><span class="badge <?php echo $stt['class']; ?> badge-status"><?php echo $stt['label']; ?></span></td>
                                    <td>
                                        <form action="index.php?page=admin_order_update" method="POST">
                                            <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                            <select name="status" class="form-select form-select-sm" style="width: 130px;" onchange="this.form.submit()">
                                                <option value="0" <?php echo $o['status']==0?'selected':''; ?>>0. Mới đặt</option>
                                                <option value="1" <?php echo $o['status']==1?'selected':''; ?>>1. Xử lý</option>
                                                <option value="2" <?php echo $o['status']==2?'selected':''; ?>>2. Đóng gói</option>
                                                <option value="3" <?php echo $o['status']==3?'selected':''; ?>>3. Vận chuyển</option>
                                                <option value="4" <?php echo $o['status']==4?'selected':''; ?>>4. Hoàn thành</option>
                                                <option value="5" <?php echo $o['status']==5?'selected':''; ?>>5. Hủy đơn</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <a href="index.php?page=admin_order_detail&id=<?php echo $o['id']; ?>" class="btn btn-sm btn-outline-primary" title="Xem chi tiết"><i class="bi bi-eye"></i></a>
                                        
                                        <a href="index.php?page=admin_order_delete&id=<?php echo $o['id']; ?>" class="btn btn-sm btn-outline-danger ms-1" onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn đơn này?');" title="Xóa đơn"><i class="bi bi-trash"></i></a>
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
</body>
</html>