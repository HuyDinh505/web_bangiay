<?php
function check_user($email, $password) {
    // Kết nối cơ sở dữ liệu
    $conn = connectdb();

    // Chuẩn bị câu lệnh SQL để lấy thông tin người dùng
    $sql = "SELECT * FROM nguoidung WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra nếu người dùng tồn tại và mật khẩu khớp
    if ($user && password_verify($password, $user['matkhau'])) {
        return $user;
    } else {
        return null;
    }
}


function add_user($ten, $email, $matkhau, $dienthoai, $diachi, $vaitro) {
    $conn = connectdb();
    $hashed_password = password_hash($matkhau, PASSWORD_DEFAULT);
    $sql = "INSERT INTO nguoidung (ten, email, matkhau, dienthoai, diachi, vaitro) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$ten, $email, $hashed_password, $dienthoai, $diachi, $vaitro]);
    return $stmt->rowCount();
}

function add_user_dk($ten, $email, $matkhau, $dienthoai) {
    $conn = connectdb();
    $hashed_password = password_hash($matkhau, PASSWORD_DEFAULT);
    $sql = "INSERT INTO nguoidung (ten, email, matkhau, dienthoai) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$ten, $email, $hashed_password, $dienthoai]);
    return $stmt->rowCount();
}


function getUsers() {
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT id, ten, email, dienthoai, diachi, vaitro FROM nguoidung");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById($id) {
    $conn = connectdb();
    $sql = "SELECT * FROM nguoidung WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function update_user($id, $ten, $email, $dienthoai, $diachi, $vaitro) {
    $conn = connectdb();
    $sql = "UPDATE nguoidung SET ten = ?, email = ?, dienthoai = ?, diachi = ?, vaitro = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$ten, $email, $dienthoai, $diachi, $vaitro, $id]);
}
function del_user($id) {
    $conn = connectdb();
    
    // Kiểm tra số lượng admin còn lại
    $sql_check = "SELECT COUNT(*) FROM nguoidung WHERE vaitro = 1";
    $stmt_check = $conn->query($sql_check);
    $admin_count = $stmt_check->fetchColumn();

    if ($admin_count > 1 || ($_SESSION['id'] != $id)) {
        $sql = "DELETE FROM nguoidung WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    } else {
        return 0; // Không xóa được admin cuối cùng
    }
}
 
// Hàm lấy thông tin người dùng dựa trên ID người dùng
function get_user_info($user_id) {
    try {
        // Kết nối cơ sở dữ liệu
        $conn = connectdb();
        if (!$conn) {
            throw new Exception("Kết nối cơ sở dữ liệu thất bại.");
        }

        // Câu truy vấn
        $sql = "SELECT * FROM nguoidung WHERE id = :id";
        $stmt = $conn->prepare($sql);

        // Ràng buộc tham số
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

        // Thực thi truy vấn
        $stmt->execute();

        // Lấy dữ liệu
        $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra kết quả và trả về
        return $user_info ?: null; // Trả về null nếu không có dữ liệu
    } catch (Exception $e) {
        // Ghi nhật ký lỗi (log) hoặc xử lý lỗi nếu cần
        error_log("Lỗi trong hàm get_user_info: " . $e->getMessage());
        return null; // Trả về null nếu xảy ra lỗi
    }
}


?>
