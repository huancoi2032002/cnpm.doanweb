<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/history.css" type="text/css" />
    <title>Document</title>
</head>

<body>
    <?php 
        require 'connect.php';
        $ID = $_GET['ID'];
        $sql = "SELECT
            sums,
            receipt_detail.quantity,
            receipt_detail.product_id,
            receipt_detail.receipt_id,
            product.img_product,
            product.name_product,
            receipt_bill.status
        FROM
            receipt_bill
        JOIN account_use ON receipt_bill.ID_account = account_use.ID
        JOIN receipt_detail ON receipt_bill.ID = receipt_detail.receipt_id
        JOIN product ON receipt_detail.product_id = product.ID
        WHERE
            receipt_bill.ID_account = '$ID' AND receipt_bill.ID = receipt_detail.receipt_id;";
        $result = mysqli_query($conn,$sql);
    ?>
    <div class="header">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="contact">
                        <span>Hotline: <a href="tel:0349867919">0349867919</a></span>
                        <span>Email:hello.@gmal.com </span>
                    </div>
                    <div class="account">
                        <ul class="account_header">
                            <?php if (empty($_SESSION['ID'])) { ?>
                                <li><a href="register.php">Đăng ký</a></li>
                                <li><a href="login.php">Đăng nhập</a></li>
                            <?php } else
                                if ($_SESSION["NAME_ACCOUNT"]) {
                            ?>
                                <li><a href="#">Welcome <?php echo $_SESSION["NAME_ACCOUNT"]; ?>!</a><a href="logout.php" tite="Logout">ㅤLogout.</a>
                                <li>
                                <?php
                            }
                                ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner_title">
        <div class="banner_title_primary">
            <a href="trangchu.php"><i class="fa fa-shopping-bag"></i> SHOPㅤ|ㅤLịch sử mua hàng</a>
        </div>
    </div>
    <div class="div_cart">
        <div class="title_product">
            <p class="title_sp">Sản Phẩm</p>
            <p class="title_quantity">Số Lượng</p>
            <p class="title_sum">Tổng Tiền</p>
            <p class="title_tt">Trạng Thái</p>
        </div>
        <div class="menu_product_history">
            <?php foreach ($result as  $each) : ?>
                <div class="menu_cart_product">
                    
                        <div class="title_sp">
                            <div class="img_product"><img src="<?php echo $each['img_product'] ?>"></div>
                            <div class="name_product">
                                <p class="name_product_detail"><?php echo $each['name_product'] ?></p>
                            </div>
                        </div>
                        <div class="quantity">
                            <div class="quantity_detail">
                                <?php
                                echo $each['quantity'];
                                ?>
                            </div>
                        </div>
                        <div class="price_sum">
                            <p class="price_sum_detail">
                                <?php
                                    echo $each['sums'] 
                                ?>
                                VND
                            </p>
                        </div>
                        <div class="title_tt">
                            <p>
                                <?php
                                    switch($each['status']){
                                        case '0':
                                            echo "Chờ xác nhận";
                                            break;
                                        case '1':
                                            echo"Đã xác nhận";
                                            break;
                                        case '2':
                                            echo"Đã hủy";
                                            break;
                                    }
                                ?>
                            </p>
                        </div>
                    
                </div>
            <?php endforeach ?>
        </div>
            
        

    </div>

    <div></div>
</body>

</html>