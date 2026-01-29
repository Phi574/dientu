<div class="container-fluid py-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-receipt"></i> QUẢN LÝ ĐƠN HÀNG</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light text-uppercase small fw-bold">
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $status_map = [
                        0 => ['text' => 'Mới đặt', 'class' => 'bg-secondary'],
                        1 => ['text' => 'Đang xử lý', 'class' => 'bg-info'],
                        2 => ['text' => 'Đang đóng gói', 'class' => 'bg-warning text-dark'],
                        3 => ['text' => 'Đang vận chuyển', 'class' => 'bg-primary'],
                        4 => ['text' => 'Đã giao thành công', 'class' => 'bg-success'],
                        5 => ['text' => 'Đơn hoàn/Hủy', 'class' => 'bg-danger']
                    ];
                    foreach($orders as $o): ?>
                    <tr>
                        <td class="fw-bold">#<?php echo $o['id']; ?></td>
                        <td>
                            <div class="fw-bold"><?php echo $o['fullname']; ?></div>
                            <small class="text-muted"><?php echo $o['phone']; ?></small>
                        </td>
                        <td class="fw-bold text-danger"><?php echo number_format($o['total_money']); ?>đ</td>
                        <td><?php echo date('d/m/Y H:i', strtotime($o['created_at'])); ?></td>
                        <td>
                            <span class="badge <?php echo $status_map[$o['status']]['class']; ?>">
                                <?php echo $status_map[$o['status']]['text']; ?>
                            </span>
                        </td>
                        <td>
                            <form action="index.php?page=admin_order_update" method="POST" class="d-flex gap-2">
                                <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                <select name="status" class="form-select form-select-sm" style="width: 130px;" onchange="this.form.submit()">
                                    <option value="0" <?php echo $o['status']==0?'selected':''; ?>>Mới đặt</option>
                                    <option value="1" <?php echo $o['status']==1?'selected':''; ?>>Đang xử lý</option>
                                    <option value="2" <?php echo $o['status']==2?'selected':''; ?>>Đóng gói</option>
                                    <option value="3" <?php echo $o['status']==3?'selected':''; ?>>Vận chuyển</option>
                                    <option value="4" <?php echo $o['status']==4?'selected':''; ?>>Hoàn thành</option>
                                    <option value="5" <?php echo $o['status']==5?'selected':''; ?>>Hủy/Hoàn</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>