<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đăng nhập hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 400px; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
    </style>
</head>
<body>

<div class="card login-card border-0">
    <div class="card-header bg-white text-center py-4">
        <h3 class="fw-bold text-primary">TECH ADMIN</h3>
        <p class="text-muted mb-0">Đăng nhập để quản lý</p>
    </div>
    <div class="card-body p-4">
        <?php if(isset($error_msg)): ?>
            <div class="alert alert-danger text-center"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form action="index.php?page=login" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Tài khoản</label>
                <input type="text" name="username" class="form-control" placeholder="Nhập username..." required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu..." required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary py-2 fw-bold">ĐĂNG NHẬP</button>
            </div>
        </form>
    </div>
    <div class="card-footer bg-light text-center py-3">
        <a href="index.php" class="text-decoration-none small">Về trang chủ bán hàng</a>
    </div>
</div>

</body>
</html>