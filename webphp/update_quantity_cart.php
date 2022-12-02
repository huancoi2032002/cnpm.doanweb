<?php


    session_start();
    $ID = $_GET['ID'];
    $type = $_GET['type'];


    
    if($type === 'decre'){
        if($_SESSION['cart'][$ID]['quantity']>1){
            $_SESSION['cart'][$ID]['quantity']--;
        }else{
            unset($_SESSION['cart'][$ID]);
        }
    }elseif($_SESSION['cart'][$ID]['quantity'] < $_SESSION['cart'][$ID]['quantity_product']){
        $_SESSION['cart'][$ID]['quantity']++;
    }
    header('location:view_cart.php');