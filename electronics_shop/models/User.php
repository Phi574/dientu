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

    // Hàm Login chuẩn (Học theo logic của thuctapsinhdoi)
    public function login($username, $password) {
        // 1. Lấy thông tin user từ DB (Lấy hết các dòng trùng tên)
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // 2. Duyệt qua từng tài khoản tìm thấy (để tránh trường hợp LIMIT 1 trúng tài khoản rác)
        while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $is_success = false;

            // KIỂM TRA 3 LỚP BẢO MẬT (Giống file auth.php của bạn)
            
            // Cách 1: Mật khẩu chuẩn Bcrypt (Mới)
            if (password_verify($password, $user['password'])) {
                $is_success = true;
            } 
            // Cách 2: Mật khẩu MD5 (Cũ)
            elseif ($user['password'] === md5($password)) {
                $is_success = true;
            }
            // Cách 3: Mật khẩu thô (Test)
            elseif ($user['password'] === $password) {
                $is_success = true;
            }

            // Nếu đúng 1 trong 3 cách -> Đăng nhập thành công
            if ($is_success) {
                $this->fillData($user);
                return true;
            }
        }

        // Duyệt hết mà không cái nào đúng
        return false;
    }

    // Hàm hỗ trợ điền dữ liệu
    private function fillData($row) {
        $this->id = $row['id'];
        $this->username = $row['username'];
        $this->role = $row['role']; // Quan trọng: lấy đúng quyền hạn
        $this->full_name = $row['full_name'];
    }
}
?>