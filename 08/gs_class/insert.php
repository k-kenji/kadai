<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["email"]) || $_POST["email"]=="" ||
  !isset($_POST["pass"]) || $_POST["pass"]==""
){
  exit('ParamError');
}
if(isset($_POST['kanri_flg'])){
 $kanri_flg = 1;
}else{
 $kanri_flg = 0;
}
if(isset($_POST['life_flg'])){
 $life_flg = 1;
}else{
 $life_flg = 0;
}

//1. POSTデータ取得
$name = $_POST["name"];
$lid = $_POST["email"];
$lpw = $_POST["pass"];
// $kanri_flg = $_POST["kanri_flg"];
// $life_flg = $_POST["life_flg"];

//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db13;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg )VALUES(NULL, :a1, :a2, :a3, :a4, :a5)");
$stmt->bindValue(':a1', $name);
$stmt->bindValue(':a2', $lid);
$stmt->bindValue(':a3', $lpw);
$stmt->bindValue(':a4', $kanri_flg);
$stmt->bindValue(':a5', $life_flg);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit;
}
?>
