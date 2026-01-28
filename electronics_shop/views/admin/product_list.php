<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-primary">Quản lý Đồ Điện Tử</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="index.php?page=admin_products&action=create" class="btn btn-success">+ Thêm Sản Phẩm Mới</a>
        <a href="index.php?page=home" class="btn btn-outline-secondary">Về Trang Chủ Shop</a>
    </div>

    <table class="table table-bordered table-hover bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p): ?>
            <tr>
                <td><?php echo $p['id']; ?></td>
                <td><?php echo $p['name']; ?></td>
                <td><?php echo number_format($p['price']); ?> VNĐ</td>
                <td><?php echo $p['description']; ?></td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="index.php?page=admin_products&action=delete&id=<?php echo $p['id']; ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Bạn chắc chắn muốn xóa chứ?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="card mt-4">
        <div class="card-header bg-info text-white">Hỗ trợ khách hàng (Chat)</div>
        <div class="card-body">
            <p>Admin có thể xem tin nhắn tại đây...</p>
        </div>
    </div>
</div>

</body>
</html>