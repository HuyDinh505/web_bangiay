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
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="view/style.css">
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
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-primary display-6">FootFusion</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>

                <?php if(isset($_SESSION['vaitro'])&&($_SESSION['vaitro']==1)): ?>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.php?act=user" class="nav-item nav-link">Người dùng</a>
                        <a href="index.php?act=danhmuc" class="nav-item nav-link">Danh mục</a>
                        <a href="index.php?act=sanpham" class="nav-item nav-link">Sản phẩm</a>
                        <a href="index.php?act=khuyenmai" class="nav-item nav-link">Khuyễn Mãi</a>
                        <a href="index.php?act=danhgia" class="nav-item nav-link">Đánh giá</a>
                        <a href="index.php?act=donhang" class="nav-item nav-link">Đơn hàng</a>
                    </div>
                </div>
                <?php else: ?>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.php" class="nav-item nav-link active">Trang chủ</a>
                        <a href="index.php?act=shop" class="nav-item nav-link">Cửa hàng</a>
                        <a href="index.php?act=giohang" class="nav-item nav-link">Đặt hàng</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Trang</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="chackout.html" class="dropdown-item">Thanh toán</a>
                                <a href="index.php?act=danhgia" class="dropdown-item">Đánh giá</a>
                            </div>
                        </div>
                        <a href="index.php?act=lienhe" class="nav-item nav-link">Liên hệ</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search text-primary"></i>
                        </button>
                        <?php
                            $cart_quantity = 0;
                            if (isset($_SESSION['vaitro']) && ($_SESSION['vaitro'] == 1 || $_SESSION['vaitro'] == 0)) {
                                $cart_quantity = get_cart_quantity();
                            }
                        ?>
                        <a href="index.php?act=giohang" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px"><?= $cart_quantity ?></span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['vaitro'])&&($_SESSION['vaitro']==1)): ?>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.php?act=thoat" class="nav-item nav-link">Đăng xuất</a>
                    </div>
                </div>
                <?php elseif (isset($_SESSION['vaitro']) && ($_SESSION['vaitro'] == 0)): ?>
    <?php $ten = htmlspecialchars($_SESSION['ten'] ?? ''); ?>
    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
        <div class="navbar-nav mx-auto d-flex align-items-center">
            <?php
                $avatar = isset($_SESSION['anhdaidien']) ; // Đường dẫn tới hình mặc định
                // $user_id = htmlspecialchars($_SESSION['id'] ?? ''); // Lấy ID người dùng từ session
            ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="uploads/avatar/<?= $avatar ?>" alt="Avatar" class="rounded-circle me-2" width="30" height="30">
                    <?= $ten ?>
                </a>
                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                    <a href="index.php?act=userinfo" class="dropdown-item">Xem thông tin</a>
                    <a href="index.php?act=thoat" class="dropdown-item">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>

                <?php else: ?>
                <div class="d-flex m-3 me-0">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user fa-2x"></i>
                        </a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="admin/login.php" class="dropdown-item">Đăng nhập</a>
                            <a href="admin/register.php" class="dropdown-item">Đăng ký</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
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