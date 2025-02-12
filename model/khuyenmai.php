<?php
function getall_khuyenmai() {
    $conn = connectdb();
    $sql = "SELECT khuyenmai.*, sanpham.tensanpham FROM khuyenmai 
            LEFT JOIN sanpham ON khuyenmai.id_sanpham = sanpham.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function them_km($tenkm, $mota, $ngaybatdau, $ngayketthuc, $phantramgiam, $id_sanpham) {
    $conn = connectdb();
    $sql = "INSERT INTO khuyenmai (ten, mota, ngaybatdau, ngayketthuc, phantramgiam, id_sanpham) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$tenkm, $mota, $ngaybatdau, $ngayketthuc, $phantramgiam, $id_sanpham]);
}

function del_km($id) {
    $conn = connectdb();
    $sql = "DELETE FROM khuyenmai WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}

function update_km($id, $tenkm, $mota, $ngaybatdau, $ngayketthuc, $phantramgiam, $id_sanpham) {
    $conn = connectdb();
    $sql = "UPDATE khuyenmai SET ten = ?, mota = ?, ngaybatdau = ?, ngayketthuc = ?, phantramgiam = ?, id_sanpham = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$tenkm, $mota, $ngaybatdau, $ngayketthuc, $phantramgiam, $id_sanpham, $id]);
}

function getone_km($id) {
    $conn = connectdb();
    $sql = "SELECT khuyenmai.*, sanpham.tensanpham FROM khuyenmai
            LEFT JOIN sanpham ON khuyenmai.id_sanpham = sanpham.id
            WHERE khuyenmai.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
