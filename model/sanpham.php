<?php
function insert_sanpham($loaisanpham_id, $tensanpham, $mota, $gia, $ngaytao, $ngaycapnhat, $soluong = 0, $trangthai = 1, $luotxem = 0) {
    $conn = connectdb();
    $sql = "INSERT INTO sanpham (loaisanpham_id, tensanpham, mota, gia, ngaytao, soluong, trangthai, luotxem, ngaycapnhat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$loaisanpham_id, $tensanpham, $mota, $gia, $ngaytao, $soluong, $trangthai, $luotxem, $ngaycapnhat]);
    return $conn->lastInsertId(); // Trả về ID của sản phẩm vừa thêm
}



function insert_hinhanh($sanpham_id, $hinhanh) {
    $conn = connectdb();
    $sql = "INSERT INTO hinhanh_sanpham (sanpham_id, hinhanh) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$sanpham_id, $hinhanh]);
}
// File model/sanpham.php
function getall_sanpham($iddm,$view) {
    $conn = connectdb(); // Gán đối tượng kết nối trả về từ hàm connectdb cho biến $conn
    $sql = "SELECT * FROM sanpham WHERE 1";
    if($iddm>0){
        $sql.=" AND loaisanpham_id=".$iddm;
    }
    if ($view == 1) {
        $sql.=" ORDER BY luotxem DESC";
    } else {
        $sql.=" ORDER BY id DESC";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}



function getall_hinhanh_by_sanpham($sanpham_id) {
    $conn = connectdb();
    $sql = "SELECT * FROM hinhanh_sanpham WHERE sanpham_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$sanpham_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function del_sanpham($id) {
    $conn = connectdb();
    
    // Lấy tất cả các hình ảnh liên quan đến sản phẩm
    $sql = "SELECT hinhanh FROM hinhanh_sanpham WHERE sanpham_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Xóa các tệp hình ảnh từ thư mục uploads
    foreach ($images as $image) {
        $file_path = "../uploads/" . $image['hinhanh'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Xóa tất cả các hình ảnh liên quan đến sản phẩm trong cơ sở dữ liệu
    $sql = "DELETE FROM hinhanh_sanpham WHERE sanpham_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    // Sau đó xóa sản phẩm
    $sql = "DELETE FROM sanpham WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}
function del_hinhanh($id) {
    $conn = connectdb();
    
    // Lấy tên tệp hình ảnh
    $sql = "SELECT hinhanh FROM hinhanh_sanpham WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Xóa tệp hình ảnh từ thư mục uploads
    if ($image) {
        $file_path = "../uploads/" . $image['hinhanh'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    
    // Xóa hình ảnh từ cơ sở dữ liệu
    $sql = "DELETE FROM hinhanh_sanpham WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}

function getone_sanpham($id) {
    $conn = connectdb(); // Gán đối tượng kết nối trả về từ hàm connectdb cho biến $conn
    $sql = "SELECT sanpham.*, GROUP_CONCAT(hinhanh_sanpham.hinhanh SEPARATOR '|') as hinhanh
            FROM sanpham
            LEFT JOIN hinhanh_sanpham ON sanpham.id = hinhanh_sanpham.sanpham_id
            WHERE sanpham.id = ?
            GROUP BY sanpham.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch(); // Trả về một mảng liên kết chứa thông tin của một sản phẩm cùng với hình ảnh
}
function update_sanpham($id, $loaisanpham_id, $tensanpham, $mota, $gia, $ngaycapnhat, $soluong, $trangthai, $luotxem) {
    $conn = connectdb();
    $sql = "UPDATE sanpham 
            SET loaisanpham_id = ?, tensanpham = ?, mota = ?, gia = ?, ngaycapnhat = ?, soluong = ?, trangthai = ?, luotxem = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$loaisanpham_id, $tensanpham, $mota, $gia, $ngaycapnhat, $soluong, $trangthai, $luotxem, $id]);
}

// Hàm lấy tổng số sản phẩm
function get_products_by_page($offset, $limit, $category_id = null) {
    $conn = connectdb();
    if ($category_id) {
        $sql = "SELECT * FROM sanpham WHERE loaisanpham_id = :category_id LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    } else {
        $sql = "SELECT * FROM sanpham LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
    }
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function get_total_products($category_id = null) {
    $conn = connectdb();
    if ($category_id) {
        $sql = "SELECT COUNT(*) FROM sanpham WHERE loaisanpham_id = :category_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    } else {
        $sql = "SELECT COUNT(*) FROM sanpham";
        $stmt = $conn->prepare($sql);
    }
    $stmt->execute();
    return $stmt->fetchColumn();
}


?>
