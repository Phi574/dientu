<?php
class User {
    private $conn;
    private $table = "users";

    public $id;
    public $username;
    public $role;
    public $full_name;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm kiểm tra đăng nhập
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Kiểm tra mật khẩu đã mã hóa (password_verify)
            if (password_verify($password, $row['password'])) {
                // Lưu thông tin vào object
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->role = $row['role'];
                $this->full_name = $row['full_name'];
                return true;
            }
        }
        return false;
    }
}
?>