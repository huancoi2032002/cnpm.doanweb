<?php
    ini_set('display_errors', 'OFF');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/view_cart.css" type="text/css" />
    <title>Document</title>
</head>
<body>
    <?php

        session_start();
        $cart = $_SESSION['cart'];
        $sum = 0;
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
                            <?php if(empty($_SESSION['ID'])){ ?>
                                <li><a href="register.php">Đăng ký</a></li>
                                <li><a href="login.php">Đăng nhập</a></li>
                            <?php }else
                                if($_SESSION["NAME_ACCOUNT"]) {
                            ?>
                                <li><a href="#">Welcome <?php echo $_SESSION["NAME_ACCOUNT"]; ?>!</a><a href="logout.php" tite="Logout">ㅤLogout.</a><li>
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
            <a href="trangchu.php"><i class="fa fa-shopping-bag"></i> SHOPㅤ|ㅤGiỏ Hàng</a>
        </div>
    </div>
    <div class="div_cart">
        <div class="title_product">
            <p class="title_sp">Sản Phẩm</p>
            <p class="title_price">Đơn Giá</p>
            <p class="title_quantity">Số Lượng</p>
            <p class="title_sum">Số Tiền</p>
            <p class="title_tt">Thao Tác</p>
        </div>
        <?php foreach ($cart as $ID => $each): ?>
        <div class="menu_cart_product">
            <div class="img_product"><img src="<?php echo $each['img_product'] ?>" ></div>
            <div class="name_product"><p class="name_product_detail"><?php echo $each['name_product'] ?></p></div>
            <div class="price_product"><p class="price_product_detail"><?php echo $each['price_product'] ?></p></div>
            <div class="quantity">
                <div class="quantity_detail">
                    <a href="update_quantity_cart.php?ID=<?php echo $ID ?>&type=decre" class="decre"><i class="fa fa-minus"></i></a>
                    
                    <?php  
                        echo $each['quantity'];
                    ?>

                    <a href="update_quantity_cart.php?ID=<?php echo $ID ?>&type=incre" class="incre"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="price_sum">
                <p class="price_sum_detail">
                    <?php 
                        $result = $each['price_product']*$each['quantity'];
                        echo $result;
                        $sum += $result;
                        $sums = $sum +30000;
                     ?>
                </p>
            </div>
            <div class="function">
                <div class="function_detail">
                    <a href="delete_from_cart.php?ID=<?php echo $ID ?>" class="">
                        Xóa
                    </a>
                </div>
            </div >
        </div>
        <?php endforeach ?>
        <?php
            $ID = $_SESSION['ID'];
            require 'connect.php';
            $sql = "SELECT * FROM account_use where ID = '$ID'";
            $result = mysqli_query($conn,$sql);
            $each = mysqli_fetch_array($result);
        ?>
        <form method="post" action="process_checkout.php">
            <div class="pay_product">
                <div>
                    <div>
                        <p class="title_pay">Thanh Toán</p>
                    </div>
                    
                        <div class="use_information">
                            <label class="information_dc" >Địa chỉ nhận hàng:</label>
                            <input name="address_receiver" value='<?php echo $each['ADDRESS_USER'] ?>'>
                            <br>
                            <br>
                            <label class="information_dc" >Số điện thoại:</label>
                            <input name="PHONE_NUMBER" value='<?php echo $each['PHONE_NUMBER'] ?>'>
                            <div class="method">
                                
                                <br>
                                <p class="information_pay">Phương thức thanh toán:</p>
                                <select name="ship" class="method_pay">
                                    <option>--Chọn--</option>
                                    <option value="COD" >Thanh toán khi nhận hàng</option>
                                    <option value="Banking">Banking</option>
                                </select>
                            </div>
                            <div class="total">
                                <div class="total_title">
                                    <p class="total_money">
                                        Tổng tiền hóa đơn:   
                                    </p>
                                    <p class="total_money">Phí vận chuyển:  </p>
                                    <p class="total_money">Tổng tiền:  </p>
                                </div>
                                <div class="totle_money">
                                    <p class="money"><?php echo $sum ?>đ</p>
                                    <p class="money">30000đ</p>
                                    <p class="money"><?php echo $sums ?>đ</p>
                                </div>
                            </div>
                        </div>
                        </div >
                            <div class="btn" >
                                <button name="btn_dat_hang"><a >Đặt hàng</a>
                            </button></div>
                        </div>
                    
                </div>
            </div>
        </form>     
    </div>
    
    <div></div>
</body>
</html>