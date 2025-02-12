<section class="mt-5 pt-5">
    <div class="container-fluid py-5 mb-5 mt-5">
        <h2>SẢN PHẨM</h2>
        <div class="row">
            <!-- Mục nhập -->
            <div class="col-md-4">
                <form action="index.php?act=sanpham_add" method="post" enctype="multipart/form-data" class="d-flex flex-column">
                    <select name="loaisanpham_id" class="mb-3 form-control">
                        <option value="0">Chọn danh mục</option>
                        <?php
                        if (isset($dsdm)) {
                            foreach ($dsdm as $dm) {
                                echo '<option value="'.$dm['id'].'">'.$dm['tenloai'].'</option>';
                            }
                        }
                        ?>
                    </select>
                    <label for="tensanpham" class="mb-1">Tên sản phẩm</label>
                    <input type="text" name="tensanpham" id="tensanpham" class="mb-3 form-control">
                    <label for="mota" class="mb-1">Mô tả:</label>
                    <textarea id="mota" name="mota" rows="4" cols="50" placeholder="Nhập mô tả sản phẩm..." class="mb-3 form-control"></textarea>
                    <label for="gia" class="mb-1">Giá:</label>
                    <input type="number" id="gia" name="gia" step="0.01" class="mb-3 form-control">
                    <label for="hinhanh" class="mb-1">Hình ảnh:</label>
                    <input type="file" name="hinhanh[]" id="hinhanh" accept="image/*" multiple class="mb-3 form-control">
                    <label for="soluong" class="mb-1">Số lượng:</label>
                    <input type="number" id="soluong" name="soluong" class="mb-3 form-control">
                    <label for="luotxem" class="mb-1">Lượt xem</label>
                    <input type="number" id="luotxem" name="luotxem" class="mb-3 form-control">
                    <label for="trangthai" class="mb-1">Trạng thái:</label>
                    <input type="number" id="trangthai" name="trangthai" class="mb-3 form-control">
                    <input type="submit" name="themmoi" value="Thêm mới" class="btn btn-primary">
                </form>
            </div>

            <!-- Mục hiển thị sản phẩm -->
            <div class="col-md-8">
                <h1>Danh sách sản phẩm</h1>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Lượt xem</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $kq = getall_sanpham(0,0);
                            if (isset($kq) && count($kq) > 0) {
                                $i = 1;
                                foreach ($kq as $sp) {
                                    echo '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$sp['tensanpham'].'</td>
                                            <td>'.$sp['mota'].'</td>
                                            <td>'.$sp['gia'].'</td>
                                            <td>';
                                    // Lấy tất cả hình ảnh liên quan đến sản phẩm
                                    $images = getall_hinhanh_by_sanpham($sp['id']);
                                    if (isset($images) && count($images) > 0) {
                                        foreach ($images as $image) {
                                            echo '<img src="uploads/'.$image['hinhanh'].'" width="80%" alt="Hình ảnh sản phẩm">';
                                        }
                                    } else {
                                        echo 'Không có hình ảnh';
                                    }
                                    echo '</td>
                                            <td>'.$sp['ngaytao'].'</td>
                                            <td>'.$sp['ngaycapnhat'].'</td>
                                            <td>'.$sp['soluong'].'</td>
                                            <td>'.$sp['trangthai'].'</td>
                                            <td>'.$sp['luotxem'].'</td>
                                            <td><a href="index.php?act=editform_sp&id='.$sp['id'].'" class="btn btn-warning btn-sm">Sửa</a> 
                                                <a href="index.php?act=del_sp&id='.$sp['id'].'" class="btn btn-danger btn-sm">Xóa</a></td>
                                            
                                        </tr>';
                                    $i++; // Tăng giá trị của $i sau mỗi vòng lặp/
                                }
                            } else {
                                echo '<tr><td colspan="7" class="text-center">Không có sản phẩm nào.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
