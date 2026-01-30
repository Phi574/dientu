<?php
class Product {
    private $conn;
    private $table = "products"; // Tên bảng chuẩn

    public $id;
    public $name;
    public $brand;
    public $category;
    public $price;
    public $discount;
    public $description;
    public $image;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. Lấy tất cả sản phẩm (Mới nhất trước)
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // 2. Lấy 1 sản phẩm theo ID
    public function getOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 3. Lọc sản phẩm & Phân trang (Quan trọng: Dùng cho trang danh sách)
    public function filter($keyword, $category, $brand, $price_range, $sort, $limit = 10, $offset = 0) {
        $sql = "SELECT * FROM " . $this->table . " WHERE 1=1";
        $params = [];

        // Tìm kiếm
        if (!empty($keyword)) {
            $sql .= " AND name LIKE ?";
            $params[] = "%$keyword%";
        }
        // Danh mục
        if (!empty($category)) {
            $sql .= " AND category = ?";
            $params[] = $category;
        }
        // Thương hiệu
        if (!empty($brand)) {
            $sql .= " AND brand = ?";
            $params[] = $brand;
        }
        // Khoảng giá
        if (!empty($price_range)) {
            switch ($price_range) {
                case 'duoi-5tr': $sql .= " AND price < 5000000"; break;
                case '5tr-10tr': $sql .= " AND price BETWEEN 5000000 AND 10000000"; break;
                case '10tr-20tr': $sql .= " AND price BETWEEN 10000000 AND 20000000"; break;
                case 'tren-20tr': $sql .= " AND price > 20000000"; break;
            }
        }

        // Sắp xếp
        if ($sort == 'price_asc') $sql .= " ORDER BY price ASC";
        elseif ($sort == 'price_desc') $sql .= " ORDER BY price DESC";
        else $sql .= " ORDER BY created_at DESC";

        // Phân trang
        $sql .= " LIMIT $limit OFFSET $offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Đếm tổng sản phẩm sau khi lọc (Để ẩn/hiện nút Xem thêm)
    public function countFilter($keyword, $category, $brand, $price_range) {
        $sql = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE 1=1";
        $params = [];

        if (!empty($keyword)) { $sql .= " AND name LIKE ?"; $params[] = "%$keyword%"; }
        if (!empty($category)) { $sql .= " AND category = ?"; $params[] = $category; }
        if (!empty($brand)) { $sql .= " AND brand = ?"; $params[] = $brand; }
        
        if (!empty($price_range)) {
            switch ($price_range) {
                case 'duoi-5tr': $sql .= " AND price < 5000000"; break;
                case '5tr-10tr': $sql .= " AND price BETWEEN 5000000 AND 10000000"; break;
                case '10tr-20tr': $sql .= " AND price BETWEEN 10000000 AND 20000000"; break;
                case 'tren-20tr': $sql .= " AND price > 20000000"; break;
            }
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // 5. Thêm sản phẩm mới
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  SET name=:name, brand=:brand, category=:category, price=:price, 
                      discount=:discount, description=:description, image=:image";
        
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $stmt->execute([
            ':name' => $this->name, ':brand' => $this->brand, ':category' => $this->category,
            ':price' => $this->price, ':discount' => $this->discount, 
            ':description' => $this->description, ':image' => $this->image
        ]);
        return true;
    }

    // 6. Cập nhật sản phẩm
    public function update() {
        $query = "UPDATE " . $this->table . "
                SET name=:name, brand=:brand, category=:category, price=:price,
                    discount=:discount, description=:description, image=:image
                WHERE id=:id";
    
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->category = htmlspecialchars(strip_tags($this->category));

        $stmt->execute([
            ':name' => $this->name, ':brand' => $this->brand, ':category' => $this->category,
            ':price' => $this->price, ':discount' => $this->discount, 
            ':description' => $this->description, ':image' => $this->image, ':id' => $this->id
        ]);
        return true;
    }

    // 7. Xóa sản phẩm
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id]);
    }

    // 8. Các hàm phụ trợ (Gallery, Brands)
    public function getLastId() { return $this->conn->lastInsertId(); }

    public function addGalleryImage($pid, $path) {
        $stmt = $this->conn->prepare("INSERT INTO product_images (product_id, image_path) VALUES (?, ?)");
        $stmt->execute([$pid, $path]);
    }

    public function getGallery($pid) {
        $stmt = $this->conn->prepare("SELECT * FROM product_images WHERE product_id = ?");
        $stmt->execute([$pid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBrands() {
        $query = "SELECT DISTINCT brand FROM " . $this->table . " WHERE brand IS NOT NULL AND brand != '' ORDER BY brand ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>