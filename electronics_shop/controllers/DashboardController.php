<?php
// controllers/DashboardController.php
class DashboardController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // 1. Tổng doanh thu (Chỉ tính đơn đã hoàn thành - Status = 4)
        $stmt = $this->db->prepare("SELECT SUM(total_money) as total FROM orders WHERE status = 4");
        $stmt->execute();
        $revenue = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        // 2. Tổng số đơn hàng
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM orders");
        $stmt->execute();
        $total_orders = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        // 3. Tổng số sản phẩm
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM products");
        $stmt->execute();
        $total_products = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        // 4. Đơn hàng mới chờ xử lý (Status = 0 hoặc 1)
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM orders WHERE status IN (0, 1)");
        $stmt->execute();
        $pending_orders = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        // 5. Lấy 5 đơn hàng mới nhất
        $stmt = $this->db->prepare("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");
        $stmt->execute();
        $recent_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Gọi giao diện
        include 'views/admin/dashboard.php';
    }
}
?>