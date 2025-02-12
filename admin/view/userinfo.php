<?php 
if (!isset($userid) || empty($userid)) {
    echo "Bạn chưa đăng nhập. Vui lòng đăng nhập để xem thông tin.";
    exit();
}
$user_info = getUserById($userid);
?>

<section class="mt-5 pt-5">
    <div class="container py-5">
        <h2 class="mb-4">Thông tin người dùng</h2>
        <div class="row">
            <!-- Form nhập -->
            <div class="col-md-6">
                <form action="index.php?act=updateuser_foruser" method="post" enctype="multipart/form-data" class="d-flex flex-column">
                    <input type="hidden" name="userid" value="<?= htmlspecialchars($userid) ?>">
                    
                    <label class="mb-2"><strong>Họ và tên:</strong></label>
                    <input type="text" class="form-control mb-3" value="<?= htmlspecialchars($user_info['ten'] ?? 'Chưa cập nhật') ?>" readonly>
                    
                    <label class="mb-2"><strong>Email:</strong></label>
                    <input type="email" class="form-control mb-3" value="<?= htmlspecialchars($user_info['email'] ?? 'Chưa cập nhật') ?>" readonly>
                    
                    <label class="mb-2"><strong>Số điện thoại:</strong></label>
                    <input type="text" class="form-control mb-3" value="<?= htmlspecialchars($user_info['dienthoai'] ?? 'Chưa cập nhật') ?>" readonly>
                    
                    <label class="mb-2"><strong>Trạng thái:</strong></label>
                    <input type="text" class="form-control mb-3" value="<?= htmlspecialchars($user_info['trangthai'] ?? 'Chưa cập nhật') ?>" readonly>

                    <!-- Mật khẩu -->
                    <label for="currentPassword" class="mb-2"><strong>Mật khẩu hiện tại:</strong></label>
                    <input type="password" name="currentPassword" id="currentPassword" class="form-control mb-3" required>
                    
                    <label for="newPassword" class="mb-2"><strong>Mật khẩu mới:</strong></label>
                    <input type="password" name="newPassword" id="newPassword" class="form-control mb-3">
                    
                    <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                </form>
            </div>
            <!-- Ảnh đại diện -->
            <div class="col-md-6 text-center">
                <img src="uploads/avatar/<?= htmlspecialchars($user_info['anhdaidien'] ?? 'default-avatar.png') ?>" 
                     class="rounded-circle img-fluid mb-3" 
                     alt="Avatar" width="150" height="150">
                <br>
                <a href="index.php?act=mo_updateuser_foruser&id=<?= htmlspecialchars($user_info['id']) ?>" 
                   class="btn btn-warning">Chỉnh sửa thông tin</a>
            </div>
        </div>
    </div>
</section>
