<?php
// Lấy tất cả các đơn hàng
$donhangs = get_all_orders();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="../../path_to_your_stylesheet.css"> <!-- Đường dẫn tới file CSS của bạn -->
</head>
<body>
<section class="mt-5 pt-5">
    <div class="container-fluid py-5 mb-5 mt-5">
        <h2>Đơn Hàng</h2>
        <div class="row">
            <!-- Mục hiển thị đơn hàng -->
            <div class="col-md-12">
                <h1>Danh sách đơn hàng</h1>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">ID Đơn Hàng</th>
                                <th scope="col">Người Dùng</th>
                                <th scope="col">Ngày Đặt</th>
                                <th scope="col">Tổng Tiền</th>
                                <th scope="col">Trạng Thái</th>
                                <th scope="col">Địa Chỉ</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($donhangs) && count($donhangs) > 0) {
                                $i = 1;
                                foreach ($donhangs as $donhang) {
                                    echo '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$donhang['id'].'</td>
                                            <td>'.$donhang['nguoidung_id'].'</td>
                                            <td>'.$donhang['ngaydat'].'</td>
                                            <td>'.$donhang['tongtien'].'</td>
                                            <td>'.$donhang['trangthai'].'</td>
                                            <td>'.$donhang['diachi'].'</td>
                                            <td><a href="index.php?act=chitietdonhang&id='.$donhang['id'].'" class="btn btn-info btn-sm">Xem</a></td>
                                        </tr>';
                                    $i++; // Tăng giá trị của $i sau mỗi vòng lặp
                                }
                            } else {
                                echo '<tr><td colspan="8" class="text-center">Không có đơn hàng nào.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
