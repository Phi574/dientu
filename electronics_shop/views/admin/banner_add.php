<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Banner Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Thêm Banner Quảng Cáo</h4>
        </div>
        <div class="card-body">
            <form action="index.php?page=admin_banners&action=create" method="POST" enctype="multipart/form-data">
                
                <div class="alert alert-info">
                    <strong>Lưu ý:</strong> Banner sẽ tự động lưu vào thư mục <code>views/assets/img/</code>
                </div>

                <div class="mb-3">
                    <label class="form-label">Chọn hình ảnh Banner</label>
                    <input type="file" name="image" class="form-control" required accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php?page=admin_banners" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Tải lên ngay</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>