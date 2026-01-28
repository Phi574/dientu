<?php
// models/User.php
class User {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm chỉ lấy thông tin user, chưa kiểm tra pass vội
    public function getUserByUsername($username) {
        // Sử dụng PDO prepare để chống Hack SQL Injection (khắc phục điểm yếu của code mẫu)
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về mảng dữ liệu user hoặc false
    }
}
?>