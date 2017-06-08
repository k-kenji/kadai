<?php
include('head.html');
session_start();

$bkname = $_POST["bkname"];
$bkurl = $_POST["bkurl"];
$bkcomment = $_POST["bkcomment"];


try {
  //XAMPPはpassは未指定、ID名のデフォルトはroot、サーバーをレンタルすると送られてくる
  $pdo = new PDO('mysql:dbname=gs_db13;charset=utf8;host=localhost','root','');  //接続完了
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
  //"DbConnectError"の部分は変えられる
}

$stmt = $pdo->prepare("INSERT INTO gs_book(id, bkname, bkurl, bkcomment,
indate )VALUES(NULL, :bkname, :bkurl, :bkcomment, sysdate())");
$stmt->bindValue(':bkname', $bkname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bkurl', $bkurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bkcomment', $bkcomment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':flg', $flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();//ここにエラーが入る
  exit("QueryError:".$error[2]); //2番目を指定することで日本語でエラーが表示される（お決まり）
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php"); //:のあとに半角スペースを入れる
  exit;

}



 ?>
