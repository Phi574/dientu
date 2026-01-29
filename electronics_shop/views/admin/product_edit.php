<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Sản Phẩm: <?php echo $product['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="card shadow" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header bg-warning text-dark fw-bold">
            CHỈNH SỬA SẢN PHẨM: #<?php echo $product['id']; ?>
        </div>
        <div class="card-body">
            <form action="index.php?page=admin_products&action=update&id=<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="old_image" value="<?php echo $product['image']; ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Hãng sản xuất</label>
                        <input type="text" name="brand" class="form-control" value="<?php echo $product['brand']; ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Giá gốc (VNĐ)</label>
                        <input type="number" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Giảm giá (%)</label>
                        <input type="number" name="discount" class="form-control" value="<?php echo $product['discount']; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Mô tả chi tiết</label>
                    <textarea name="description" class="form-control" rows="4"><?php echo $product['description']; ?></textarea>
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
                <div class="mb-3 p-3 border rounded bg-white">
                    <label class="form-label fw-bold">Ảnh đại diện (Ảnh chính)</label>
                    <div class="d-flex align-items-center gap-3">
                        <img src="<?php echo (strpos($product['image'], 'http') !== false) ? $product['image'] : BASE_URL . $product['image']; ?>" 
                             width="80" height="80" class="border rounded object-fit-cover">
                        <div class="flex-grow-1">
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Chỉ chọn nếu muốn thay ảnh mới.</small>
                        </div>
                    </div>
                </div>

                <div class="mb-4 p-3 border rounded bg-white">
                    <label class="form-label fw-bold">Thư viện ảnh phụ</label>
                    
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <?php foreach ($gallery as $img): ?>
                        <div class="position-relative" style="width: 60px; height: 60px;">
                            <img src="<?php echo BASE_URL . $img['image_path']; ?>" class="w-100 h-100 border rounded object-fit-cover">
                        </div>
                        <?php endforeach; ?>
                        <?php if(empty($gallery)) echo "<span class='text-muted small'>Chưa có ảnh phụ nào.</span>"; ?>
                    </div>

                    <label class="small fw-bold text-primary">+ Thêm ảnh phụ khác (Chọn nhiều)</label>
                    <input type="file" name="gallery[]" class="form-control form-control-sm" multiple accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php?page=admin_products" class="btn btn-secondary">Hủy bỏ</a>
                    <button type="submit" class="btn btn-warning fw-bold px-4">Cập nhật ngay</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>