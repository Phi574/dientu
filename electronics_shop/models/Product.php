<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $price;
    public $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Đọc sản phẩm (Read)
    function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Thêm sản phẩm (Create)
    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, price=:price, description=:description";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu (Security)
        $this->name = htmlspecialchars(strip_tags($this->name));
        
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);

        if($stmt->execute()) return true;
        return false;
    }
    
    // Bạn viết tiếp function update() và delete() tương tự...
}
?>