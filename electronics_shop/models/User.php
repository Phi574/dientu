<?php
class User {
    private $conn;
    private $table = "users";

    public $id;
    public $username;
    public $password;
    public $full_name;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm Login: Kiểm tra Username và Password
    public function login($username, $password) {
        // 1. Tìm user theo username
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // 2. Nếu tìm thấy user
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // 3. Kiểm tra mật khẩu (hỗ trợ cả Hash và Text thường)
            if (password_verify($password, $row['password'])) {
                // Mật khẩu hash đúng
                $this->fillData($row);
                return true;
            } elseif ($row['password'] === $password) {
                // Mật khẩu thường đúng (dành cho tk test 123456 chưa hash)
                $this->fillData($row);
                return true;
            }
        }
        return false;
    }

    // Hàm hỗ trợ điền dữ liệu vào object
    private function fillData($row) {
        $this->id = $row['id'];
        $this->username = $row['username'];
        $this->role = $row['role'];
        $this->full_name = $row['full_name'];
    }
}
?>