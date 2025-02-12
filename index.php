<?php
session_start();
ob_start();
if(!isset($_SESSION['giohang'])) $_SESSION['giohang']=[];
if(isset($_SESSION['vaitro'])&&($_SESSION['vaitro']==1)){
    include "model/connectdb.php";
    include "model/user.php";
    include "model/sanpham.php";
    include "model/danhmuc.php";
    include "model/khuyenmai.php";
    include "model/donhang.php";


include "admin/view/header.php";

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'user':
            include "admin/view/users.php";
            break;
        case 'user_add':
            if(isset($_POST['adduser'])&&($_POST['adduser'])){
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $role = $_POST['role'];

                // Gọi hàm add_user để thêm người dùng mới
                $result = add_user($fullname, $email, $password, $phone, $address, $role);

                // Kiểm tra kết quả và thông báo
                if ($result) {
                    echo "<script>alert('Thêm người dùng mới thành công!');</script>";
                } else {
                    echo "<script>alert('Lỗi khi thêm người dùng!');</script>";
                }
                include "admin/view/users.php";
                exit();
            }
            break;
        case 'editform_user':
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $user = getUserById($id); // Giả sử bạn có hàm này để lấy thông tin người dùng theo ID
                include "admin/view/editform_user.php";
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Lấy dữ liệu từ form
                    $fullname = $_POST['fullname'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $role = $_POST['role'];
            
                    // Cập nhật thông tin người dùng
                    $result = update_user($id, $fullname, $email, $phone, $address, $role);
            
                    // Kiểm tra kết quả và thông báo
                    if ($result) {
                        echo "<script>alert('Cập nhật người dùng thành công!');</script>";
                        include "admin/view/users.php";
                        exit();
                    } else {
                        echo "<script>alert('Lỗi khi cập nhật người dùng!');</script>";
                    }
                }
            } else {
                echo "<script>alert('ID người dùng không hợp lệ!');</script>";
                include "admin/view/users.php";
                exit();
            }
            break;
        case 'del_user':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                // Kiểm tra nếu tài khoản đang đăng nhập và tài khoản cần xóa là cùng một tài khoản
                if ($id == $_SESSION['id']) {
                    echo "<script>alert('Bạn không thể xóa tài khoản của chính mình!'); </script>";
                } else {
                    $result = del_user($id);
                    if ($result > 0) {
                        echo "<script>alert('Xóa người dùng thành công!'); </script>";
                    } else {
                        echo "<script>alert('Lỗi khi xóa người dùng!'); </script>";
                    }
                }
            }
            include "admin/view/users.php";
            break;
            
            
        // Xu ly danh muc
        case 'danhmuc':
            include "admin/view/danhmuc.php";
            break;
        case 'add_dm':
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $tendm = $_POST['tendm'];
                themdm($tendm);
            }
            include "admin/view/danhmuc.php";
            break;
        case 'deldm':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                del_dm($id);
            }
            include "admin/view/danhmuc.php";
            break;
        case 'editform_dm':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $kqone = getone_dm($id);
                include "admin/view/editform_dm.php";
            }
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $tendm = $_POST['tendm'];
                update_dm($id, $tendm);
                include "admin/view/danhmuc.php";
            }
            break;
        // Xử lý san pham
        case 'sanpham':
            $dsdm = getall_dm();
            $dssp = getall_sanpham(0,0);
            include "admin/view/sanpham.php";
            break;
        case 'sanpham_add':
            if ((isset($_POST['themmoi'])) && ($_POST['themmoi'])) {
                $loaisanpham_id = $_POST['loaisanpham_id'];
                $tensanpham = $_POST['tensanpham'];
                $mota = $_POST['mota'];
                $gia = $_POST['gia'];
                $ngaytao = date('Y-m-d H:i:s');
                    
                $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : 0;
                $luotxem = isset($_POST['luotxem']) ? $_POST['luotxem'] : 0;
                $trangthai = isset($_POST['trangthai']) ? $_POST['trangthai'] : 1;
                $ngaycapnhat = date('Y-m-d H:i:s');
                $sanpham_id = insert_sanpham($loaisanpham_id, $tensanpham, $mota, $gia, $ngaytao, $ngaycapnhat, $soluong, $trangthai, $luotxem);
            
                if (!empty($_FILES['hinhanh']['name'][0])) {
                    foreach ($_FILES['hinhanh']['name'] as $key => $value) {
                        $target_dir = "uploads/"; // Đường dẫn tới thư mục uploads cùng cấp với index.php
                        // Kiểm tra và tạo thư mục nếu chưa tồn tại
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0777, true);
                        }
                        $target_file = $target_dir . basename($_FILES["hinhanh"]["name"][$key]);
                        $hinhanh = basename($_FILES["hinhanh"]["name"][$key]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
                        // Kiểm tra định dạng file hình ảnh
                        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "webp") {
                            echo "Xin lỗi, chỉ cho phép các tệp JPG, JPEG, PNG, GIF và WEBP.";
                            $uploadOk = 0;
                        }
            
                        // Kiểm tra nếu file đã tồn tại
                        if (file_exists($target_file)) {
                            echo "Xin lỗi, tệp đã tồn tại.";
                            $uploadOk = 0;
                        }
            
                        // Kiểm tra kích thước file
                        if ($_FILES["hinhanh"]["size"][$key] > 5000000) { // Tăng kích thước tối đa lên 5MB
                            echo "Xin lỗi, tệp của bạn quá lớn.";
                            $uploadOk = 0;
                        }
            
                        // Tiến hành upload file nếu không có lỗi
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"][$key], $target_file)) {
                                insert_hinhanh($sanpham_id, $hinhanh);
                                echo "Tệp " . htmlspecialchars(basename($_FILES["hinhanh"]["name"][$key])) . " đã được tải lên.";
                            } else {
                                echo "Xin lỗi, đã xảy ra lỗi khi tải tệp của bạn lên.";
                            }
                        } else {
                            echo "Xin lỗi, tệp của bạn không được tải lên.";
                        }
                    }
                }
            }
            $dsdm = getall_dm();
            $dssp = getall_sanpham(0, 0);
            include "admin/view/sanpham.php"; // Đường dẫn tới file sanpham.php trong thư mục admin
            break;  
        case 'del_sp':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                del_sanpham($id);
            }
            $dsdm = getall_dm();
            $dssp = getall_sanpham(0,0);
            include "admin/view/sanpham.php";
            break;
        case 'del_hinhanh':
            if (isset($_GET['id']) && isset($_GET['spid'])) {
                $id = $_GET['id'];
                $spid = $_GET['spid'];
                del_hinhanh($id);
                header("Location: index.php?act=editform_sp&id=$spid");
            }
            break;
            
        case 'editform_sp':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sp = getone_sanpham($id);
                $dsdm=getall_dm();
                $dssp = getall_sanpham(0,0);
                $dsha=getall_hinhanh_by_sanpham($id);
                include "admin/view/editform_sanpham.php";
            }
            break;
            
            
        case 'update_sp':
            if ((isset($_POST['capnhat'])) && ($_POST['capnhat'])) {
                $id = $_POST['id'];
                $loaisanpham_id = $_POST['loaisanpham_id'];
                $tensanpham = $_POST['tensanpham'];
                $mota = $_POST['mota'];
                $gia = $_POST['gia'];
                $ngaycapnhat = date('Y-m-d H:i:s'); // Ngày cập nhật là ngày hiện tại
                $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : 0;
                $trangthai = isset($_POST['trangthai']) ? $_POST['trangthai'] : 1;
                $luotxem = isset($_POST['luotxem']) ? $_POST['luotxem'] : 0;
            
                update_sanpham($id, $loaisanpham_id, $tensanpham, $mota, $gia, $ngaycapnhat, $soluong, $trangthai, $luotxem);
            
                if (!empty($_FILES['hinhanh']['name'][0])) {
                    foreach ($_FILES['hinhanh']['name'] as $key => $value) {
                        $target_dir = "uploads/";
                        $target_file = $target_dir . basename($_FILES["hinhanh"]["name"][$key]);
                        $hinhanh = basename($_FILES["hinhanh"]["name"][$key]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
                        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "webp") {
                            echo "Xin lỗi, chỉ cho phép các tệp JPG, JPEG, PNG, GIF và WEBP.";
                            $uploadOk = 0;
                        }
            
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"][$key], $target_file)) {
                                insert_hinhanh($id, $hinhanh);
                            } else {
                                echo "Xin lỗi, đã xảy ra lỗi khi tải tệp của bạn lên.";
                            }
                        }
                    }
                }
            }
            $dsdm = getall_dm();
            $dssp = getall_sanpham(0,0);
            include "admin/view/sanpham.php";
            break;
            
        case 'del_sp':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                del_sanpham($id);
            }
            $dsdm = getall_dm();
            $dssp = getall_sanpham(0,0);
            include "admin/view/sanpham.php";
            break;
                        
            // khuyenmai
        case 'khuyenmai':
            include "admin/view/khuyenmai.php";
            break;
        case 'add_km':
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $tenkm = $_POST['tenkm'];
                $mota = $_POST['mota'];
                $ngaybatdau = $_POST['ngaybatdau'];
                $ngayketthuc = $_POST['ngayketthuc'];
                $phantramgiam = $_POST['phantramgiam'];
                $id_sanpham = $_POST['id_sanpham'];
                them_km($tenkm, $mota, $ngaybatdau, $ngayketthuc, $phantramgiam, $id_sanpham);
            }
            include "admin/view/khuyenmai.php";
            break;                
        case 'delkm':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                del_km($id);
            }
            include "admin/view/khuyenmai.php";
            break;
        case 'editform_km':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $kqone = getone_km($id);
                include "admin/view/editform_km.php";
            }
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $tenkm = $_POST['tenkm'];
                $mota = $_POST['mota'];
                $ngaybatdau = $_POST['ngaybatdau'];
                $ngayketthuc = $_POST['ngayketthuc'];
                $phantramgiam = $_POST['phantramgiam'];
                update_km($id, $tenkm, $mota, $ngaybatdau, $ngayketthuc, $phantramgiam,$id_sanpham);
                include "admin/view/khuyenmai.php";
            }
            break;        


        case 'thoat':
            unset($_SESSION['vaitro']);
            header('location:index.php');    
            break;
        case 'donhang':
            include "admin/view/donhang.php";
            break;
        case 'chitietdonhang':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) { 
                $hoadon_id = $_GET['id']; 
                $donhang = get_order($hoadon_id); 
                $chitietdonhang = get_order_details($hoadon_id); 
                include "admin/view/chitietdonhang.php"; 
            } else { 
                echo 'Không tìm thấy thông tin đơn hàng.'; 
            } 
            break;
        
        default:
            include "admin/view/home.php";
            break;
    }
} else {
    include "admin/view/home.php";
}
include "admin/view/footer.php";

}else if(isset($_SESSION['vaitro'])&&($_SESSION['vaitro']==0)){
    include "model/connectdb.php";
    include "model/user.php";
    include "model/sanpham.php";
    include "model/danhmuc.php";
    include "model/donhang.php";

    //load du lieu trang chu
    $sphome1=getall_sanpham(0,0);
    $sphome2=getall_sanpham(1,0);

    include "admin/view/header.php";
    
    if (isset($_GET['act'])) {
        switch ($_GET['act']) { 
            
            
            case 'shop':
                $dsdm=getall_dm();
                if(isset($_GET['id'])&&($_GET['id'])>0){
                    $iddm=$_GET['id'];
                    $dssp_sp=getall_sanpham($iddm,0);
                }else{
                    $dssp_sp=getall_sanpham(0,0);
                }
                include "admin/view/shop.php";
                break;
            case 'giohang':
                include "admin/view/giohang.php";
                break;
            case 'addcard':
                //lấy dữ liệu từ form để lưu vào giỏ hàng
                if(isset($_POST['addtocard'])&&($_POST['addtocard'])){
                    $id=$_POST['id'];
                    $hinh=$_POST['hinh'];
                    $loaisanpham=$_POST['loaisanpham'];
                    $tensp=$_POST['tensanpham'];
                    $gia=$_POST['gia'];
                    if(isset($_POST['sl'])&&($_POST['sl'])>0){
                        $sl=$_POST['sl'];
                    }else{
                    $sl=1;
                    }
                    $flag=0;
                    //kiểm tra sản phẩm có tồn tại trong giỏ hàng hay không?
                    //cap nhat lai so luong
                    $i=0;
                    foreach ($_SESSION['giohang'] as $item) {
                        if($item[3]===$tensp){
                            $soluongmoi=$sl+$item[5];
                            $_SESSION['giohang'][5]=$soluongmoi;
                            $flag=1;
                            break;
                        }
                        $i++;
                    }

                    //ko co thi add vao gio hang
                    //khoi tao 1 mang con dua vao gio hang
                    if($flag==0){
                    $item=array($id,$hinh,$loaisanpham,$tensp,$gia,$sl);
                    $_SESSION['giohang'][]=($item);
                    }
                    header('location: index.php?act=giohang');
                }

                include "admin/view/giohang.php";
                break;
            case 'delhang':
                if(isset($_GET['index']) && ($_GET['index'] >= 0)) {
                    $index = $_GET['index'];
                    if(isset($_SESSION['giohang'][$index])) {
                        // Xóa sản phẩm khỏi giỏ hàng
                        unset($_SESSION['giohang'][$index]);
                        // Sắp xếp lại mảng sau khi xóa phần tử
                        $_SESSION['giohang'] = array_values($_SESSION['giohang']);
                    }
                }
                header('location: index.php?act=giohang');
                break;
                
            case 'update_quantity':
                 // Xử lý yêu cầu AJAX để cập nhật số lượng giỏ hàng
                if(isset($_POST['index']) && isset($_POST['quantity'])) {
                    $index = $_POST['index'];
                    $quantity = $_POST['quantity'];
    
                    if(isset($_SESSION['giohang'][$index])) {
                        $_SESSION['giohang'][$index][5] = $quantity; // Cập nhật số lượng trong giỏ hàng
                        echo json_encode(['status' => 'success']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Item not found']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
                }
                exit; // Dừng thực thi sau khi xử lý AJAX
                break;
            case 'spchitiet':
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    $id=$_GET['id'];
                    $kq=getone_sanpham($id);
                }
                include "admin/view/chitietsanpham.php";
                break;
            
            case 'thanh_toan':
                if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                    $nguoidung_id = $_SESSION['id'];
                    $tongtien = 0;
                    $diachi = $_POST['diachi']; 
                    foreach ($_SESSION['giohang'] as $item) {
                        $tongtien += $item[4] * $item[5];
                    }
                    $hoadon_id = add_order($nguoidung_id, $tongtien, $diachi);
                    if ($hoadon_id) {
                        foreach ($_SESSION['giohang'] as $item) {
                            add_order_details($hoadon_id, $item[0], $item[5], $item[4]);
                        }
                        unset($_SESSION['giohang']);
                        echo "<script>
                                alert('Đặt hàng thành công! Cảm ơn bạn đã mua hàng.');
                                window.location.href = 'index.php?act=xac_nhan_don_hang&hoadon_id=$hoadon_id';
                                </script>";
                        exit();
                    } else {
                        echo 'Có lỗi xảy ra khi thêm đơn hàng. Vui lòng thử lại!';
                    }
                } else {
                    echo 'Giỏ hàng của bạn đang trống.';
                }
                break;
                
                
            case 'danhgia':
                include "admin/view/danhgia.php";
                break;
            case 'lienhe':
                include "admin/view/lienhe.php";
                break;
                case 'userinfo':
                    // Đảm bảo ID người dùng tồn tại trước khi include view
                    if (isset($_SESSION['id'])) {
                        $user_id = $_SESSION['id'];
                        // Có thể lấy thêm thông tin người dùng từ database dựa trên $user_id nếu cần
                        $user_info = getUserById($user_id); // Ví dụ hàm lấy thông tin user theo ID
                        include "admin/view/userinfo.php";
                    } else {
                        // Xử lý nếu không có ID người dùng (ví dụ: chuyển hướng về trang chủ hoặc thông báo lỗi)
                        header('Location: index.php'); // Hoặc hiển thị thông báo lỗi
                        exit();
                    }
                    break;
    
                case 'thoat':
                    unset($_SESSION['vaitro']);
                    unset($_SESSION['id']); // Xóa cả ID người dùng khi đăng xuất
                    header('location: index.php');
                    break;
        default:
            include "admin/view/home.php";
            break;
        }
    } else {
        include "admin/view/home.php";
    }
    include "admin/view/footer.php";


}else{
    include "model/connectdb.php";
    include "model/user.php";
    include "model/sanpham.php";
    include "model/danhmuc.php";

    $sphome1=getall_sanpham(0,0);
    $sphome2=getall_sanpham(1,0);

    include "admin/view/header.php";
    //load du lieu trang chu
    $sphome1=getall_sanpham(0,0);
    if (isset($_GET['act'])) {
        switch ($_GET['act']) { 
            case 'chitietsanpham':
                include "chitietsanpham.php";
                break;
            case 'shop':
                $dsdm=getall_dm();
                if(isset($_GET['id'])&&($_GET['id'])>0){
                    $iddm=$_GET['id'];
                    $dssp_sp=getall_sanpham($iddm,0);
                }else{
                    $dssp_sp=getall_sanpham(0,0);
                }
                include "admin/view/shop.php";
                break;
            case 'spchitiet':
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    $id=$_GET['id'];
                    $kq=getone_sanpham($id);
                }
                include "admin/view/chitietsanpham.php";
                break;
            case 'danhgia':
                include "admin/view/danhgia.php";
                break;
            case 'lienhe':
                include "admin/view/lienhe.php";
                break;
            
        default:
            include "admin/view/home.php";
            break;
        }
    } else {
        include "admin/view/home.php";
    }
    include "admin/view/footer.php";
}
?>
