<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Thêm Sản Phẩm Mới</h4>
        </div>
        <div class="card-body">
            <form action="index.php?page=admin_products&action=create" method="POST">
                
                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" required placeholder="Ví dụ: iPhone 15 Pro Max">
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá (VNĐ)</label>
                    <input type="number" name="price" class="form-control" required placeholder="Ví dụ: 25000000">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả chi tiết</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Nhập thông tin chi tiết sản phẩm..."></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php?page=admin_products" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                </div>
                <div class="mb-3">
        <label class="form-label">Hình ảnh sản phẩm</label>
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>