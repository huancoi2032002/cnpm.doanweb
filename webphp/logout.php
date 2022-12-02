<?php
    session_start();
    unset($_SESSION["ID"]);
    unset($_SESSION["NAME_ACCOUNT"]);
    header("Location:login.php");
    