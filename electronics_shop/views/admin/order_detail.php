<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng #<?php echo $order['id']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="index.php?page=admin_orders" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
        <h3 class="fw-bold text-primary">CHI TIẾT ĐƠN HÀNG #<?php echo $order['id']; ?></h3>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white fw-bold">Thông tin khách hàng</div>
                <div class="card-body">
                    <p class="mb-1"><strong>Họ tên:</strong> <?php echo $order['fullname']; ?></p>
                    <p class="mb-1"><strong>Điện thoại:</strong> <?php echo $order['phone']; ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?php echo $order['email']; ?></p>
                    <p class="mb-1"><strong>Địa chỉ:</strong> <?php echo $order['address']; ?></p>
                    <p class="mb-0 text-muted fst-italic"><strong>Ghi chú:</strong> <?php echo $order['note']; ?></p>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Trạng thái đơn hàng</div>
                <div class="card-body">
                    <p>Ngày đặt: <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
                    <p>Thanh toán: <span class="badge bg-secondary"><?php echo $order['payment_method']; ?></span></p>
                    
                    <form action="index.php?page=admin_order_update" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                        <label class="form-label fw-bold">Cập nhật trạng thái:</label>
                        <select name="status" class="form-select mb-2">
                            <option value="0" <?php echo $order['status']==0?'selected':''; ?>>Mới đặt</option>
                            <option value="1" <?php echo $order['status']==1?'selected':''; ?>>Đang xử lý</option>
                            <option value="2" <?php echo $order['status']==2?'selected':''; ?>>Đang đóng gói</option>
                            <option value="3" <?php echo $order['status']==3?'selected':''; ?>>Đang vận chuyển</option>
                            <option value="4" <?php echo $order['status']==4?'selected':''; ?>>Hoàn thành</option>
                            <option value="5" <?php echo $order['status']==5?'selected':''; ?>>Hủy đơn</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Danh sách sản phẩm</div>
                <div class="card-body p-0">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center">SL</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($details as $item): 
                                $img_src = (strpos($item['image'], 'http') !== false) ? $item['image'] : BASE_URL . $item['image'];
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $img_src; ?>" width="50" class="rounded me-2">
                                        <span><?php echo $item['name']; ?></span>
                                    </div>
                                </td>
                                <td class="text-center"><?php echo $item['quantity']; ?></td>
                                <td class="text-end"><?php echo number_format($item['price']); ?>đ</td>
                                <td class="text-end fw-bold"><?php echo number_format($item['price'] * $item['quantity']); ?>đ</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                                <td class="text-end fw-bold text-danger fs-5"><?php echo number_format($order['total_money']); ?>đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>