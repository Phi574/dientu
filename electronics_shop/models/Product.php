<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $brand;
    public $category; // Mới thêm
    public $price;
    public $discount;
    public $description;
    public $image;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. Lọc sản phẩm theo danh mục (Mới)
    function getByCategory($cat_slug) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE category = :cat ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cat', $cat_slug);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Thêm mới (Cập nhật thêm category)
    function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET name=:name, brand=:brand, category=:category, price=:price, 
                      discount=:discount, description=:description, image=:image";
        
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));

        $stmt->execute([
            ':name' => $this->name, ':brand' => $this->brand, ':category' => $this->category,
            ':price' => $this->price, ':discount' => $this->discount, 
            ':description' => $this->description, ':image' => $this->image
        ]);
        return true;
    }

    // 3. Update (Cập nhật thêm category)
    function update() {
        $query = "UPDATE " . $this->table_name . "
                SET name=:name, brand=:brand, category=:category, price=:price,
                    discount=:discount, description=:description, image=:image
                WHERE id=:id";
    
        $stmt = $this->conn->prepare($query);
        $this->category = htmlspecialchars(strip_tags($this->category)); // Clean

        $stmt->execute([
            ':name' => $this->name, ':brand' => $this->brand, ':category' => $this->category,
            ':price' => $this->price, ':discount' => $this->discount, 
            ':description' => $this->description, ':image' => $this->image, ':id' => $this->id
        ]);
        return true;
    }

    // Các hàm cũ giữ nguyên
    function read() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt;
    }
    function getOne() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1");
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function getLastId() { return $this->conn->lastInsertId(); }
    function addGalleryImage($pid, $path) {
        $stmt = $this->conn->prepare("INSERT INTO product_images (product_id, image_path) VALUES (?, ?)");
        $stmt->execute([$pid, $path]);
    }
    function getGallery($pid) {
        $stmt = $this->conn->prepare("SELECT * FROM product_images WHERE product_id = ?");
        $stmt->execute([$pid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function delete() {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
    function filter($keyword, $category, $brand, $price_range, $sort) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE 1=1"; // 1=1 để dễ nối chuỗi AND
        
        // 1. Tìm kiếm từ khóa
        if (!empty($keyword)) {
            $query .= " AND name LIKE :keyword";
        }
        
        // 2. Lọc danh mục
        if (!empty($category)) {
            $query .= " AND category = :category";
        }
        
        // 3. Lọc thương hiệu
        if (!empty($brand)) {
            $query .= " AND brand = :brand";
        }
        
        // 4. Lọc khoảng giá
        if (!empty($price_range)) {
            switch ($price_range) {
                case 'duoi-5tr': $query .= " AND price < 5000000"; break;
                case '5tr-10tr': $query .= " AND price BETWEEN 5000000 AND 10000000"; break;
                case '10tr-20tr': $query .= " AND price BETWEEN 10000000 AND 20000000"; break;
                case 'tren-20tr': $query .= " AND price > 20000000"; break;
            }
        }

        // 5. Sắp xếp
        if (!empty($sort)) {
            switch ($sort) {
                case 'price_asc': $query .= " ORDER BY price ASC"; break; // Giá tăng dần
                case 'price_desc': $query .= " ORDER BY price DESC"; break; // Giá giảm dần
                case 'newest': $query .= " ORDER BY created_at DESC"; break; // Mới nhất
                default: $query .= " ORDER BY created_at DESC";
            }
        } else {
            $query .= " ORDER BY created_at DESC";
        }

        $stmt = $this->conn->prepare($query);

        // Bind dữ liệu
        if (!empty($keyword)) {
            $key = "%{$keyword}%";
            $stmt->bindParam(':keyword', $key);
        }
        if (!empty($category)) {
            $stmt->bindParam(':category', $category);
        }
        if (!empty($brand)) {
            $stmt->bindParam(':brand', $brand);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Hàm lấy danh sách các Hãng hiện có (để hiện lên bộ lọc)
    function getAllBrands() {
        $query = "SELECT DISTINCT brand FROM " . $this->table_name . " WHERE brand IS NOT NULL AND brand != '' ORDER BY brand ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>