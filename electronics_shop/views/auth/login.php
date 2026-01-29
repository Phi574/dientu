<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Quản Trị - Tech Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            width: 400px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            padding: 40px;
            text-align: center;
        }
        .login-icon {
            width: 80px;
            height: 80px;
            background: #0d6efd;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }
        .form-control {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
            background: #fff;
        }
        .btn-login {
            background: #0d6efd;
            color: #fff;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: bold;
            border: none;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
        }
        .home-link {
            display: block;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }
        .home-link:hover { color: #0d6efd; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-icon">
        <i class="bi bi-shield-lock-fill"></i>
    </div>
    <h4 class="fw-bold mb-1">QUẢN TRỊ VIÊN</h4>
    <p class="text-muted small mb-4">Vui lòng đăng nhập để tiếp tục</p>

    <?php if(isset($error_msg)): ?>
        <div class="alert alert-danger p-2 small"><?php echo $error_msg; ?></div>
    <?php endif; ?>

    <form action="index.php?page=login&action=login" method="POST">
        <div class="text-start">
            <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required autofocus>
        </div>
        <div class="text-start">
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
        </div>
        
        <button type="submit" class="btn-login">
            ĐĂNG NHẬP <i class="bi bi-arrow-right-short"></i>
        </button>
    </form>

    <a href="index.php" class="home-link"><i class="bi bi-arrow-left"></i> Quay về trang bán hàng</a>
</div>

</body>
</html>