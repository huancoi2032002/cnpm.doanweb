<?php   
    
    session_start();
    //unset($_SESSION['cart']);
    $ID = $_GET['ID'];

    if(empty($_SESSION['cart'][$ID])){
        require 'connect.php';
        $sql = "SELECT * FROM product where ID = '$ID'";
        $result = mysqli_query($conn,$sql);
        $each = mysqli_fetch_array($result);
        $_SESSION['cart'][$ID]['img_product']=$each['img_product'];
        $_SESSION['cart'][$ID]['name_product']=$each['name_product'];
        $_SESSION['cart'][$ID]['price_product']=$each['price_product'];
        $_SESSION['cart'][$ID]['quantity_product']=$each['quantity_product'];
        
        $_SESSION['cart'][$ID]['quantity']=1;
    }else{
        $_SESSION['cart'][$ID]['quantity']++;
    }
    header('location:trangchu.php');