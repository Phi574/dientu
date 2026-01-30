<?php include 'views/layouts/header.php'; ?>

<style>
    /* CSS đồng bộ với trang bảo hành */
    .policy-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 40px;
    }
    .policy-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        height: 100%;
        transition: transform 0.3s;
    }
    .policy-card:hover { transform: translateY(-5px); }
    
    /* Card Ngân hàng đẹp mắt */
    .bank-card {
        background: linear-gradient(45deg, #198754, #20c997);
        color: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    .bank-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(45deg);
    }
</style>

<div class="policy-header text-center">
    <div class="container">
        <h1 class="fw-bold mb-3">GIAO HÀNG & THANH TOÁN</h1>
        <p class="lead opacity-75">Nhanh chóng - An toàn - Tiện lợi</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-5">
        
        <div class="col-lg-6">
            <h3 class="fw-bold text-primary mb-4 pb-2 border-bottom"><i class="bi bi-truck"></i> CHÍNH SÁCH GIAO HÀNG</h3>
            
            <div class="policy-card card p-4 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Phạm vi & Phí giao hàng</h5>
                    <ul class="list-unstyled text-secondary mt-3">
                        <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> <strong>Toàn quốc:</strong> Hỗ trợ giao hàng 63 tỉnh thành.</li>
                        <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> <strong>Miễn phí vận chuyển:</strong> Cho đơn hàng > 5.000.000đ.</li>
                        <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> <strong>Phí đồng giá:</strong> 30.000đ cho đơn dưới 5 triệu.</li>
                    </ul>
                </div>
            </div>

            <div class="policy-card card p-4 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold"><i class="bi bi-clock-history text-warning me-2"></i>Thời gian giao hàng</h5>
                    <ul class="list-unstyled text-secondary mt-3">
                        <li class="mb-3">
                            <strong><i class="bi bi-building"></i> Nội thành TP.HCM / Hà Nội:</strong><br>
                            Giao siêu tốc 2h - 4h hoặc nhận trong ngày.
                        </li>
                        <li>
                            <strong><i class="bi bi-signpost-2"></i> Các tỉnh thành khác:</strong><br>
                            Nhận hàng sau 2 - 4 ngày làm việc (trừ CN/Lễ).
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="policy-card card p-4">
                <div class="card-body">
                    <h5 class="fw-bold"><i class="bi bi-box-seam text-info me-2"></i>Đồng kiểm khi nhận hàng</h5>
                    <p class="text-secondary mb-0 mt-2">
                        Quý khách được quyền <strong>MỞ HỘP KIỂM TRA</strong> ngoại quan (không bật nguồn/kích hoạt) trước khi thanh toán cho shipper. Nếu hàng móp méo/vỡ, vui lòng từ chối nhận.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <h3 class="fw-bold text-primary mb-4 pb-2 border-bottom"><i class="bi bi-wallet2"></i> PHƯƠNG THỨC THANH TOÁN</h3>

            <div class="card mb-4 border-0 shadow-sm bg-light">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="bg-white p-3 rounded-circle shadow-sm me-3 text-success">
                        <i class="bi bi-cash-stack fs-2"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Thanh toán khi nhận hàng (COD)</h5>
                        <small class="text-muted">Quý khách thanh toán tiền mặt trực tiếp cho nhân viên giao hàng khi nhận sản phẩm.</small>
                    </div>
                </div>
            </div>

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary p-3 rounded-circle shadow-sm me-3 text-white">
                            <i class="bi bi-bank fs-2"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Chuyển khoản ngân hàng</h5>
                            <span class="badge bg-danger">Giảm ngay 2%</span> <small class="text-muted">khi thanh toán trước.</small>
                        </div>
                    </div>
                    
                    <div class="bank-card shadow">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold fs-5 fst-italic">TECH STORE BANK</span>
                            <i class="bi bi-wifi fs-4"></i>
                        </div>
                        <div class="mb-1 opacity-75 small text-uppercase">Số tài khoản</div>
                        <div class="fs-1 fw-bold mb-3" style="letter-spacing: 2px; font-family: monospace;">1900 6789 9999</div>
                        <div class="d-flex justify-content-between text-uppercase small">
                            <span>Chủ TK: <strong>CTY TECH STORE</strong></span>
                            <span>CN: TP.HO CHI MINH</span>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning border-0 small mt-3">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> <strong>Lưu ý nội dung chuyển khoản:</strong><br>
                        <code class="fs-6 fw-bold text-dark d-block mt-1 p-2 bg-white rounded border">SDT_MUA_HANG + TEN_KHACH_HANG</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>