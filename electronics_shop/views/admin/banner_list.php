<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2>Quản lý Banner Quảng Cáo</h2>
    <a href="index.php?page=admin_banners&action=create" class="btn btn-primary mb-3">Thêm Banner Mới</a>
    <a href="index.php?page=admin_products" class="btn btn-secondary mb-3">Về Quản lý SP</a>
    
    <table class="table table-bordered">
        <thead><th>Hình ảnh</th><th>Hành động</th></thead>
        <tbody>
            <?php foreach ($banners as $b): ?>
            <tr>
                <td><img src="<?php echo BASE_URL . $b['image']; ?>" height="100"></td>
                <td>
                    <a href="index.php?page=admin_banners&action=delete&id=<?php echo $b['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa banner này?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>