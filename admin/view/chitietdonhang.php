<?php

// Lấy thông tin chi tiết đơn hàng
if (isset($_GET['id']) && ($_GET['id'] > 0)) {
    $hoadon_id = $_GET['id'];
    $donhang = get_order($hoadon_id);
    $chitietdonhang = get_order_details($hoadon_id);
} else {
    echo 'Không tìm thấy thông tin đơn hàng.';
    exit;
}
?>
<section class="mt-5 pt-5">
    <!-- Order Details Page Start -->
    <div class="container-fluid py-5 mb-5 mt-5">
        <h2>Chi Tiết Đơn Hàng</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($chitietdonhang) && count($chitietdonhang) > 0) {
                                foreach ($chitietdonhang as $item) {
                                    echo '<tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="uploads/'.$item['hinhanh'].'" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px" alt="Hình ảnh sản phẩm">
                                                </div>
                                            </td>
                                            <td>'.$item['tensanpham'].'</td>
                                            <td>'.number_format($item['giatien'], 0).' VNĐ</td>
                                            <td>'.$item['soluong'].'</td>
                                            <td>'.number_format($item['giatien'] * $item['soluong'], 0).' VNĐ</td>
                                        </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center">Không có chi tiết đơn hàng nào.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">
                            Đơn hàng <span class="fw-normal">Tổng</span>
                        </h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Tổng cộng:</h5>
                            <p class="mb-0"><?= number_format($donhang['tongtien'], 0) ?> VNĐ</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Phí ship</h5>
                            <div class="">
                                <p class="mb-0">Giá cố định: 50,000 VNĐ</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Tổng</h5>
                        <p class="mb-0 pe-4"><?= number_format($donhang['tongtien'] + 50000, 0) ?> VNĐ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Details Page End -->
</section>
