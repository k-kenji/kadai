<?php include('head.html'); ?>
<?php
session_start();

if(!isset($_SESSION["NAME"])) {
  header("Location: logout_book.phph");
  exit;
}
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db13;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_book");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<th scope="row">';
    $view .= $result["id"];
    $view .= '</th>';
    $view .= '<td>';
    $view .= $result["bkname"];
    $view .= '</td>';
    $view .= '<td>';
    $view .= '<a href="';
    $view .= $result["bkurl"];
    $view .= '" target="_blank">';
    $view .= $result["bkurl"];
    $view .= '</a>';
    $view .= '</td>';
    $view .= '<td>';
    $view .= $result["indate"];
    $view .= '</td>';
    $view .= '<td>';
    $view .= $result["bkcomment"];
    $view .= '</td>';
    $view .= '<td>';
    $view .= '　';
    $view .= '<a href="delete_book.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '</td>';
    $view .= '</tr>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>book share</title>
<meta charset="utf-8">
<!-- 特定のブラウザでデザインを崩さないため -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Sample</title>
<!-- BootstrapのCSS読み込み -->
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/master.css">
<!-- sweetalert -->
<link rel="stylesheet" type="text/css" href="js/sweetalert-master/dist/sweetalert.css">
<!-- jQuery読み込み -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- BootstrapのJS読み込み -->
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<!-- sweetalert -->
<script src="js/sweetalert-master/dist/sweetalert.min.js"></script>
<title>書籍管理</title>
</head>
<body>
  <table class="table table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>書籍番号</th>
      <th>書籍名</th>
      <th>書籍購入</th>
      <th>登録日時</th>
      <th>書評</th>
    </tr>
  </thead>
  <tbody>
    <?php echo $view ?>
  </tbody>
</table>
</body>
</html>
