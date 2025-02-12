<section class="mt-5 pt-5">
    <div class="container-fluid py-5 mb-5 mt-5">
        <h2>CẬP NHẬT SẢN PHẨM</h2>
        <div class="row">
            <div class="col-md-4">
                <?php if (isset($sp) && $sp): ?>
                    <form action="index.php?act=update_sp" method="post" enctype="multipart/form-data" class="d-flex flex-column">
                        <input type="hidden" name="id" value="<?php echo isset($sp['id']) ? htmlspecialchars($sp['id']) : ''; ?>">
                        <select name="loaisanpham_id" class="mb-3 form-control">
                            <option value="0">Chọn danh mục</option>
                            <?php
                            if (isset($dsdm)) {
                                foreach ($dsdm as $dm) {
                                    $selected = $dm['id'] == $sp['loaisanpham_id'] ? 'selected' : '';
                                    echo '<option value="'.$dm['id'].'" '.$selected.'>'.$dm['tenloai'].'</option>';
                                }
                            }
                            ?>
                        </select>
                        <label for="tensanpham" class="mb-1">Tên sản phẩm</label>
                        <input type="text" name="tensanpham" id="tensanpham" class="mb-3 form-control" value="<?php echo isset($sp['tensanpham']) ? htmlspecialchars($sp['tensanpham']) : ''; ?>">
                        <label for="mota" class="mb-1">Mô tả:</label>
                        <textarea id="mota" name="mota" rows="4" cols="50" placeholder="Nhập mô tả sản phẩm..." class="mb-3 form-control"><?php echo isset($sp['mota']) ? htmlspecialchars($sp['mota']) : ''; ?></textarea>
                        <label for="gia" class="mb-1">Giá:</label>
                        <input type="number" id="gia" name="gia" step="0.01" class="mb-3 form-control" value="<?php echo isset($sp['gia']) ? htmlspecialchars($sp['gia']) : ''; ?>">
                        <label for="hinhanh" class="mb-1">Hình ảnh hiện tại:</label>
                        <div class="mb-3">
                            <?php
                            if (isset($dsha)) {
                                foreach ($dsha as $image) {
                                    echo '<div class="d-inline-block me-2 mb-2">
                                            <img src="uploads/'.$image['hinhanh'].'" width="80px" alt="Hình ảnh sản phẩm">
                                            <a href="index.php?act=del_hinhanh&id='.$image['id'].'&spid='.$sp['id'].'" class="btn btn-danger btn-sm mt-2">Xóa</a>
                                          </div>';
                                }
                            }
                            ?>
                        </div>
                        <label for="hinhanh" class="mb-1">Thêm hình ảnh mới:</label>
                        <input type="file" name="hinhanh[]" id="hinhanh" accept="image/*" multiple class="mb-3 form-control">
                        <label for="soluong" class="mb-1">Số lượng:</label>
                        <input type="number" id="soluong" name="soluong" class="mb-3 form-control" value="<?php echo isset($sp['soluong']) ? htmlspecialchars($sp['soluong']) : ''; ?>">
                        <label for="trangthai" class="mb-1">Trạng thái:</label>
                        <select name="trangthai" id="trangthai" class="mb-3 form-control">
                            <option value="1" <?php echo isset($sp['trangthai']) && $sp['trangthai'] == 1 ? 'selected' : ''; ?>>Đang kinh doanh</option>
                            <option value="0" <?php echo isset($sp['trangthai']) && $sp['trangthai'] == 0 ? 'selected' : ''; ?>>Ngừng kinh doanh</option>
                        </select>
                        <label for="luotxem" class="mb-1">Lượt xem:</label>
                        <input type="number" id="luotxem" name="luotxem" class="mb-3 form-control" value="<?php echo isset($sp['luotxem']) ? htmlspecialchars($sp['luotxem']) : ''; ?>">
                        <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-primary">
                    </form>
                <?php else: ?>
                    <p>Không tìm thấy sản phẩm.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
