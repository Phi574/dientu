<?php
// controllers/OrderController.php
class OrderController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // 1. Hiển thị danh sách (Có Tìm kiếm & Lọc)
    public function list() {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        // Câu lệnh SQL động
        $sql = "SELECT * FROM orders WHERE 1=1";
        $params = [];

        // Tìm kiếm theo Mã, Tên, SĐT
        if (!empty($keyword)) {
            $sql .= " AND (id LIKE ? OR fullname LIKE ? OR phone LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        // Lọc theo trạng thái
        if ($status !== '') {
            $sql .= " AND status = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/admin/order_list.php';
    }

    // 2. Cập nhật trạng thái
    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
            $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

            if ($order_id > 0) {
                $sql = "UPDATE orders SET status = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$status, $order_id]);
                echo "<script>alert('Cập nhật thành công!'); window.location.href='index.php?page=admin_orders';</script>";
            }
        }
    }

    // 3. Xem chi tiết đơn hàng
    public function detail() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        // Lấy thông tin đơn hàng
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            header("Location: index.php?page=admin_orders");
            exit;
        }

        // Lấy danh sách sản phẩm trong đơn
        $sql_details = "SELECT od.*, p.name, p.image 
                        FROM order_details od 
                        JOIN products p ON od.product_id = p.id 
                        WHERE od.order_id = ?";
        $stmt_details = $this->db->prepare($sql_details);
        $stmt_details->execute([$id]);
        $details = $stmt_details->fetchAll(PDO::FETCH_ASSOC);

        include 'views/admin/order_detail.php';
    }

    // 4. Xóa đơn hàng
    public function delete() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            // Xóa chi tiết trước (Nếu chưa thiết lập CASCADE trong DB)
            $this->db->prepare("DELETE FROM order_details WHERE order_id = ?")->execute([$id]);
            // Xóa đơn hàng
            $stmt = $this->db->prepare("DELETE FROM orders WHERE id = ?");
            
            if ($stmt->execute([$id])) {
                echo "<script>alert('Đã xóa đơn hàng #$id'); window.location.href='index.php?page=admin_orders';</script>";
            } else {
                echo "<script>alert('Lỗi khi xóa!'); window.location.href='index.php?page=admin_orders';</script>";
            }
        }
    }
}
?>