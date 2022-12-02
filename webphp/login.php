<?php
    $message = "";
    session_start();
    require 'connect.php';
    if (count($_POST) > 0) {
        $NAME_ACCOUNT = $_POST['NAME_ACCOUNT'];
        $PASSWORD_USE = $_POST['PASSWORD_USE'];
        $sql = "SELECT * FROM account_use WHERE NAME_ACCOUNT='" . $_POST["NAME_ACCOUNT"] . "' and PASSWORD_USE = '" . $_POST["PASSWORD_USE"] . "'";
        $result = mysqli_query($conn, $sql);
        $row  = mysqli_fetch_array($result);
    if (is_array($row)) {
        $_SESSION["ID"] = $row['ID'];
        $_SESSION["NAME_ACCOUNT"] = $row['NAME_ACCOUNT'];
        $_SESSION["NAME_USER"] = $row['NAME_USER'];
        $_SESSION["PHONE_NUMBER"] = $row['PHONE_NUMBER'];
        $_SESSION["ADDRESS_USER"] = $row['ADDRESS_USER'];

        sleep(5);
        header("Location:trangchu.php");
    } else {
        echo  "Invalid Username or Password!";
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
    <link rel="stylesheet" href="./css/login.css" type="text/css" />
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
                <div class="content-holder">
                    <button class="button-1">
                        <a href="./register.php">Đăng ký</a>
                    </button>
                </div>
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
                        <button class="login-button" type="submit">Đăng nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>