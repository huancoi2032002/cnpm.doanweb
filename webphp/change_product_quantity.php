<?php 
    require 'connect.php';
    session_start();
    $cart = $_SESSION['cart'];
    foreach($cart as $ID => $each){
        $quantity = $_SESSION['cart'][$ID]['quantity'];
        $quantity_product = $_SESSION['cart'][$ID]['quantity_product'];
        $change_quantity = $quantity_product - $quantity;
        echo $change_quantity;
        $sql = "UPDATE `product` 
        SET
         quantity_product='$change_quantity' 
        WHERE ID=$ID;";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location:trangchu.php');
    }
    
   