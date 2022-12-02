<?php
    $OrderID = $_GET['OrderID'];
    $status_order = 1;
    require '../connect.php';

    $sql = "UPDATE order_bill SET status_order = '$status_order' where OrderID = '$OrderID'";
    mysqli_query($conn,$sql);
    header('location:admin_qlnn.php');
