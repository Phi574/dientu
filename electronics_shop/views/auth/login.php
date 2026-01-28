<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #2563eb, #1e40af); /* Màu xanh giống mẫu */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 360px;
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,.25);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #1e3a8a;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            box-sizing: border-box; /* Fix lỗi tràn lề */
        }
        input:focus {
            border-color: #2563eb;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        button:hover {
            background: #1d4ed8;
        }
        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
        }
        .footer-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .footer-link a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>🔐 Đăng nhập Admin</h2>

    <?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="error">❌ Sai tên đăng nhập hoặc mật khẩu!</div>
    <?php endif; ?>

    <form method="post" action="index.php?page=login&action=submit">
        <input type="text" name="username" placeholder="Tên đăng nhập" required autofocus>
        <input type="password" name="password" placeholder="Mật khẩu" required>

        <button type="submit">Đăng nhập ngay</button>
    </form>

    <div class="footer-link">
        <a href="index.php?page=home">← Quay về trang bán hàng</a>
    </div>
</div>

</body>
</html>