<?php 
    if(isset($_POST['btn_dat_hang'])){
        require 'connect.php';
        $address_receiver = $_POST['address_receiver'];
        $PHONE_NUMBER = $_POST['PHONE_NUMBER'];
        $ship = $_POST['ship'];        
        session_start();
                    
        $NAME_USER =  $_SESSION['NAME_USER'];
        $cart = $_SESSION['cart'];
        $sums = 0;
        foreach($cart as $each){
            $sums += $each['price_product']*$each['quantity'];
        } 
        $ID_account = $_SESSION['ID'];
        $status = 0;
                
                
                
        $sql = "INSERT into receipt_bill(ID_account,name_receiver,phone_receiver, address_receiver, status, ship, sums)
        values('$ID_account','$NAME_USER','$PHONE_NUMBER','$address_receiver', '$status', '$ship', '$sums')  ";
        $result = mysqli_query($conn,$sql);      
        if($result){
            foreach($cart as $product_id => $each){
                $receipt_id  = mysqli_insert_id($conn);
                $quantity = $each['quantity'];
                $sql_product = "INSERT into receipt_detail(receipt_id, product_id, quantity)
                values ('$receipt_id', '$product_id', '$quantity')";
                mysqli_query($conn,$sql_product);
            }  
        }
        foreach($cart as $ID => $each){
            $quantity = $_SESSION['cart'][$ID]['quantity'];
            $quantity_product = $_SESSION['cart'][$ID]['quantity_product'];
            $change_quantity = $quantity_product - $quantity;
            $sql = "UPDATE product 
            SET
                quantity_product='$change_quantity' 
            WHERE ID=$ID;";
            mysqli_query($conn, $sql);
        }
            
                    
        
        
        mysqli_close($conn);
        unset($_SESSION['cart']);
        header('location:trangchu.php');
    }
    