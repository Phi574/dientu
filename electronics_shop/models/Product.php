<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $brand;
    public $price;
    public $discount;
    public $description;
    public $image;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. Lấy thông tin 1 sản phẩm theo ID (Dùng cho trang Sửa)
    function getOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 2. Cập nhật sản phẩm (Update)
    function update() {
        $query = "UPDATE " . $this->table_name . "
                SET
                    name = :name,
                    brand = :brand,
                    price = :price,
                    discount = :discount,
                    description = :description,
                    image = :image
                WHERE
                    id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        // Làm sạch dữ liệu
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->discount = htmlspecialchars(strip_tags($this->discount));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->id = htmlspecialchars(strip_tags($this->id));
    
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":brand", $this->brand);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":id", $this->id);
    
        if($stmt->execute()) return true;
        return false;
    }

    // 3. Lấy danh sách ảnh phụ (Gallery)
    function getGallery($product_id) {
        $query = "SELECT * FROM product_images WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $product_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Các hàm cũ (Create, Read, Delete, AddGallery...)
    function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET name=:name, brand=:brand, price=:price, discount=:discount, 
                      description=:description, image=:image";
        $stmt = $this->conn->prepare($query);
        
        // Bind dữ liệu (viết tắt cho gọn, bạn giữ nguyên logic clean như trên)
        $stmt->execute([
            ':name' => $this->name, ':brand' => $this->brand, ':price' => $this->price,
            ':discount' => $this->discount, ':description' => $this->description, ':image' => $this->image
        ]);
        return true;
    }
    
    function getLastId() { return $this->conn->lastInsertId(); }
    function addGalleryImage($pid, $path) {
        $stmt = $this->conn->prepare("INSERT INTO product_images (product_id, image_path) VALUES (?, ?)");
        $stmt->execute([$pid, $path]);
    }
    function read() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt;
    }
    function delete() {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
}
?>