<?php
session_start();
ob_start();
include "../model/connectdb.php";
include "../model/user.php";
include "../model/donhang.php";
$conn = connectdb();

if (isset($_POST['register']) && ($_POST['register'])) {
    $ten = $_POST['ten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $matkhau = $_POST['matkhau'];
    $matkhau2 = $_POST['matkhau2'];

    if ($matkhau == $matkhau2) {
        // Kiểm tra xem email đã tồn tại chưa
        $stmt = $conn->prepare("SELECT * FROM nguoidung WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $txt_error = "Email đã tồn tại. Vui lòng sử dụng email khác.";
        } else {
            // Thêm người dùng mới và mã hóa mật khẩu
            $result = add_user_dk($ten, $email, $matkhau, $dienthoai);

            if ($result > 0) {
                $_SESSION['vaitro'] = 0;
                $_SESSION['ten'] = $ten;
                header('Location: ../index.php');
                exit();
            } else {
                $txt_error = "Lỗi khi thêm người dùng mới.";
            }
        }
    } else {
        $txt_error = "Mật khẩu không khớp.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FootFusion - Thoải mái và thời trang</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/style.css">
</head>
<body>
<header>
    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3">
                        <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                        <a href="#" class="text-white">617 An Chu, Bắc Sơn, Trảng Bom, Đồng Nai</a>
                    </small>
                    <small class="me-3">
                        <i class="fas fa-envelope me-2 text-secondary"></i>
                        <a href="#" class="text-white">zhuy105503@gmail.com</a>
                    </small>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="../index.php" class="navbar-brand">
                    <h1 class="text-primary display-6">FootFusion</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="../index.php" class="nav-item nav-link active">Trang chủ</a>
                        <a href="../index.php?act=shop" class="nav-item nav-link">Cửa hàng</a>
                        <a href="../index.php?act=giohang" class="nav-item nav-link">Đặt hàng</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Trang</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="../index.php?act=chackout" class="dropdown-item">Thanh toán</a>
                                <a href="../index.php?act=danhgia" class="dropdown-item">Đánh giá</a>
                            </div>
                        </div>
                        <a href="../index.php?act=lienhe" class="nav-item nav-link">Liên hệ</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search text-primary"></i>
                        </button>
                        <a href="../index.php?act=giohang" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px">
                                <?= isset($_SESSION['user_id']) ? get_cart_quantity() : '0' ?>
                            </span>
                        </a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="login.php" class="dropdown-item">Đăng nhập</a>
                                <a href="register.php" class="dropdown-item">Đăng ký</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tìm kiếm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->
</header>
    <section style="margin-top: 15%;">
      <div
        class="container-fluid1 d-flex justify-content-center align-items-center"
      >
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <h1 class="text-center">ĐĂNG KÝ TÀI KHOẢN</h1>
          <div class="mb-3">
            <label for="ten" class="form-label">Tên</label>
            <input
            name="ten"
              class="form-control"
              type="text"
              id="ten"
              placeholder="Nhập tên"
            />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
            name="email"
              class="form-control"
              type="email"
              id="email"
              placeholder="Nhập email"
            />
          </div>
          <div class="mb-3">
            <label for="dienthoai" class="form-label">Số điện thoại</label>
            <input
            name="dienthoai"
              class="form-control"
              type="text"
              id="dienthoai"
              placeholder="Nhập số điện thoại"
            />
          </div>
          <div class="mb-3">
            <label for="matkhau" class="form-label">Mật khẩu</label>
            <input
              name="matkhau"
              class="form-control"
              type="password"
              id="matkhau"
              placeholder="Nhập mật khẩu"
            />
          </div>
          <div class="mb-3">
            <label for="matkhau2" class="form-label">Xác nhận mật khẩu</label>
            <input
              name="matkhau2"
              class="form-control"
              type="password"
              id="matkhau2"
              placeholder="Nhập lại mật khẩu"
            />
          </div>
          <div>
            <input type="submit" class="btn btn-success" style="width: 100%" name="register" value="Đăng ký">
          </div>
          <?php
            if(isset($txt_error) && $txt_error != ""){
              echo "<font color='red'>".$txt_error."</font>";
            }
          ?>
          <p class="text-center mt-2">
            Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a>
          </p>
        </form>
      </div>
    </section>
    <!-- Footer Start -->
    <footer>
      <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
          <div
            class="pb-4 mb-4"
            style="border-bottom: 1px solid rgba(226, 175, 24, 0.5)"
          >
            <div class="row g-4">
              <div class="col-lg-3">
                <a href="#">
                  <h1 class="text-primary mb-0">FootFusion</h1>
                </a>
              </div>
              <div class="col-lg-6">
                <div class="position-relative mx-auto">
                  <input
                    class="form-control border-0 w-100 py-3 px-4 rounded-pill"
                    type="number"
                    placeholder="Your Email"
                  />
                  <button
                    type="submit"
                    class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white"
                    style="top: 0; right: 0"
                  >
                    Subscribe Now
                  </button>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="d-flex justify-content-end pt-3">
                  <a
                    class="btn btn-outline-secondary me-2 btn-md-square rounded-circle"
                    href=""
                    ><i class="fab fa-twitter"></i
                  ></a>
                  <a
                    class="btn btn-outline-secondary me-2 btn-md-square rounded-circle"
                    href=""
                    ><i class="fab fa-facebook-f"></i
                  ></a>
                  <a
                    class="btn btn-outline-secondary me-2 btn-md-square rounded-circle"
                    href=""
                    ><i class="fab fa-youtube"></i
                  ></a>
                  <a
                    class="btn btn-outline-secondary btn-md-square rounded-circle"
                    href=""
                    ><i class="fab fa-linkedin-in"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
          <div class="row g-5">
            <div class="col-lg-3 col-md-6">
              <div class="footer-item">
                <h4 class="text-light mb-3">Why People Like us!</h4>
                <p class="mb-4">
                  typesetting, remaining essentially unchanged. It was
                  popularised in the 1960s with the like Aldus PageMaker
                  including of Lorem Ipsum.
                </p>
                <a
                  href=""
                  class="btn border-secondary py-2 px-4 rounded-pill text-primary"
                  >Read More</a
                >
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="d-flex flex-column text-start footer-item">
                <h4 class="text-light mb-3">Thông tin cửa hàng</h4>
                <a class="btn-link" href="">Giới thiệu</a>
                <a class="btn-link" href="">Liên hệ với chúng tôi</a>
                <a class="btn-link" href="">Chính sách bảo mật</a>
                <a class="btn-link" href="">Điều khoản & Điều kiện</a>
                <a class="btn-link" href="">Chính sách trả hàng</a>
                <a class="btn-link" href="">Câu hỏi thường gặp và Trợ giúp</a>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="d-flex flex-column text-start footer-item">
                <h4 class="text-light mb-3">Tài khoản</h4>
                <a class="btn-link" href="">Tài khoản của tôi</a>
                <a class="btn-link" href="">Chi tiết cửa hàng</a>
                <a class="btn-link" href="">Giỏ hàng</a>
                <a class="btn-link" href="">Danh sách mong muốn</a>
                <a class="btn-link" href="">Lịch sử đơn hàng</a>
                <a class="btn-link" href="">Đơn hàng quốc tế</a>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="footer-item">
                <h4 class="text-light mb-3">Liên hệ</h4>
                <p>Địa chỉ: 617 An Chu, Bắc Sơn, Trảng Bom, Đồng Nai</p>
                <p>Email: zhuy105503@gmail.com</p>
                <p>Phone: +8438 930 9628</p>
                <p>Chấp nhận thanh toán</p>
                <img src="img/payment.png" class="img-fluid" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
  </body>
</html>
