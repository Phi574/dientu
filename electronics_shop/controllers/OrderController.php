<?php
class OrderController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function list() {
        // Lấy danh sách đơn hàng
        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/admin/order_list.php';
    }

    public function updateStatus() {
        if(isset($_POST['order_id']) && isset($_POST['status'])) {
            $sql = "UPDATE orders SET status = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$_POST['status'], $_POST['order_id']]);
            header("Location: index.php?page=admin_orders");
        }
    }
}
?>