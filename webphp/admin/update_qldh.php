<?php
    $ID = $_GET['ID'];
    $status = $_GET['status'];
    require '../connect.php';

    $sql = "UPDATE receipt_bill SET status = $status where ID = '$ID'";
    mysqli_query($conn,$sql);
    header('location:admin_qldh.php');
