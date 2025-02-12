<?php
function themdm($tenloai){
    $conn = connectdb();
    $sql = "INSERT INTO loaisanpham (tenloai)
    VALUES ('".$tenloai."')";
    // use exec() because no results are returned
    $conn->exec($sql);
}
function getall_dm(){
    $conn = connectdb(); // Gán đối tượng kết nối trả về từ hàm connectdb cho biến $conn
    $stmt = $conn->prepare("SELECT * FROM loaisanpham");
    $stmt->execute();
    $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}
function del_dm($id){
    $conn = connectdb();
    $sql = "DELETE FROM loaisanpham WHERE id=".$id;

    // use exec() because no results are returned
    $conn->exec($sql);
}
function getone_dm($id){
    $conn = connectdb(); // Gán đối tượng kết nối trả về từ hàm connectdb cho biến $conn
    $stmt = $conn->prepare("SELECT * FROM loaisanpham WHERE id=".$id);
    $stmt->execute();
    $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}
function update_dm($id,$tenloai){
    $conn=connectdb();
    $sql = "UPDATE loaisanpham SET tenloai='".$tenloai."' WHERE id=".$id;

  // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();
}

function get_loai_sanpham($id) {
    $conn = connectdb();
    $sql = "SELECT tenloai FROM loaisanpham WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['tenloai'];
}

?>
