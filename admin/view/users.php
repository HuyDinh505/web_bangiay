<section class="mt-5 pt-5">
    <div class="container-fluid py-5 mb-5 mt-5">
        <h2>QUẢN LÝ NGƯỜI DÙNG</h2>
        <div class="row">
            <!-- Mục nhập -->
            <div class="col-md-4">
                <form action="index.php?act=user_add" method="post" enctype="multipart/form-data" class="d-flex flex-column">
                    <label for="fullname" class="mb-1">Họ và tên:</label>
                    <input type="text" name="fullname" id="fullname" class="mb-3 form-control" required>
                    
                    <label for="email" class="mb-1">Email:</label>
                    <input type="email" name="email" id="email" class="mb-3 form-control" required>
                    
                    <label for="password" class="mb-1">Mật khẩu:</label>
                    <input type="password" name="password" id="password" class="mb-3 form-control" required>
                    
                    <label for="phone" class="mb-1">Số điện thoại:</label>
                    <input type="tel" name="phone" id="phone" class="mb-3 form-control" required>
                    
                    <label for="address" class="mb-1">Địa chỉ:</label>
                    <input type="text" name="address" id="address" class="mb-3 form-control">

                    <label for="role" class="mb-1">Vai trò:</label>
                    <select name="role" id="role" class="mb-3 form-control" required>
                        <option value="0" selected>User thường</option>
                        <option value="1">Admin</option>
                    </select>
                    
                    <input type="submit" name="adduser" value="Thêm mới" class="btn btn-primary">
                </form>
            </div>

            <!-- Mục hiển thị người dùng -->
            <div class="col-md-8">
                <h1>Danh sách người dùng</h1>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Họ và tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Vai trò</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users = getUsers();
                            if (isset($users) && count($users) > 0) {
                                $i = 1;
                                foreach ($users as $user) {
                                    echo '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$user['ten'].'</td>
                                            <td>'.$user['email'].'</td>
                                            <td>'.$user['dienthoai'].'</td>
                                            <td>'.$user['diachi'].'</td>
                                            <td>'.($user['vaitro'] == 1 ? "Admin" : "User thường").'</td>
                                            <td>
                                                <a href="index.php?act=editform_user&id='.$user['id'].'" class="btn btn-warning btn-sm">Sửa</a> 
                                                <a href="index.php?act=del_user&id='.$user['id'].'" class="btn btn-danger btn-sm">Xóa</a>
                                            </td>
                                        </tr>';
                                    $i++;
                                }
                            } else {
                                echo '<tr><td colspan="7" class="text-center">Không có người dùng nào.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
