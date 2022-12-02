<?php
    require '../connect.php';
    
    if(isset($_POST['btn-dang_nhap'])){
        $ACCOUNT = $_POST['NAME_ACCOUNT'];
        $PASSWORD = $_POST['PASSWORD_USE'];
        if($ACCOUNT == "admin" && $PASSWORD == "admin"){
            header('location:admin_home.php');
        }elseif($ACCOUNT != "admin" && $PASSWORD != "admin"){
            echo"Sai tài khoản hoặc mật khẩu";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/login.css" type="text/css" />
    <title>Document</title>
</head>

<body>
    <div class="login">
        <div class="error-login">
            <div id="error-login" class="error">
                <i class="fa fa-times-circle">ㅤSai tài khoản hoặc mật khẩu</i>
            </div>
        </div>
        <div class="container">
            <div class="box-1">
                
            </div>
            <div class="box-login">
                <div class="login-form-container">
                    <h1>Đăng nhập</h1>
                    <form method="POST" action="" role="form">
                        <div class="box-user">
                            <input type="text" name="NAME_ACCOUNT">
                        </div>
                        <div class="box-passwrod">
                            <input type="password" name="PASSWORD_USE">
                        </div>
                        <button class="login-button" type="submit" name="btn-dang_nhap">Đăng nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>