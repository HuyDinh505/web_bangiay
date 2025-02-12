<?php
function add_order($nguoidung_id, $tongtien, $diachi) {
    $conn = connectdb(); // Kết nối cơ sở dữ liệu
    $sql = "INSERT INTO donhang (nguoidung_id, ngaydat, tongtien, trangthai, diachi) VALUES (:nguoidung_id, NOW(), :tongtien, 'pending', :diachi)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nguoidung_id', $nguoidung_id);
    $stmt->bindParam(':tongtien', $tongtien);
    $stmt->bindParam(':diachi', $diachi);
    $stmt->execute();
    return $conn->lastInsertId(); // Trả về ID của đơn hàng vừa thêm
}

function add_order_details($hoadon_id, $sanpham_id, $soluong, $giatien) {
    $conn = connectdb(); // Kết nối cơ sở dữ liệu
    $sql = "INSERT INTO chitietdonhang (hoadon_id, sanpham_id, soluong, giatien) VALUES (:hoadon_id, :sanpham_id, :soluong, :giatien)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':hoadon_id', $hoadon_id);
    $stmt->bindParam(':sanpham_id', $sanpham_id);
    $stmt->bindParam(':soluong', $soluong);
    $stmt->bindParam(':giatien', $giatien);
    $stmt->execute();
}

function get_all_orders() {
    $conn = connectdb(); // Kết nối cơ sở dữ liệu
    $sql = "SELECT * FROM donhang";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_order($id) {
    $conn = connectdb(); // Kết nối cơ sở dữ liệu
    $sql = "SELECT * FROM donhang WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_order_details($hoadon_id) {
    $conn = connectdb(); // Kết nối cơ sở dữ liệu
    $sql = "SELECT ct.*, sp.tensanpham, hs.hinhanh 
            FROM chitietdonhang ct
            JOIN sanpham sp ON ct.sanpham_id = sp.id
            JOIN hinhanh_sanpham hs ON sp.id = hs.sanpham_id
            WHERE ct.hoadon_id = :hoadon_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':hoadon_id', $hoadon_id);
    $stmt->execute();
    $order_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Kiểm tra xem $order_details có phải là một mảng không
    if (is_array($order_details)) {
        return $order_details;
    } else {
        // Xử lý trường hợp không phải là mảng, có thể trả về một mảng trống
        return [];
    }
}

function get_cart_quantity() {
    if (isset($_SESSION['giohang']) && is_array($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
        $uniqueProducts = [];
        foreach ($_SESSION['giohang'] as $item) {
            if (is_array($item) && isset($item[0]) && !in_array($item[0], $uniqueProducts)) {
                $uniqueProducts[] = $item[0]; // Giả sử $item[0] là ID của sản phẩm
            }
        }
        return count($uniqueProducts);
    }
    return 0;
}

function getOrderById($hoadon_id) {
    $conn = connectdb();
    $sql = "SELECT * FROM donhang WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$hoadon_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra xem $order có phải là một mảng không
    if (is_array($order)) {
       
 return $order;
    } else {
        // Xử lý trường hợp không phải là mảng, có thể trả về một mảng trống hoặc giá trị null
        return null;
    }
}

?>
