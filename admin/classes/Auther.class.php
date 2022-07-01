<?php

class Auther {

  const LOGIN_CHK_KEY = "islogin";

  private $sessionId = null;

  public function __construct()
  {
    session_start();
    $this->sessionId = session_id();
  }

  public function login_chk($is_top = false)
  {
    if($is_top) {
      if(!empty($_SESSION[ Auther::LOGIN_CHK_KEY ])) {
        header("Location: ./list.php");
        exit;
      }
    } else {
      if(empty($_SESSION[ Auther::LOGIN_CHK_KEY ])) {
        header("Location: ./login.php");
        exit;
      }
    }
  }

  public function login($mail_address, $pass_word)
  {
    if($mail_address === "aaa@aaa.com" && $pass_word === "aaa") {
      return true;
    } else {
      return false;
    }
  }
}
