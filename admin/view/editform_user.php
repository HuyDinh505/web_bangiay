<section class="mt-5 pt-5">
    <div class="container-fluid py-5 mb-5 mt-5">
        <h2>CẬP NHẬT NGƯỜI DÙNG</h2>
        <div class="row">
            <div class="col-md-4">
                <?php if (isset($user) && $user): ?>
                    <form action="index.php?act=update_user" method="post" enctype="multipart/form-data" class="d-flex flex-column">
                        <input type="hidden" name="id" value="<?php echo isset($user['id']) ? htmlspecialchars($user['id']) : ''; ?>">
                        
                        <label for="fullname" class="mb-1">Họ và tên:</label>
                        <input type="text" name="fullname" id="fullname" class="mb-3 form-control" value="<?php echo isset($user['ten']) ? htmlspecialchars($user['ten']) : ''; ?>">
                        
                        <label for="email" class="mb-1">Email:</label>
                        <input type="email" name="email" id="email" class="mb-3 form-control" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>">
                        
                        <label for="phone" class="mb-1">Số điện thoại:</label>
                        <input type="tel" name="phone" id="phone" class="mb-3 form-control" value="<?php echo isset($user['dienthoai']) ? htmlspecialchars($user['dienthoai']) : ''; ?>">
                        
                        <label for="address" class="mb-1">Địa chỉ:</label>
                        <input type="text" name="address" id="address" class="mb-3 form-control" value="<?php echo isset($user['diachi']) ? htmlspecialchars($user['diachi']) : ''; ?>">
                        
                        <label for="role" class="mb-1">Vai trò:</label>
                        <select name="role" id="role" class="mb-3 form-control">
                            <option value="0" <?php echo isset($user['vaitro']) && $user['vaitro'] == 0 ? 'selected' : ''; ?>>User thường</option>
                            <option value="1" <?php echo isset($user['vaitro']) && $user['vaitro'] == 1 ? 'selected' : ''; ?>>Admin</option>
                        </select>
                        
                        <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-primary">
                    </form>
                <?php else: ?>
                    <p>Không tìm thấy người dùng.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
