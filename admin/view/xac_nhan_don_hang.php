<?php
session_start();
include 'model/connectdb.php';
include 'model/order.php';

// Lấy ID đơn hàng từ query string
$hoadon_id = isset($_GET['hoadon_id']) ? intval($_GET['hoadon_id']) : 0;

// Lấy thông tin đơn hàng từ cơ sở dữ liệu
$order = getOrderById($hoadon_id);

if ($order) {
    echo "<h1>Xác nhận đơn hàng</h1>";
    echo "<p>Cảm ơn bạn đã đặt hàng. Mã đơn hàng của bạn là: " . $order['id'] . "</p>";
    echo "<p>Địa chỉ giao hàng: " . htmlspecialchars($order['diachi']) . "</p>";
    echo "<p>Tổng số tiền: " . number_format($order['tongtien'], 0) . " VNĐ</p>";
} else {
    echo "<p>Không tìm thấy đơn hàng.</p>";
}
?>

<a href="index.php">Quay lại trang chủ</a>
