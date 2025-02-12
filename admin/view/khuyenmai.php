<section class="mt-5 pt-5">
    <div class="container-fluid py-5 mb-5 mt-5">
        <h2>KHUYẾN MÃI</h2>
        <div class="row">
            <!-- Mục nhập -->
            <div class="col-md-4">
                <form action="index.php?act=add_km" method="post" enctype="multipart/form-data" class="d-flex flex-column">
                    <label for="tenkm" class="mb-1">Tên khuyến mãi</label>
                    <input type="text" name="tenkm" id="tenkm" class="mb-3 form-control">
                    <label for="mota" class="mb-1">Mô tả</label>
                    <textarea id="mota" name="mota" rows="4" cols="50" placeholder="Nhập mô tả khuyến mãi..." class="mb-3 form-control"></textarea>
                    <label for="ngaybatdau" class="mb-1">Ngày bắt đầu</label>
                    <input type="date" id="ngaybatdau" name="ngaybatdau" class="mb-3 form-control">
                    <label for="ngayketthuc" class="mb-1">Ngày kết thúc</label>
                    <input type="date" id="ngayketthuc" name="ngayketthuc" class="mb-3 form-control">
                    <label for="phantramgiam" class="mb-1">Phần trăm giảm</label>
                    <input type="number" id="phantramgiam" name="phantramgiam" step="0.01" class="mb-3 form-control">
                    <label for="id_sanpham" class="mb-1">Sản phẩm áp dụng</label>
                    <select name="id_sanpham" class="mb-3 form-control">
                        <option value="0">Chọn sản phẩm</option>
                        <?php
                        $dssp = getall_sanpham(0,0); // Lấy danh sách tất cả sản phẩm
                        if (isset($dssp)) {
                            foreach ($dssp as $sp) {
                                echo '<option value="'.$sp['id'].'">'.$sp['tensanpham'].'</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" name="themmoi" value="Thêm mới" class="btn btn-primary">
                </form>
            </div>

            <!-- Mục hiển thị khuyến mãi -->
            <div class="col-md-8">
                <h1>Danh sách khuyến mãi</h1>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên khuyến mãi</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Ngày bắt đầu</th>
                                <th scope="col">Ngày kết thúc</th>
                                <th scope="col">Phần trăm giảm</th>
                                <th scope="col">Sản phẩm áp dụng</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $kq = getall_khuyenmai();
                            if (isset($kq) && count($kq) > 0) {
                                $i = 1;
                                foreach ($kq as $km) {
                                    echo '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$km['ten'].'</td>
                                            <td>'.$km['mota'].'</td>
                                            <td>'.$km['ngaybatdau'].'</td>
                                            <td>'.$km['ngayketthuc'].'</td>
                                            <td>'.$km['phantramgiam'].'%</td>
                                            <td>'.$km['tensanpham'].'</td>
                                            <td>
                                                <a href="index.php?act=editform_km&id='.$km['id'].'" class="btn btn-warning btn-sm">Sửa</a> 
                                                <a href="index.php?act=delkm&id='.$km['id'].'" class="btn btn-danger btn-sm">Xóa</a>
                                            </td>
                                        </tr>';
                                    $i++;
                                }
                            } else {
                                echo '<tr><td colspan="8" class="text-center">Không có khuyến mãi nào.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
