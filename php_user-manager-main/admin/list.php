<?php

  require_once __DIR__ . "/classes/Auther.class.php";
  require_once __DIR__ . "/classes/Users.class.php";

    $auther = new Auther();
    $Users = new Users();
    $UserList = $Users->getList();
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

    <title>ユーザーリスト　管理画面</title>
  </head>
  <body>
    <h1>ユーザーリスト　管理画面</h1>
    <table class ="table = table">
    <thead>
      <th scope="col">ユーザーID</th>
      <th scope="col">ユーザー名</th>
      <th scope="col">作成日時</th>
      <th scope="col">更新日時</th>
  </thead>
  <tbody>
    <?php foreach($UserList as $Users) { ?>
      <tr>
          <td><?php echo $Users['users_id']; ?></td>
          <td>
            <a href="detail.php?users_id=<?php echo $Users['users_id']; ?>">
              <?php echo $Users['users_name']; ?>
            </a>
          </td>
          <td><?php echo date('Y/m/d H時i分' , $Users['create_dt'] ); ?></td>
          <td><?php echo $Users['upate_dt']; ?></td>
      </tr>
    <?php } ?>
  </tbody>
  </table>
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