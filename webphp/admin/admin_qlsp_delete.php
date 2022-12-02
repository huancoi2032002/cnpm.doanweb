<?php
    require '../connect.php';
    $ID = $_GET['ID'];
    $sql = "DELETE FROM `product` WHERE ID=$ID;";

    // 3. Thực thi câu lệnh DELETE
    mysqli_query($conn, $sql);

    // 4. Đóng kết nối
    mysqli_close($conn);
    header('location:admin_qlsp.php');
    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sác