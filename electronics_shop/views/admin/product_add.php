<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="card shadow-sm" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Thêm Sản Phẩm Mới</h4>
        </div>
        <div class="card-body">
            <form action="index.php?page=admin_products&action=create" method="POST" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" required placeholder="Ví dụ: iPhone 15 Pro Max">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Hãng sản xuất</label>
                        <input type="text" name="brand" class="form-control" required placeholder="Ví dụ: Apple, Samsung...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Giá gốc (VNĐ)</label>
                        <input type="number" name="price" class="form-control" required placeholder="Ví dụ: 25000000">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Giảm giá (%)</label>
                        <input type="number" name="discount" class="form-control" value="0" placeholder="Nhập số % giảm (VD: 10)">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Mô tả chi tiết</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Nhập thông tin chi tiết sản phẩm..."></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Loại sản phẩm</label>
                    <select name="category" class="form-select" required>
                        <option value="">-- Chọn loại --</option>
                        <option value="phone">Điện thoại</option>
                        <option value="laptop">Laptop</option>
                        <option value="tablet">Tablet (Máy tính bảng)</option>
                        <option value="audio">Tai nghe / Loa</option>
                        <option value="watch">Đồng hồ thông minh</option>
                        <option value="pc">PC & Màn hình</option>
                        <option value="accessory">Phụ kiện</option>
                    </select>
                </div>
                <div class="mb-4 p-3 border rounded bg-white">
                    <label class="form-label fw-bold text-danger">Hình ảnh sản phẩm</label>
                    <div class="input-group">
                        <input type="file" name="images[]" class="form-control" required accept="image/*" multiple>
                    </div>
                    <div class="form-text text-muted">
                        * Ảnh đầu tiên bạn chọn sẽ được dùng làm <strong>Ảnh đại diện (Ảnh chính)</strong>.<br>
                        * Các ảnh còn lại sẽ nằm trong thư viện ảnh chi tiết <strong>( thêm ảnh ở trong mục cập nhật sản phẩm )</strong>.<br>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php?page=admin_products" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary fw-bold px-4">Lưu sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>