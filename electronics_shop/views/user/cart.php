<?php include 'views/layout/header.php'; ?> 

<div class="container my-5">
    <h3 class="fw-bold mb-4 text-uppercase">Giỏ hàng của bạn</h3>
    
    <?php if(empty($cart)): ?>
        <div class="alert alert-warning text-center py-5">
            <i class="bi bi-cart-x fs-1 d-block mb-3"></i>
            <p>Giỏ hàng đang trống!</p>
            <a href="index.php?page=products" class="btn btn-primary">Mua sắm ngay</a>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total_money = 0;
                                foreach($cart as $id => $item): 
                                    $total_item = $item['price'] * $item['qty'];
                                    $total_money += $total_item;
                                    // Xử lý ảnh (nếu là link ngoài hoặc nội bộ)
                                    $img_src = (strpos($item['image'], 'http') !== false) ? $item['image'] : BASE_URL . $item['image'];
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo $img_src; ?>" width="50" class="me-2 rounded border">
                                            <span class="fw-bold text-dark"><?php echo $item['name']; ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo number_format($item['price']); ?>đ</td>
                                    <td>
                                        <input type="number" value="<?php echo $item['qty']; ?>" class="form-control form-control-sm text-center" style="width: 60px;" readonly>
                                    </td>
                                    <td class="fw-bold text-danger"><?php echo number_format($total_item); ?>đ</td>
                                    <td>
                                        <a href="index.php?page=cart_delete&id=<?php echo $id; ?>" class="text-danger" onclick="return confirm('Xóa sản phẩm này?');">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow border-0 bg-light">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Thanh toán</h5>
                        <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                            <span class="fw-bold">Tổng tiền:</span>
                            <span class="fw-bold text-danger fs-4"><?php echo number_format($total_money); ?>đ</span>
                        </div>
                        
                        <form action="index.php?page=checkout" method="POST">
                            <input type="hidden" name="total_money" value="<?php echo $total_money; ?>">
                            
                            <div class="mb-3"><input type="text" name="fullname" class="form-control" placeholder="Họ và tên (*)" required></div>
                            <div class="mb-3"><input type="text" name="phone" class="form-control" placeholder="Số điện thoại (*)" required></div>
                            <div class="mb-3"><input type="email" name="email" class="form-control" placeholder="Email (Nếu có)"></div>
                            <div class="mb-3"><textarea name="address" class="form-control" placeholder="Địa chỉ nhận hàng (*)" required rows="2"></textarea></div>
                            <div class="mb-3"><textarea name="note" class="form-control" placeholder="Ghi chú (Tùy chọn)" rows="2"></textarea></div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-muted">Phương thức thanh toán</label>
                                <div class="form-check p-2 border rounded mb-2 bg-white">
                                    <input class="form-check-input ms-1" type="radio" name="payment_method" id="cod" value="COD" checked>
                                    <label class="form-check-label ms-2 fw-bold" for="cod">
                                        <i class="bi bi-cash-stack text-success"></i> Thanh toán khi nhận hàng (COD)
                                    </label>
                                </div>
                                <div class="form-check p-2 border rounded bg-white opacity-50" title="Bảo trì">
                                    <input class="form-check-input ms-1" type="radio" name="payment_method" id="banking" value="BANKING" disabled>
                                    <label class="form-check-label ms-2" for="banking">
                                        <i class="bi bi-bank"></i> Chuyển khoản <span class="badge bg-warning text-dark" style="font-size: 0.65rem;">-2%</span>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100 fw-bold py-2 shadow-sm">ĐẶT HÀNG NGAY</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'views/layout/footer.php'; ?>