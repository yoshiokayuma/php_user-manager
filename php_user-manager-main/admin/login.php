<?php
  require_once __DIR__ . "/classes/Auther.class.php";
  $auther = new Auther();

$users_name = isset($_POST['users_name']) ? $_POST['users_name'] : "";
$mail_address = isset($_POST['mail_address']) ? $_POST['mail_address'] : "";
$pass_word = isset($_POST['pass_word']) ? $_POST['pass_word'] : "";

  // ユーザー登録のバリエーションを入れる
  $errors = [
    ' mail_address' => [] ,
    ' pass_word' => [] ,
  ];
  //メールアドレスのバリエーション
    if($mail_address === ""){
      $errors["mail_address"][]="Mail_addressが未入力です。";
  }
  if (!preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $mail_address)) {
     $errors['mail_address'][] = "Mail Addressのフォーマットが不正です。";
  }
  //パスワードのバリエーション
  if($pass_word === ""){
    $errors['pass_word'][] = "passwordが未入力です。";
  }

  if( empty($errors['mail_address']) && empty($errors['pass_word']) ) {
    //ログインチェック
    if($auther->login($mail_address,$pass_word)) {
      $_SESSION[Auther::LOGIN_CHK_KEY] = true;
    }
  }
$auther->login_chk(true);

?>

<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ログイン　管理画面</title>
  </head>
  <body>
    <h1>ログイン　管理画面</h1>
    <?php if(   !empty($errors['pass_word']) ||
                !empty($errors['mail_address']) ) { ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach($errors['mail_address'] as $error) {?>
                <?php echo $error; ?><br>
            <?php } ?>
            <?php foreach($errors['pass_word'] as $error) {?>
                <?php echo $error; ?><br>
            <?php } ?>
        </div>
        <?php } ?>

        <form class= "container" method="POST" action="./login.php">
            <div class="row mb-3">
                <label for="mail_address" class="col-sm-2 col-form-label">Mail_Adress</label>
                <div class="col-sm-10">
                <input type="mail" class="form-control <?php if( !empty($errors['mail_address']) ) echo "border-danger text-danger"; ?>" id="mail" name="mail_address" value ="<?php echo $mail_address;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="pass_word" class="col-sm-2 col-form-label">PassWord</label>
                <div class="col-sm-10">
                <input type="password" class="form-control <?php if( !empty($errors['pass_word']) ) echo "border-danger text-danger"; ?>" id="pass"name="pass_word" value ="<?php echo $pass_word;?>">
                </div>
            </div>
            <button type= "submit" class="btn btn-primary">Sign in</button>
    </form>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>