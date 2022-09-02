<?php
require_once __DIR__ . "/DBMySQLi.class.php";
class Users extends DBMySQLi {
    public function __construct()
    {
     parent::__construct();
    }
    public function getlist()
    {
     $returnAry = [];
     $query = "SELECT users_id ,users_name , create_dt , upate_dt FROM users ORDER BY users_id";
     $stmt = mysqli_prepare($this->db_link, $query);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_bind_result($stmt, $users_id ,$users_name , $create_dt , $upate_dt );
     while(mysqli_stmt_fetch($stmt)) {
        $returnAry[] = [
            'users_id' => $users_id ,
            'users_name' => $users_name ,
            'create_dt' => strtotime( $create_dt ) ,
            'upate_dt' => strtotime( $upate_dt ) ,
        ];
     }
     if(empty($returnAry)){
        return [];
     } else{
        return $returnAry;
     }
    }

    public function getDetail($users_id)
    {
       if(empty($users_id)) {
          throw new Exception("ユーザーIDが空です。");
       }
    $query = "SELECT users_id , users_name , mail_address , pass_word , create_dt , upate_dt FROM users WHERE users_id = ? LIMIT 1";
    $stmt = mysqli_prepare($this->db_link, $query);
    mysqli_stmt_bind_param($stmt, 'd', $users_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $users_id , $users_name , $mail_address , $pass_word , $create_dt , $upate_dt);
    mysqli_stmt_fetch($stmt);
 
    return [
       'users_id' => $users_id ,
       'users_name' => $users_name,
       'mail_address' => $mail_address ,
       'pass_word' => $pass_word ,
       'create_dt' => $create_dt ,
       'upate_dt' => $upate_dt ,
    ];
    
 }

   public function isdiplication($mail_address, $users_id = null)
{
   //メールアドレスの重複チェック
$query = "SELECT users_id  FROM users WHERE mail_address = ? AND users_id != ? LIMIT 1";
$stmt = mysqli_prepare($this->db_link, $query);
mysqli_stmt_bind_param($stmt, 'sd', $mail_address,$users_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $district);
mysqli_stmt_fetch($stmt);

if(empty($district)) {
   return true;
} else {
   return false;
   }
   }

   public function updateUser($users_id, $users_name, $mail_address, $pass_word = null)
   {
         //ユーザー更新
     if(!empty($pass_word)) {
        $query = "UPDATE users SET  users_name = ? , mail_address = ?, upate_dt = ? , pass_word = ? WHERE users_id = ?";
        $stmt = mysqli_prepare($this->db_link, $query);
        //パスワードを不可逆変換する
        $cry_pass_word = md5($pass_word);
        //現在日付を取得
        $now_dt = date("Y-m-d H:i:s");

        mysqli_stmt_bind_param($stmt, 'ssssd', $users_name , $mail_address , $cry_pass_word , $now_dt , $now_dt);
        mysqli_stmt_execute($stmt);
    }
    else{
        $query = "UPDATE users SET  users_name = ? , mail_address = ?, upate_dt = ? WHERE users_id = ?";
        $stmt = mysqli_prepare($this->db_link, $query);
        //現在日付を取得
        $now_dt = date("Y-m-d H:i:s");
        mysqli_stmt_bind_param($stmt, 'sssd', $users_name , $mail_address  , $upate_dt , $users_id);
        mysqli_stmt_execute($stmt);
   }
}

public function deleteUser($users_id)
   {
      $query = "DELETE FROM users  WHERE users_id = ? LIMIT 1";
      $stmt = mysqli_prepare($this->db_link, $query);
      mysqli_stmt_bind_param($stmt, 'd', $users_id);
      mysqli_stmt_execute($stmt);

   }

}





