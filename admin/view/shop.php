<?php
// Số sản phẩm mỗi trang
$limit = 20;

// Trang hiện tại
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Lấy ID danh mục từ URL nếu có
$category_id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Tính toán offset cho truy vấn SQL
$offset = ($page - 1) * $limit;

// Lấy tổng số sản phẩm từ cơ sở dữ liệu
$total_products = get_total_products($category_id); // Hàm này sẽ trả về tổng số sản phẩm từ cơ sở dữ liệu theo danh mục

// Tính tổng số trang
$total_pages = ceil($total_products / $limit);

// Lấy sản phẩm cho trang hiện tại
$dssp_sp = get_products_by_page($offset, $limit, $category_id); // Hàm này sẽ trả về sản phẩm theo offset, limit và danh mục nếu có
?>


<!-- Single Page Header start -->
<div class="container-fluid py-5">
    <h1 class="text-center text-white display-6">Cửa hàng</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cửa hàng</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Sản phẩm giày</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1" />
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Sắp xếp theo:</label>
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                <option value="gia">Giá</option>
                                <option value="luotxem">Lượt xem</option>
                                <option value="luotmua">Lượt mua</option>
                                <option value="phobien">Phổ biến nhất</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Danh mục</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <?php
                                            foreach ($dsdm as $dm) {
                                                echo '<li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                        <a href="index.php?act=shop&id='.$dm['id'].'"><i class="fas fa-apple-alt me-2"></i>'.$dm['tenloai'].'</a>
                                                        <span>(3)</span>
                                                        </div>
                                                    </li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- baner Shop -->
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="img/Banner_shoe.jpg" class="img-fluid w-100 rounded" alt="" />
                                    <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">Foot <br />Fusion <br />Banner</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <?php
                                foreach ($dssp_sp as $sp) {
                                    $images = getall_hinhanh_by_sanpham($sp['id']);
                                    $hinhanh = isset($images[0]['hinhanh']) ? $images[0]['hinhanh'] : 'default_image.jpg'; // Sử dụng hình ảnh mặc định nếu không có hình ảnh
                                    $loai_sanpham = get_loai_sanpham($sp['loaisanpham_id']);
                                    echo '<div class="col-md-6 col-lg-4 col-xl-3 d-flex align-items-stretch mb-4">
                                        <form action="index.php?act=addcard" method="post" class="w-100">
                                            <div class="card h-100 d-flex flex-column">
                                                <img src="uploads/'.$hinhanh.'" class="card-img-top" alt="'.$sp['tensanpham'].'">
                                                <div class="card-body d-flex flex-column">
                                                    <div class="mb-2">
                                                        <span class="badge bg-secondary">'.$loai_sanpham.'</span>
                                                    </div>
                                                    <h5 class="card-title">'.$sp['tensanpham'].'</h5>
                                                    <p class="card-text text-dark fs-5 fw-bold">'.$sp['gia'].' VNĐ</p>
                                                    <div class="mt-auto">
                                                        <button type="submit" class="btn btn-primary w-100">
                                                            <i class="fa fa-shopping-bag me-2"></i>Thêm giỏ hàng
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="pagination d-flex justify-content-center mt-5">
                    <?php if ($page > 1): ?>
                        <a href="index.php?act=shop&page=<?= $page - 1 ?>&id=<?= $category_id ?>" class="rounded">&laquo;</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="index.php?act=shop&page=<?= $i ?>&id=<?= $category_id ?>" class="rounded <?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                    <?php if ($page < $total_pages): ?>
                        <a href="index.php?act=shop&page=<?= $page + 1 ?>&id=<?= $category_id ?>" class="rounded">&raquo;</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
