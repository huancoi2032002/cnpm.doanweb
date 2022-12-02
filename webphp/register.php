<?php 
    require 'connect.php';
    $err = [];
    if(isset($_POST['btn_login'])){
        $error = array();
        
        
        $NAME_USER = $_POST['NAME_USER'];
        $PHONE_NUMBER = $_POST['PHONE_NUMBER'];
        $ADDRESS_USER = $_POST['ADDRESS_USER'];
        //Name_account
        if(empty($_POST['NAME_ACCOUNT'])){
            $error['NAME_ACCOUNT'] = "Bạn cần nhập dữ liệu";

        }else{
            if(strlen($_POST['NAME_ACCOUNT']) < 6){
                $error['NAME_ACCOUNT'] = "Tên tài khoản trên 6 kí tự";
            }else{
                $NAME_ACCOUNT = $_POST['NAME_ACCOUNT'];
            }
        }
        //Email
        if(empty($_POST['EMAIL_ACCOUNT'])){
            $error['EMAIL_ACCOUNT'] = "Bạn cần nhập dữ liệu";

        }else{
            $parttern = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/";
            if(!preg_match($parttern, $_POST['EMAIL_ACCOUNT'])){
                $error['EMAIL_ACCOUNT'] = "Email không đúng định dạng";
            }else{
                $EMAIL_ACCOUNT = $_POST['EMAIL_ACCOUNT'];
            }
        }
        //Password
        if(empty($_POST['PASSWORD_USE'])){
            $error['PASSWORD_USE'] = "Bạn cần nhập dữ liệu";

        }else{
            if(strlen($_POST['PASSWORD_USE']) < 6){
                $error['PASSWORD_USE'] = "Mật khẩu trên 6 kí tự";
            }else{
                $PASSWORD_USE = $_POST['PASSWORD_USE'];
            }
        }
        //PASSWORD_REPEAT
        if(empty($_POST['PASSWORD_REPEAT'])){
            $error['PASSWORD_REPEAT'] = "Bạn cần nhập dữ liệu";

        }else{
            if($_POST['PASSWORD_USE'] != $_POST['PASSWORD_REPEAT']){
                $error['PASSWORD_REPEAT'] = "Mật khẩu nhập lại không đúng";
            }
        }
        //NAME_USER
        if(empty($_POST['NAME_USER'])){
            $error['NAME_USER'] = "Bạn cần nhập dữ liệu";
            
        }else{
            $NAME_USER = $_POST['NAME_USER'];
        }
        //PHONE_NUMBER
        
        //ADDRESS_USER
        if(empty($_POST['ADDRESS_USER'])){
            $error['ADDRESS_USER'] = "Bạn cần nhập dữ liệu";
        }else{
            $ADDRESS_USER = $_POST['ADDRESS_USER'];
        }
        if(empty($error)){
            $sql = "INSERT into `account_use`(`NAME_ACCOUNT`,`EMAIL_ACCOUNT`,`PASSWORD_USE`,`NAME_USER`,`PHONE_NUMBER`,`ADDRESS_USER`)
            values ('$NAME_ACCOUNT','$EMAIL_ACCOUNT','$PASSWORD_USE','$NAME_USER','$PHONE_NUMBER','$ADDRESS_USER') ";
            if($conn->query($sql)===TRUE){
                echo"<h3>Đăng kí tài khoản thành công</h3>";
            }
        }
        //if(empty($PASSWORD_USE != $PASSWORD_REPEAT)){
        //    $err['PASSWORD_REPEAT'] = 'Mật khẩu nhập lại không chính xác';
        //}
        //var_dump(empty($err));
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./css/register.css" type="text/css" />
    <style>
        
    </style>
    <title>Document</title>
</head>

<body>
    
    <div class="register">
        <div class="Notification">
            <div class="register-check" id="Notification">
                <i class="fa fa-check-circle">ㅤĐăng ký thành công</i>
            </div>
        </div>

        <div class="container">
            <div class="box-1">
                <div class="content-holder">
                    <button class="button-2">
                        <a href="./login.php">Đăng nhập</a>
                    </button>
                </div>
            </div>

            <div class="box-2">
                <div class="signup-form-container">
                    <h1>Đăng ký</h1>
                    <form method="post" action="">
                        <div class="box-signup">
                            <input type="text" placeholder="Họ và tên" id="password-repeat" name="NAME_USER"/>
                            <div class="err_" style="margin-left: -115px; color: red;">
                                <?php 
                                    if(isset($error['NAME_USER'])){
                                ?>
                                    <span><?php echo $error['NAME_USER'];  ?></span>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="box-signup">
                            <input type="text" placeholder="Tên tài khoản" id="user" name="NAME_ACCOUNT" />
                            <div class="err_" style="margin-left: -115px; color: red;">
                                <?php 
                                    if(isset($error['NAME_ACCOUNT'])){
                                ?>
                                    <span><?php echo $error['NAME_ACCOUNT'];  ?></span>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="box-signup">
                            <input type="email" placeholder="Email@gmail.com" id="email" name="EMAIL_ACCOUNT" />
                            <div class="err_" style="margin-left: -115px; color: red;">
                                <?php 
                                    if(isset($error['EMAIL_ACCOUNT'])){
                                ?>
                                    <span><?php echo $error['EMAIL_ACCOUNT'];  ?></span>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="box-signup">
                            <input type="password" placeholder="Mật khẩu" id="password" name="PASSWORD_USE" />
                            <div class="err_" style="margin-left: -115px; color: red;">
                                <?php 
                                    if(isset($error['PASSWORD_USE'])){
                                ?>
                                    <span><?php echo $error['PASSWORD_USE'];  ?></span>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="box-signup">
                            <input type="password" placeholder="Nhập lại mật khẩu" id="password-repeat" name="PASSWORD_REPEAT"/>
                            <div class="err_" style="margin-left: -115px; color: red;">
                                <?php 
                                    if(isset($error['PASSWORD_REPEAT'])){
                                ?>
                                    <span><?php echo $error['PASSWORD_REPEAT'];  ?></span>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="box-signup">
                            <input type="text" placeholder="Số điện thoại" id="password-repeat" name="PHONE_NUMBER"/>
                            <div class="err_" style="margin-left: -115px; color: red;">
                                <?php 
                                    if(isset($error['PHONE_NUMBER'])){
                                ?>
                                    <span><?php echo $error['PHONE_NUMBER'];  ?></span>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="box-signup">
                            <input type="text" placeholder="Địa chỉ" id="password-repeat" name="ADDRESS_USER"/>
                            <div class="err_" style="margin-left: -115px; color: red;">
                                <?php 
                                    if(isset($error['ADDRESS_USER'])){
                                ?>
                                    <span><?php echo $error['ADDRESS_USER'];  ?></span>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        
                        <button class="signup-button" type="submit" name="btn_login">
                            Đăng ký
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>