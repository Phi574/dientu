<?php
require_once 'models/Product.php';

class CartController {
    private $db;
    private $productModel;

    public function __construct($db) {
        $this->db = $db;
        $this->productModel = new Product($db);
    }

    public function index() {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $total_price = 0;
        foreach($cart as $item) {
            $total_price += $item['price'] * $item['qty'];
        }
        include 'views/user/cart.php'; // Giao diện giỏ hàng
    }

    public function add() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $qty = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        
        $this->productModel->id = $id;
        $product = $this->productModel->getOne();

        if ($product) {
            $price = $product['price'] * (1 - ($product['discount']/100)); // Tính giá sau giảm
            
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['qty'] += $qty;
            } else {
                $_SESSION['cart'][$id] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'image' => $product['image'],
                    'price' => $price,
                    'qty' => $qty
                ];
            }
        }
        header("Location: index.php?page=cart");
    }

    public function delete() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        unset($_SESSION['cart'][$id]);
        header("Location: index.php?page=cart");
    }

    // Xử lý ĐẶT HÀNG
    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['cart'])) {
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            $payment_method = $_POST['payment_method']; // COD hoặc BANKING
            
            // Tính tổng tiền
            $total_money = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total_money += $item['price'] * $item['qty'];
            }

            // Lưu vào bảng ORDERS
            $sql = "INSERT INTO orders (fullname, phone, address, email, note, total_money, payment_method, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$fullname, $phone, $address, $email, $note, $total_money, $payment_method]);
            $order_id = $this->db->lastInsertId();

            // Lưu vào bảng ORDER_DETAILS
            $sql_detail = "INSERT INTO order_details (order_id, product_id, price, quantity) VALUES (?, ?, ?, ?)";
            $stmt_detail = $this->db->prepare($sql_detail);
            
            foreach ($_SESSION['cart'] as $item) {
                $stmt_detail->execute([$order_id, $item['id'], $item['price'], $item['qty']]);
            }

            // Xóa giỏ hàng & Thông báo
            unset($_SESSION['cart']);
            echo "<script>alert('Đặt hàng thành công! Mã đơn: #$order_id'); window.location.href='index.php';</script>";
        } else {
            header("Location: index.php?page=cart");
        }
    }
}
?>