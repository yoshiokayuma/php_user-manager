<?php

$mail_address = isset($_POST['mail_address']) ? $_POST['mail_address'] : "";
$pass_word = isset($_POST['pass_word']) ? $_POST['pass_word'] : "";


if($is_too) {
    if(!empty($_SESSION['isLogin'])) {
        header("Location: ./list.php");
        exit;
    }
} else {
    if(empty($_SESSION[ 'isLogin'])) {
        header("Location: ./login.php");
        exit;
    }
}
