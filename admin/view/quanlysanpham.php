<?php
session_start();
ob_start();
include_once "../model/connectdb.php";
include_once "../model/danhmuc.php";
?>
<!DOCTYPE html>
<html lang="en">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FootFusion-thoải mái và thời trang</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
<link href="../../lib/lightbox/css/lightbox.min.css" rel="stylesheet" />
<link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

<!-- Customized Bootstrap Stylesheet -->
<link href="../../css/bootstrap.min.css" rel="stylesheet" />

<!-- Template Stylesheet -->
<link href="../../css/style.css" rel="stylesheet" />
<link rel="stylesheet" href="./style.css">

  </head>
  <body>
    <header>
      <!-- Navbar start -->
      <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
          <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
              <small class="me-3"
                ><i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                <a href="#" class="text-white"
                  >617 An Chu, Bắc Sơn, Trảng Bom, Đồng Nai</a
                ></small
              >
              <small class="me-3"
                ><i class="fas fa-envelope me-2 text-secondary"></i
                ><a href="#" class="text-white">zhuy105503@gmail.com</a></small
              >
            </div>
            <div class="top-link pe-2">
              <a href="#" class="text-white"
                ><small class="text-white mx-2">Privacy Policy</small>/</a
              >
              <a href="#" class="text-white"
                ><small class="text-white mx-2">Terms of Use</small>/</a
              >
              <a href="#" class="text-white"
                ><small class="text-white ms-2">Sales and Refunds</small></a
              >
            </div>
          </div>
        </div>
        <div class="container px-0">
          <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="index.html" class="navbar-brand"
              ><h1 class="text-primary display-6">FootFusion</h1></a
            >
            <button
              class="navbar-toggler py-2 px-3"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarCollapse"
            >
              <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
              <div class="navbar-nav mx-auto">
                <a href="index.php" class="nav-item nav-link active"
                  >Trang chủ</a
                >
                <a href="index.php?act=cuahang" class="nav-item nav-link">Cửa hàng</a>
                <a href="index.php?act=chitietsanpham" class="nav-item nav-link"
                  >Chi tiết sản phẩm</a
                >
                <div class="nav-item dropdown">
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    >Trang</a
                  >
                  <div class="dropdown-menu m-0 bg-secondary rounded-0">
                    <a href="index.php?act=dathang" class="dropdown-item">Đặt hàng</a>
                    <a href="index.php?act=thanhtoan" class="dropdown-item">Thanh toán</a>
                    <a href="index.php?act=danhgia" class="dropdown-item"
                      >Đánh giá</a
                    >
                    <a href="index.php?act=404" class="dropdown-item">404 Page</a>
                  </div>
                </div>
                <a href="view/quanlysanpham.php" class="nav-item nav-link">Quản lý sản phẩm</a>
              </div>
              <div class="d-flex m-3 me-0">
                <button
                  class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                  data-bs-toggle="modal"
                  data-bs-target="#searchModal"
                >
                  <i class="fas fa-search text-primary"></i>
                </button>
                <a href="#" class="position-relative me-4 my-auto">
                  <i class="fa fa-shopping-bag fa-2x"></i>
                  <span
                    class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                    style="top: -5px; left: 15px; height: 20px; min-width: 20px"
                    >3</span
                  >
                </a>
                <a href="login.html" class="my-auto">
                  <i class="fas fa-user fa-2x"></i>
                </a>
              </div>
            </div>
          </nav>
        </div>
      </div>
      <!-- Navbar End -->

      <!-- Modal Search Start -->
      <div
        class="modal fade"
        id="searchModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-fullscreen">
          <div class="modal-content rounded-0">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tìm kiếm</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body d-flex align-items-center">
              <div class="input-group w-75 mx-auto d-flex">
                <input
                  type="search"
                  class="form-control p-3"
                  placeholder="keywords"
                  aria-describedby="search-icon-1"
                />
                <span id="search-icon-1" class="input-group-text p-3"
                  ><i class="fa fa-search"></i
                ></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Search End -->
    </header>
      <section class="admin-content">
            <div class="admin-content-left">
              <ul>
              <li>
          <a href="#">Danh mục</a>
          <ul>
              <li><a href="./quanlydanhmuc.php?act=themdanhmuc">Thêm danh mục</a></li>
              <li><a href="./quanlydanhmuc.php?act=danhsachdanhmuc">Danh sách danh mục</a></li>
          </ul>
      </li>
      <li>
          <a href="#">Loại sản phẩm</a>
          <ul>
              <li><a href="./quanlyloaisanpham.php?act=themloai">Thêm loại sản phẩm</a></li>
              <li><a href="./quanlyloaisanpham.php?act=danhsachloai">Danh sách loại sản phẩm</a></li>
          </ul>
      </li>
      <li>
        <a href="#">Sản phẩm</a>
        <ul>
          <li><a href="./quanlysanpham.php?act=themsp">Thêm sản phẩm</a></li>
          <li><a href="./quanlysanpham.php?act=danhsachsanpham">Danh sách sản phẩm</a></li>
        </ul>
      </li>

        </ul>
      </div>
      <div class="admin-content-right">
        <div class="admin-content-right-cartegory_add">
          <h1>Thêm Danh Mục</h1>
          <form action="" method="POST">
            <input type="text" placeholder="Nhập tên danh mục" />
            <button type="submit">Thêm</button>
          </form>
          <?php
            if (isset($_GET['act'])) {
              switch ($_GET['act']) {
                  case 'themdanhmuc':
                      include "view/cuahang.php";
                      break;
                  case 'danhsachdanhmuc':
                      include "danhmuc.php";
                      break;
                  case 'dathang':
                      include "view/dathang.php";
                      break;
                  case 'thanhtoan':
                      include "view/thanhtoan.php";
                      break;
                  case 'danhgia':
                      include "view/danhgia.php";
                      break;
                  case '404':
                      include "view/404.php";
                      break;
                  default:
                      include "view/home.php";
                      break;
              }
            } else {
              include "danhmuc.php";
            }
          ?>
        </div>
      </div>
    </section>
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
    <script src="../../lib/easing/easing.min.js"></script>
    <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
  </body>
</html>