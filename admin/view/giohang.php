<section class="mt-5 pt-5">
<!-- Single Page Header start -->
    <div class="container-fluid  py-5">
      <h1 class="text-center text-white display-6">Giỏ hàng</h1>
      <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Giỏ hàng</li>
      </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
      <div class="container py-5">
        <div class="table-responsive">
        <?php
        $tongdonhang = 0; // Khởi tạo tổng đơn hàng
        if(isset($_SESSION['giohang']) && (count($_SESSION['giohang'])) > 0){
            echo '<table class="table">
            <thead>
              <tr>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Tên</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Thao tác</th>
              </tr>
            </thead>
            <tbody>';
            foreach($_SESSION['giohang'] as $index => $item) {
              list($id, $hinh, $loaisanpham, $tensp, $gia, $soluong) = $item; // Gán các giá trị từ mảng item vào các biến tương ứng
              $tonggia = $gia * $soluong; // Tính tổng giá cho sản phẩm
              $tongdonhang += $tonggia; // Cộng dồn tổng giá vào tổng đơn hàng
              echo '
                <tr>
                  <th scope="row">
                    <div class="d-flex align-items-center">
                      <img
                        src="uploads/'.$hinh.'"
                        class="img-fluid me-5 rounded-circle"
                        style="width: 80px; height: 80px"
                        alt=""
                      />
                    </div>
                  </th>
                  <td>
                    <p class="mb-0 mt-4">'.$tensp.'</p>
                  </td>
                  <td>
                    <p class="mb-0 mt-4">'.$gia.' VNĐ</p>
                  </td>
                  <td>
                    <div class="input-group quantity mt-4" style="width: 100px">
                      <div class="input-group-btn">
                        <button
                          class="btn btn-sm btn-minus rounded-circle bg-light border"
                          onclick="updateQuantity('.$index.', '.$gia.', -1)"
                        >
                          <i class="fa fa-minus"></i>
                        </button>
                      </div>
                      <input
                        type="text"
                        class="form-control form-control-sm text-center border-0"
                        value="'.$soluong.'"
                        id="quantity-'.$index.'"
                        readonly
                      />
                      <div class="input-group-btn">
                        <button
                          class="btn btn-sm btn-plus rounded-circle bg-light border"
                          onclick="updateQuantity('.$index.', '.$gia.', 1)"
                        >
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0 mt-4" id="total-'.$index.'">'.$tonggia.' VNĐ</p>
                  </td>
                  <td>
                    <a href="index.php?act=delhang&index='.$index.'" class="btn btn-danger">Xóa</a>
                  </td>
                </tr>';
            }
            echo '</tbody>
            </table>';
        } else {
            echo '<p>Giỏ hàng của bạn đang trống.</p>';
        }
        ?>
        </div>
        <div class="mt-5">
          <input
            type="text"
            class="border-0 border-bottom rounded me-5 py-3 mb-4"
            placeholder="Coupon Code"
          />
          <button
            class="btn border-secondary rounded-pill px-4 py-3 text-primary"
            type="button"
          >
            Apply Coupon
          </button>
        </div>
        <div class="row g-4 justify-content-end">
          <div class="col-8"></div>
          <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
            <div class="bg-light rounded">
              <div class="p-4">
                <h1 class="display-6 mb-4">
                  Đơn hàng <span class="fw-normal">Tổng</span>
                </h1>
                <div class="d-flex justify-content-between mb-4">
                  <h5 class="mb-0 me-4">Tổng cộng:</h5>
                  <p class="mb-0"><?= number_format($tongdonhang, 0) ?> VNĐ</p>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="mb-0 me-4">Phí ship</h5>
                  <div class="">
                    <p class="mb-0">Giá cố định: 50,000 VNĐ</p>
                  </div>
                </div>
              </div>
              <div
                class="py-4 mb-4 border-top border-bottom d-flex justify-content-between"
              >
                <h5 class="mb-0 ps-4 me-4">Tổng</h5>
                <p class="mb-0 pe-4"><?= number_format($tongdonhang + 50000, 0) ?> VNĐ</p>
              </div>
              <form action="index.php?act=thanh_toan" method="post">
    <div class="mb-3">
        <label for="diachi" class="form-label">Địa chỉ giao hàng</label>
        <input type="text" class="form-control" id="diachi" name="diachi" required>
    </div>
    <button
        class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
        type="submit"
    >
        Thanh toán
    </button>
</form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Cart Page End -->

</section>



    <script>
function updateQuantity(id, price, change) {
    var quantityInput = document.getElementById('quantity-' + id);
    var totalPriceElement = document.getElementById('total-' + id);
    var currentQuantity = parseInt(quantityInput.value);
    var newQuantity = currentQuantity + change;

    if (newQuantity >= 0) {
        quantityInput.value = newQuantity;

        var newTotalPrice = newQuantity * price;
        totalPriceElement.innerText = newTotalPrice + ' VNĐ';

        // Optionally, you can make an AJAX call here to update the quantity in the session
        // Example:
        // $.post('update_quantity.php', {id: id, quantity: newQuantity, price: price}, function(data){
        //     // handle response if needed
        // });
    }
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Your JavaScript code
});
</script>
