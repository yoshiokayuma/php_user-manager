<?php

require_once __DIR__ . "/classes/Auther.class.php";
$auther = new Auther();

$users_id = isset($_POST['users_id']) ? $_POST['users_id'] : "";
$users_name = isset($_POST['users_name']) ? $_POST['users_name'] : "";
$mail_address = isset($_POST['mail_address']) ? $_POST['mail_address'] : "";
$pass_word = isset($_POST['pass_word']) ? $_POST['pass_word'] : "";


$errors = [
    "users_name" => [] ,
    "mail_address" => [] ,
    "pass_word" => [] ,
];
if($users_name === ""){
    $errors["users_name"][]="UseraNameが未入力です。";
}
if($mail_address === ""){
    $errors["mail_address"][]="Mail_addressが未入力です。";
}
if (!preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $mail_address)) {
    $errors['mail_address'][] = "Mail Addressのフォーマットが不正です。";
}

$auther->login_chk();

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
    <?php if(   !empty($errors['usres_name']) ||
                !empty($errors['mail_address']) ||
                !empty($errors['pass_word']) ) { ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach($errors['users_name'] as $error) {?>
                <?php echo $error; ?><br>
            <?php } ?>
            <?php foreach($errors['mail_address'] as $error) {?>
                <?php echo $error; ?><br>
            <?php } ?>
            <?php foreach($errors['pass_word'] as $error) {?>
                <?php echo $error; ?><br>
            <?php } ?>
        </div>

        <form method="POST" action="./update_check.php">
        <input type="hidden" name="users_id" value="<?php echo $users_id; ?> ">
                <div class="mb-3">
            <label for="users_name" class="form-label">user_name</label>
            <input type="text" class="form-control <?php if( !empty($errors['users_name']) )echo "border-danger text-denger"; ?>" id="name" name="users_name" aria-describedy="emailHelp" value="<?php echo $users_name; ?>">
        </div>
        <div class="mb-3">
            <label for="mail_address" class="form-label">mail_address</label>
            <input type="email" class="form-control <?php if( !empty($errors['mail_address']) )echo "border-danger text-denger"; ?>"  id="email" name="mail_address"aria-describedy="emailHelp" value ="<?php echo $mail_address; ?>">
        </div>
        <div class="mb-3">
            <label for="pass_word" class="form-label">password</label>
            <input type="password" class="form-control <?php if( !empty($errors['pass_word']) )echo "border-danger text-denger"; ?>" id="id" name="pass_word">
        </div>
        <button type="submit" class="btn btn-primary">sgin in</button>
        </form>  
    <?php } else { ?>
        <form method="POST" action="./update_comp.php">
        <input type="hidden" name="users_id" value="<?php echo $users_id; ?> ">
        <div class="mb-3">
            <label for="users_name" class="form-label">user_name</label>
            <input type="text" class="form-control" readonly id="exampleInputName" name="users_name" aria-describedy="emailHelp" value="<?php echo $users_name; ?>">
        </div>
        <div class="mb-3">
            <label for="mail_address" class="form-label">mail_address</label>
            <input type="email" class="form-control"  readonly id="exampleInputemail" name="mail_address"aria-describedy="emailHelp" value ="<?php echo $mail_address; ?>">
        </div>
        <div class="mb-3">
            <label for="pass_word" class="form-label">password</label>
            <input type="password" class="form-control" readonly id="xampleInputPassword" name="pass_word" value ="<?php echo $pass_word; ?>">
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
        </form>  


        <form method="POST" action="./update.php">
        <input type="hidden" name="users_id" value="<?php echo $users_id; ?> ">
        <input type="hidden" class="form-control" readonly id="name" name="user_name" aria-describedy="emailHelp" value="<?php echo $user_name; ?>">
        <input type="hidden" class="form-control" readonly  id="mail" name="mail_address"aria-describedy="emailHelp" value ="<?php echo $mail_address; ?>">
        <input type="hidden" class="form-control" readonly id="password" name="pass_word" value ="<?php echo $pass_word; ?>">
        <button type="submit" class="btn btn-primary">Back</button>

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