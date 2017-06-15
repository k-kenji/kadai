<?php
//bookの削除



try {
  $pdo = new PDO('mysql:dbname=gs_db13;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//データ：delete文の書き方はこれしかない
$stmt = $pdo->prepare("DELETE FROM gs_book WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// エラー分
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  header("Location: index.php");
  exit;
}





 ?>
