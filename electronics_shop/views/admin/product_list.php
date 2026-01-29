<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .main-content { margin-left: 250px; padding: 20px; transition: 0.3s; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .table img { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; }
        .action-btn { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 5px; }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include 'views/admin/layout/sidebar.php'; ?>

    <div class="main-content flex-grow-1">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary"><i class="bi bi-box-seam"></i> DANH SÁCH SẢN PHẨM</h4>
                <a href="index.php?page=admin_products&action=create" class="btn btn-primary fw-bold shadow-sm">
                    <i class="bi bi-plus-lg"></i> Thêm mới
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Hình ảnh</th>
                                    <th width="25%">Tên sản phẩm</th>
                                    <th width="15%">Giá bán</th>
                                    <th width="10%">Giảm giá</th>
                                    <th width="15%">Danh mục</th>
                                    <th width="10%">Hãng</th>
                                    <th width="10%">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($products)): ?>
                                    <tr><td colspan="8" class="text-center py-4 text-muted">Chưa có sản phẩm nào.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($products as $p): 
                                        $img_src = (strpos($p['image'], 'http') !== false) ? $p['image'] : BASE_URL . $p['image'];
                                    ?>
                                    <tr>
                                        <td><?php echo $p['id']; ?></td>
                                        <td><img src="<?php echo $img_src; ?>" alt="Product"></td>
                                        <td class="fw-bold text-dark"><?php echo $p['name']; ?></td>
                                        <td class="text-danger fw-bold"><?php echo number_format($p['price']); ?>đ</td>
                                        <td>
                                            <?php if($p['discount'] > 0): ?>
                                                <span class="badge bg-danger">-<?php echo $p['discount']; ?>%</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">0%</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $p['category']; ?></td>
                                        <td><?php echo $p['brand']; ?></td>
                                        <td>
                                            <a href="index.php?page=admin_products&action=edit&id=<?php echo $p['id']; ?>" class="btn btn-sm btn-light text-primary action-btn me-1" title="Sửa"><i class="bi bi-pencil-square"></i></a>
                                            <a href="index.php?page=admin_products&action=delete&id=<?php echo $p['id']; ?>" class="btn btn-sm btn-light text-danger action-btn" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');"><i class="bi bi-trash"></i></a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>