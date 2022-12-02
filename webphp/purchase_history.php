<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/history.css" type="text/css" />
    <style>
        *{
    padding: 0px;
    margin: 0px;
            }
            .body_admin{
            display: flex;
            }

            .menu_admin{
                width: 17%;
                height: 790px;
                background-color: #172d44;
                border-radius: 5px;
                border: 3px solid #172d44;
            }
            .account_admin{
                width: 100%;
                box-sizing: border-box;
                height: 150px;
                border-bottom:3px solid #333333;
            }
            .account_admin .img_admin{
                margin-top: 10px;
                height: 80px;
                text-align: center;
            }
            .account_admin img{
                max-height: 80px;
                width: auto;
                border-radius: 50%;
            }
            .account_admin .name_admin{
                text-align: center;
                margin-top: 10px;
                font-size: 18px;
                color: #fff;
            }

            .content_admin{
                height: 40px;
                width: 83%;
                background-color: #172d44;
                text-align: center;
                color: #fff;
            }
            .menu {
                margin-top: 20px;
            }
            .menu_item{
                height: 60px;
            }
            .menu_item a{
                font-size: 17px;
                color: #fff;
                text-decoration: none;
            }
            .menu_item:hover{
                background-color: #333333;
                display: block;
            }
            .menu_link{
                margin-left: 30px;
                display: flex;
            }
            .menu_link .icon{
                margin-top: 22px;
                margin-right: 10px;
            }
            .menu_link .title{
                margin-top: 22px;
            }

            /*--------------*/
            .menu_product{
                width: 30%;
                height: 790px;
                border: 3px solid black;
                border-radius: 4px;
                margin-left: 2%;
            }
            .menu_product .banner_add{
                height: 40px;
                background-color: #172d44;
                color: #fff;
                text-align: center;
            }
            .menu_product .banner_add .title_add{
                font-size: 20px;
                padding: 6px;
            }
            .add_product{
                width: 100%;
            }
            .add_product .title_product{
                margin-left: 10px;
                margin-top: 20px;
                font-size: 17px;
            }
            .add_product input{
                width: 100%;
                box-sizing: border-box;
                height: 38px;
                border-radius: 4px;
            }
            .add_product .describe{
                height: 150px;
                width: 100%;
                box-sizing: border-box;
            }
            .add_product button{
                width: 100%;
                height: 38px;
                box-sizing: border-box;
                background-color: #172d44;
                cursor: pointer;
                margin-top: 20px;
                border-radius: 4px;
            }
            .add_product button a{
                text-decoration: none;
                color: #fff;
                font-size: 16px;
            }


            .list_product{
                width: 47%;
                height: 790px;
                border: 3px solid #172d44;
                margin-left: 2%;
            }
            .list_product .banner_list{
                height: 40px;
                width: 100%;
                background-color: #172d44;
                color: #fff;
                text-align: center;
            }
            .list_product .banner_list .title_list{
                font-size: 20px;
                padding: 6px;
            }
            .list_product .view_product {
                
            }
            .view_product_title {
                display: flex;
                width: 100%;
                text-align: center;
                font-size: 17px;
                margin-top: 10px;
                margin-bottom: 20px;
            }
            .view_product_title .title_id{
                width: 5%;
            }
            .view_product_title .title_img{
                width: 25%;
            }
            .view_product_title .title_name{
                width: 20%;
            }
            .view_product_title .title_classify{
                width: 15%;
            }
            .view_product_title .title_price{
                width: 15%;
            }
            .view_product_title .title_quantiry{
                width: 10%;
            }

            .view_product_detail{
                width: 100%;
                display: flex;
                border: 1px solid black;
                height: 100px;
                text-align: center;
                font-size: 16px;
                box-sizing: border-box;
                margin-bottom: 10px;
            }

            .view_product_detail .id_product{
                width: 5%;
            }
            .view_product_detail .img_product{
                width: 25%;
                height: 100px;
                box-sizing: border-box;
            }
            .view_product_detail .img_product img{
                height: 100px;
                width: 100px;
                box-sizing: border-box;
                
            }
            .view_product_detail .name_product{
                width: 20%;
            }
            .view_product_detail .classify_product{
                width: 15%;
            }
            .view_product_detail .price_product{
                width: 15%;
            }
            .view_product_detail .quantity_product{
                width: 10%;
            }
            .view_product_detail .function{
                width: 10%;
                height: 100px;
            }
            .view_product_detail .p_product{
                margin-top: 20px;
            }

            .view_product_detail .function a {
                font-size: 20px;
                color: black;
            }

            .view_product_detail .function .delete_product{
                height: 40px;
                margin-top: 15px;
            }
    </style>
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
            product.name_product
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
            <p class="title_sum">Tổng tiền</p>
        </div>
        
            <div class="menu_cart_product">
                <?php foreach ($result as  $each) : ?>
                    <div class="img_product"><img src="<?php echo $each['img_product'] ?>"></div>
                    <div class="name_product">
                        <p class="name_product_detail"><?php echo $each['name_product'] ?></p>
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
                        </p>
                    </div>
                <?php endforeach ?>
            </div>
        

    </div>

    <div></div>
</body>

</html>