<div class="container-fluid py-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-receipt"></i> QUẢN LÝ ĐƠN HÀNG</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-light text-uppercase small fw-bold">
                        <tr>
                            <th scope="col">Mã Đơn</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col" style="min-width: 160px;">Trạng thái hiện tại</th>
                            <th scope="col" style="min-width: 200px;">Cập nhật xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // MẢNG TRẠNG THÁI (Đúng yêu cầu của bạn)
                        $status_map = [
                            0 => ['label' => 'Đơn đặt hàng',        'class' => 'bg-secondary', 'icon' => 'bi-stars'],
                            1 => ['label' => 'Đang xử lý',          'class' => 'bg-info text-dark',      'icon' => 'bi-headset'],
                            2 => ['label' => 'Đang đóng gói',       'class' => 'bg-warning text-dark', 'icon' => 'bi-box-seam'],
                            3 => ['label' => 'Đang vận chuyển',     'class' => 'bg-primary',   'icon' => 'bi-truck'],
                            4 => ['label' => 'Đã lấy hàng',         'class' => 'bg-success',   'icon' => 'bi-check-circle'],
                            5 => ['label' => 'Đơn hoàn hàng',       'class' => 'bg-danger',    'icon' => 'bi-arrow-return-left']
                        ];
                        
                        if (empty($orders)): ?>
                            <tr><td colspan="6" class="text-center py-4">Chưa có đơn hàng nào!</td></tr>
                        <?php else: foreach($orders as $o): 
                            $stt = isset($status_map[$o['status']]) ? $status_map[$o['status']] : $status_map[0];
                        ?>
                        <tr>
                            <td class="fw-bold text-primary">#<?php echo $o['id']; ?></td>
                            
                            <td>
                                <div class="fw-bold"><?php echo $o['fullname']; ?></div>
                                <div class="small text-muted"><i class="bi bi-telephone"></i> <?php echo $o['phone']; ?></div>
                                <div class="small text-muted text-truncate" style="max-width: 200px;" title="<?php echo $o['address']; ?>">
                                    <i class="bi bi-geo-alt"></i> <?php echo $o['address']; ?>
                                </div>
                            </td>
                            
                            <td class="fw-bold text-danger"><?php echo number_format($o['total_money']); ?>đ</td>
                            
                            <td class="small"><?php echo date('d/m/Y H:i', strtotime($o['created_at'])); ?></td>
                            
                            <td>
                                <span class="badge rounded-pill <?php echo $stt['class']; ?> p-2">
                                    <i class="bi <?php echo $stt['icon']; ?>"></i> <?php echo $stt['label']; ?>
                                </span>
                            </td>
                            
                            <td>
                                <form action="index.php?page=admin_order_update" method="POST" class="d-flex gap-2">
                                    <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                    <select name="status" class="form-select form-select-sm fw-bold border-primary" onchange="if(confirm('Bạn chắc chắn muốn đổi trạng thái?')) this.form.submit()">
                                        <option value="0" <?php echo $o['status']==0?'selected':''; ?>>0. Mới đặt</option>
                                        <option value="1" <?php echo $o['status']==1?'selected':''; ?>>1. Đang xử lý (Liên hệ)</option>
                                        <option value="2" <?php echo $o['status']==2?'selected':''; ?>>2. Đang đóng gói</option>
                                        <option value="3" <?php echo $o['status']==3?'selected':''; ?>>3. Đang vận chuyển</option>
                                        <option value="4" <?php echo $o['status']==4?'selected':''; ?>>4. Đã lấy hàng (Thành công)</option>
                                        <option value="5" <?php echo $o['status']==5?'selected':''; ?>>5. Đơn hoàn hàng (Lỗi)</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>