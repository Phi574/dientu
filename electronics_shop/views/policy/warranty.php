<?php include 'views/layouts/header.php'; ?>

<style>
    .policy-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 40px;
    }
    .policy-icon {
        font-size: 2.5rem;
        color: #0d6efd;
        margin-bottom: 15px;
    }
    .policy-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        height: 100%;
        transition: transform 0.3s;
    }
    .policy-card:hover {
        transform: translateY(-5px);
    }
    .search-warranty-box {
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-top: -50px;
        position: relative;
        z-index: 10;
    }
</style>

<div class="policy-header text-center">
    <div class="container">
        <h1 class="fw-bold mb-3">CHÍNH SÁCH BẢO HÀNH</h1>
        <p class="lead opacity-75">Cam kết chất lượng - Hậu mãi chu đáo - An tâm tuyệt đối</p>
    </div>
</div>

<div class="container mb-5">
    
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="search-warranty-box text-center">
                <h4 class="fw-bold mb-3 text-primary"><i class="bi bi-search"></i> Kiểm tra thời hạn bảo hành</h4>
                <p class="text-muted small mb-4">Nhập số điện thoại hoặc IMEI máy để kiểm tra thông tin bảo hành của bạn.</p>
                <form class="d-flex gap-2">
                    <input type="text" class="form-control form-control-lg" placeholder="Nhập SĐT hoặc IMEI/Serial...">
                    <button type="button" class="btn btn-primary btn-lg px-4 fw-bold" onclick="alert('Tính năng đang được cập nhật!')">KIỂM TRA</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="policy-card card p-4">
                <div class="card-body">
                    <div class="policy-icon"><i class="bi bi-shield-check"></i></div>
                    <h4 class="fw-bold mb-3">1. Điều kiện bảo hành</h4>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm còn trong thời hạn bảo hành.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Hư hỏng do lỗi kỹ thuật của nhà sản xuất.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Sản phẩm còn nguyên tem, không bị tháo mở.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Có phiếu bảo hành hoặc hóa đơn mua hàng.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="policy-card card p-4">
                <div class="card-body">
                    <div class="policy-icon text-danger"><i class="bi bi-x-circle"></i></div>
                    <h4 class="fw-bold mb-3">2. Trường hợp từ chối</h4>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><i class="bi bi-exclamation-circle-fill text-danger me-2"></i> Sản phẩm bị vào nước, ẩm mốc, cháy nổ.</li>
                        <li class="mb-2"><i class="bi bi-exclamation-circle-fill text-danger me-2"></i> Rơi vỡ, móp méo do tác động ngoại lực.</li>
                        <li class="mb-2"><i class="bi bi-exclamation-circle-fill text-danger me-2"></i> Tự ý sửa chữa, can thiệp phần cứng.</li>
                        <li class="mb-2"><i class="bi bi-exclamation-circle-fill text-danger me-2"></i> Mất phiếu bảo hành hoặc tem bị rách.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="policy-card card p-4">
                <div class="card-body">
                    <div class="policy-icon text-warning"><i class="bi bi-clock-history"></i></div>
                    <h4 class="fw-bold mb-3">3. Thời gian xử lý</h4>
                    <p class="text-secondary">
                        Chúng tôi cam kết xử lý bảo hành trong thời gian nhanh nhất để không làm gián đoạn trải nghiệm của quý khách.
                    </p>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Lỗi phần mềm:</span>
                        <span class="fw-bold text-dark">24h - 48h</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Lỗi phần cứng nhẹ:</span>
                        <span class="fw-bold text-dark">3 - 5 ngày</span>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span>Lỗi mainboard/hãng:</span>
                        <span class="fw-bold text-dark">7 - 15 ngày</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="policy-card card p-4">
                <div class="card-body">
                    <div class="policy-icon text-info"><i class="bi bi-arrow-repeat"></i></div>
                    <h4 class="fw-bold mb-3">4. Chính sách đổi trả</h4>
                    <p class="text-secondary">
                        Áp dụng cho các sản phẩm mua mới tại Tech Store gặp lỗi nhà sản xuất.
                    </p>
                    <div class="alert alert-info border-0 mb-0">
                        <h6 class="fw-bold"><i class="bi bi-star-fill text-warning"></i> 1 ĐỔI 1 trong 30 ngày</h6>
                        <small>Nếu máy có lỗi phần cứng từ nhà sản xuất. Máy đổi là máy mới hoặc tương đương.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 p-4 bg-light rounded-3 text-center border">
        <h5 class="fw-bold">Trung tâm bảo hành Tech Store</h5>
        <p class="mb-1"><i class="bi bi-geo-alt-fill text-danger"></i> Z115, Trường ĐH CNTT & TT Thái Nguyên, Thái Nguyên.</p>
        <p class="mb-0"><i class="bi bi-telephone-fill text-success"></i> Tổng đài hỗ trợ: <strong class="text-dark">1900.6789</strong> (8:00 - 21:00)</p>
    </div>

</div>

<?php include 'views/layouts/footer.php'; ?>