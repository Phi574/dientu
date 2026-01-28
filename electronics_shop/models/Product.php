<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $price;
    public $description;
    public $image; // Thêm thuộc tính ảnh

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. Đọc danh sách sản phẩm (Read)
    function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // 2. Thêm sản phẩm mới (Create)
    function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET name=:name, price=:price, description=:description, image=:image";
        
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 3. XÓA SẢN PHẨM (Delete) - Đây là hàm bạn đang thiếu
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Làm sạch ID
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Gán ID
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 4. CẬP NHẬT SẢN PHẨM (Update) - Dùng khi bạn làm tính năng Sửa
    function update() {
        $query = "UPDATE " . $this->table_name . "
                SET
                    name = :name,
                    price = :price,
                    description = :description,
                    image = :image
                WHERE
                    id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        // Làm sạch dữ liệu
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->id = htmlspecialchars(strip_tags($this->id));
    
        // Gán dữ liệu
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":id", $this->id);
    
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>