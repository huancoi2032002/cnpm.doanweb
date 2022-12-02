<?php
    
    
function executeResult($sql){
    require 'connect.php';
    $sql = "SELECT * From `product`";
    $data = [];
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result, 1)){
        $data[] = $row;
    }
    mysqli_close($conn);
    return $data;
}
