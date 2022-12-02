<?php
    $conn = new  mysqli('localhost','root','','webphp');
    mysqli_set_charset($conn, 'utf8');

    if($conn->connect_errno){
        echo "thanh cong";
    }

