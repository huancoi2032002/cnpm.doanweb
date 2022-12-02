<?php 
    session_start();
    require 'connect.php';
    if(isset($_POST['btn_fix_account'])){
        $ID = $_SESSION['ID'];
        $NAME_USER = $_POST['NAME_USER'];
        $PHONE_NUMBER = $_POST['PHONE_NUMBER'];
        $ADDRESS_USER = $_POST['ADDRESS_USER'];
        $DATE_BIRTHDAY = $_POST['DATE_BIRTHDAY'];
        $SEX = $_POST['SEX'];

        $truy_van = "UPDATE `account_use`
        
        set
        NAME_USER = '$NAME_USER',
        PHONE_NUMBER = '$PHONE_NUMBER',
        ADDRESS_USER = '$ADDRESS_USER',
        DATE_BIRTHDAY = '$DATE_BIRTHDAY',
        SEX = '$SEX'

        where
        ID = '$ID'
        ";
        mysqli_query($conn,$truy_van);
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/user.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
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
                                <li><a href="info_user.php">Welcome <?php echo $_SESSION["NAME_ACCOUNT"]; ?>!</a><a href="logout.php" tite="Logout">ㅤLogout.</a><li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header_menu">
        <div class="container">
            <div class="row">
                <div class="main_menu">
                    <nav class="header-nav">
                        <ul class="item_big">
                            <li class="nav-item">
                                <a href="./index.html"><span>Trang chủ</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="./sanpham.html"><span>Sản phẩm</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="./tintuc.html"><span>Tin tức</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="./cauhoi.html"><span>Câu hỏi</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header_search">
                    <form id="search-form">
                        <input id="search-text" type="text" name="search" placeholder="Tìm kiếm sản phẩm..." />
                        <button type="submit" id="search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <div class="header-right">
                    <div class="cartgroup">
                        <div class="mini-cart">
                            <a class="img_hover_cart" href="#" title="giỏ hàng">
                                <button id="cart"><i class="fa fa-shopping-bag"></i></button>
                                <span class="item_cart so-sp-gio-hang">0 </a></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        $ID = $_SESSION['ID'];
        require 'connect.php';
        $sql = "SELECT * FROM account_use where ID = '$ID'";
        $result = mysqli_query($conn,$sql);
        $each = mysqli_fetch_array($result);
    ?>
    <div class="body">
        <div class="title_fix">
            <div class="title_fix_detail">
                <p class="title_file">Hồ sơ của tôi</p>
                <p class="title_1">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
            </div>
        </div>
        <div class="body_box">
            <form method="post" role="form">
                <div class="body_fix">
                    <div class="body_fix_detail">
                        <div class="div_box">
                            <div class="box_1">
                                <p class="name_account">Tên đăng nhập: </p>
                            </div>
                            <div class="box_2">
                                <p class="name_account"><?php echo $each['NAME_ACCOUNT'] ?></p>
                            </div>
                        </div>
                        <div class="div_box">
                            <div class="name_user_1">
                                <p class="name_user">Tên: </p>
                            </div>
                            <div class="name_user_2">
                                <input name="NAME_USER" class="name_user" value='<?php echo $each['NAME_USER'] ?>'>
                            </div>
                        </div>
                        <div class="div_box">
                            <div class="box_1">
                                <p class="email_user">Email: </p>
                            </div>
                            <div class="box_2">
                                <p class="email_user"><?php echo $each['EMAIL_ACCOUNT'] ?></p>
                            </div>
                        </div>
                        <div class="div_box">
                            <div class="box_1">
                                <p class="phone_user">Số điện thoại: </p>
                            </div>
                            <div class="box_2">
                                <input type="text" name="PHONE_NUMBER" value='<?php echo $each['PHONE_NUMBER'] ?>'>
                            </div>
                        </div>
                        <div class="div_box">
                            <div class="box_1">
                                <p>Giới tính: </p>
                            </div>
                            <div class="box_2">
                                
                                    <input type="radio" placeholder="Nam" name="SEX" <?php if (isset($SEX) && $SEX == 'Nam') echo "selected=\"selected\"";?> <?php if($each['SEX']=="Nam"){echo "checked";} ?> value="Nam">
                                    <label>Nam</label>
                                    <input type="radio" placeholder="Nữ" name="SEX" <?php if (isset($SEX) && $SEX == 'Nữ') echo "selected=\"selected\"";  ?> <?php if($each['SEX']=="Nữ"){echo "checked";} ?>  value="Nữ">
                                    <label>Nữ</label>
                                    <input type="radio" placeholder="Khác" name="SEX" <?php if (isset($SEX) && $SEX == 'Khác') echo "selected=\"selected\"";  ?> <?php if($each['SEX']=="Khác"){echo "checked";} ?>  value="Khác">
                                    <label>Khác</label>
                            
                            </div>
                        </div>
                        <div class="div_box">
                            <div class="box_1">
                                <p>Ngày sinh: </p>
                            </div>
                            <div class="box_2">
                                <input name="DATE_BIRTHDAY" type="date" value='<?php echo $each['DATE_BIRTHDAY'] ?>'>
                            </div>
                        </div>
                        <div class="div_box">
                            <div class="box_1">
                                <p>Địa chỉ: </p>
                            </div>
                            <div class="box_2">
                                <input name="ADDRESS_USER" type="text" value='<?php echo $each['ADDRESS_USER'] ?>'>
                            </div>
                        </div>   
                    </div>
                    <div class="btn">
                        <button name="btn_fix_account">Lưu</button>
                    </div>
                </div>
            </form>
            <div class="img_user">
                <div class="img">
                    <img src="<?php echo $each['IMG_USER'] ?>">
                </div>
                <div class="upload_img">
                    <input type="file">
                    <p>Dụng lượng file tối đa 1 MB</p>
                    <p>Định dạng:.JPEG, .PNG</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="right_footer">
                    <h4 class="title-name">
                        <span>Chúng tôi là ai?</span>
                    </h4>
                    <ul>
                        <li>Cong Ty TNHH Thoi Trang CNPM</li>
                        <li>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </li>
                        <li>
                            Địa chỉ: 273 An D. Vương, Phường 3, Quận 5, Thành phố Hồ Chí
                            Minh 700000
                        </li>
                        <li>Điện thoại: 1900 2002 - Email: support@cnpm.vn</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>