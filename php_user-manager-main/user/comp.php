<?php

$users_name = isset($_POST['users_name']) ? $_POST['users_name'] : "";
$mail_address = isset($_POST['mail_address']) ? $_POST['mail_address'] : "";
$pass_word = isset($_POST['pass_word']) ? $_POST['pass_word'] : "";

$errors = [];
try {
    //MySQLコネクタを作成
    $link = mysqli_connect("localhost","root","","test");

// DBコネクションを確立
if(!$link){
    die("コネクションエラー");
}

//メールアドレスの重複チェック
$query = "SELECT users_id  FROM users WHERE mail_address = ? LIMIT 1";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 's', $mail_address);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $district);
mysqli_stmt_fetch($stmt);
var_dump($district);

//メールアドレスが重複していた場合
if(!empty($district)) {
    //エラーで終了
    throw new Exception("メールアドレスが重複しています。");
}
//　メールアドレスが重複していなかった場合
else{
    //ユーザー登録
$query = "INSERT INTO users ( users_name , mail_address , pass_word , create_dt , upate_dt) VALUES ( ? , ? , ? , ? , ? ) ";
$stmt = mysqli_prepare($link,$query);
//パスワードを不可逆変換する
$cry_pass_word = md5($pass_word);
//現在日付を取得
$now_dt = date("Y-m-d H:i:s");
mysqli_stmt_bind_param($stmt, 'sssss', $users_name , $mail_address , $cry_pass_word , $now_dt , $now_dt);
mysqli_stmt_execute($stmt);
}

//DBコネクションを切断
mysqli_close($link);

}catch(\Exception $e){
    $errors[] = $e->getMessage();
}
?>
<!doctype html>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ユーザー登録</title>
  </head>
  <body>
    <h1>ユーザー登録</h1>
    <?php if( empty($errors) ) { ?>
    <div class="alert alert-success" role="alert">
        登録完了
    </div>
    <a href="./inpot.php" class="btn btn-info">入力画面へ</a>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo implode('<br>' , $errors) ?>
        </div>
        <form method="POST" action="./check.php">
        <div class="mb-3">
            <label for="users_name" class="form-label">users_name</label>
            <input type="text" class="form-control"  id="exampleInputName" name="users_name" aria-describedy="emailHelp" value="<?php echo $users_name; ?>">
        </div>
        <div class="mb-3">
            <label for="mail_address" class="form-label">mail_address</label>
            <input type="email" class="form-control"   id="exampleInputemail" name="mail_address"iaria-describedy="emalHelp" value ="<?php echo $mail_address; ?>">
        </div>
        <div class="mb-3">
            <label for="pass_word" class="form-label">password</label>
            <input type="pass_word" class="form-control" id="xampleInputPassword" name="pass_word"iaria-describedy="emalHelp" value ="<?php echo $pass_word; ?>">
        </div>
        <button type="submit" class="btn btn-primary">sgin in</button>
        </form>  
    <?php } ?>


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