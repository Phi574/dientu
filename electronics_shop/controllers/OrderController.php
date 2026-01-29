<?php
// controllers/OrderController.php
class OrderController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Hiển thị danh sách đơn hàng
    public function list() {
        // Lấy tất cả đơn hàng, sắp xếp mới nhất lên đầu
        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Gọi giao diện
        include 'views/admin/order_list.php';
    }

    // Xử lý cập nhật trạng thái
    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
            $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

            if ($order_id > 0) {
                $sql = "UPDATE orders SET status = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                
                if ($stmt->execute([$status, $order_id])) {
                    echo "<script>alert('Cập nhật trạng thái thành công!'); window.location.href='index.php?page=admin_orders';</script>";
                } else {
                    echo "<script>alert('Lỗi cập nhật!'); window.location.href='index.php?page=admin_orders';</script>";
                }
            }
        }
    }
    // (Nâng cao) Xem chi tiết đơn hàng - Sẽ làm ở bước sau nếu cần
    public function detail() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        // Code lấy chi tiết đơn hàng...
    }
}
?>