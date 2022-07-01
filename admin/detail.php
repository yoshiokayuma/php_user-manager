<?php

    require_once __DIR__ . "/classes/Auther.class.php";
    require_once __DIR__ . "/classes/Users.class.php";

    $users_id = isset($_GET['users_id']) ? $_GET['users_id'] : "";

    $auther = new Auther();
    $Users = new Users();
    $User = $Users->getDetail($users_id);
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

    <title>ユーザー詳細情報　管理画面</title>
  </head>
  <body>
    <h1>ユーザー詳細情報　管理画面</h1>
    <table class ="table = table">
    <thead>
      <th scope="col">ユーザーID</th>
      <th scope="col">ユーザー名</th>
      <th scope="col">メールアドレス</th>
      <th scope="col">パスワード</th>
      <th scope="col">作成日時</th>
      <th scope="col">更新日時</th>
    </thead>
  <tbody>
      <tr>
          <td><?php echo $User['users_id']; ?></td>
          <td>
            <a href="detail.php?users_id=<?php echo $User['users_id']; ?>">
              <?php echo $User['users_name']; ?>
            </a>
          </td>
          <td><?php echo $User['mail_address']; ?></td>
          <td><?php echo str_repeat("・" ,6); ?></td>
          <td><?php echo  $User['create_dt'] ; ?></td>
          <td><?php echo $User['upate_dt']; ?></td>
      </tr>
  </tbody>
  </table>

  <form method="POST" action="update.php">
    <input type="hidden" name="users_id" value="<?php echo $User['users_id']; ?> ">
    <button type="submit" class="btn btn-info">編集画面へ</button> 
  </form>
  <form method="POST" action="delete_check.php">
    <input type="hidden" name="users_id" value="<?php echo $User['users_id']; ?> ">
    <button type="submit" class="btn btn-info">削除</button> 
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