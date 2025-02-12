<section class="mt-5 pt-5">
    <div class="container-fluid py-5 mb-5 mt-5">
        <h2>DANH MỤC</h2>
        <div class="row">
            <!-- Mục nhập danh mục -->
            <div class="col-md-4">
                <form action="index.php?act=add_dm" method="post" class="d-flex flex-column">
                    <input type="text" name="tendm" id="tendm" placeholder="Tên danh mục" class="mb-3 form-control">
                    <input type="submit" name="themmoi" value="Thêm mới" class="btn btn-primary">
                </form>
            </div>

            <!-- Mục hiển thị danh mục -->
            <div class="col-md-8">
                <h1>Danh sách danh mục</h1>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $kq = getall_dm();
                            if (isset($kq) && count($kq) > 0) {
                                $i = 1;
                                foreach ($kq as $dm) {
                                    echo '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$dm['tenloai'].'</td>
                                            <td><a href="index.php?act=editform_dm&id='.$dm['id'].'" class="btn btn-warning btn-sm">Sửa</a> 
                                                <a href="index.php?act=deldm&id='.$dm['id'].'" class="btn btn-danger btn-sm">Xóa</a></td>
                                        </tr>';
                                    $i++; // Tăng giá trị của $i sau mỗi vòng lặp
                                }
                            } else {
                                echo '<tr><td colspan="3" class="text-center">Không có danh mục nào.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
