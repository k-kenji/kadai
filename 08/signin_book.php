<?php include('head.html'); ?>
<?php
require 'password_compat-master/lib/password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "";  // ユーザー名のパスワード
$db['dbname'] = "gs_db13";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["login_email"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーID、メールアドレスが未入力です。';
    } else if (empty($_POST["login_pass"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["login_email"]) && !empty($_POST["login_pass"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["login_email"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        // $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
          // データ取得
          // $pdo = new PDO('mysql:dbname=gs_db13;charset=utf8;host=localhost','root','');  //接続完了
            // $stmt = $pdo->prepare('SELECT * FROM userData WHERE id = ?');
            $pdo = new PDO('mysql:dbname=gs_db13;charset=utf8;host=localhost','root','');

            $stmt = $pdo->prepare('SELECT * FROM gs_userdata WHERE email = ?');
            $stmt->execute(array($userid));

            $password = $_POST["login_pass"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $email = $row['email'];
                    $sql = "SELECT * FROM gs_userdata WHERE email = $email";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION["NAME"] = $row['name'];
                    header("Location: index.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'メールアドレスあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $errorMessage = $sql;
            $e->getMessage();// でエラー内容を参照可能（デバック時のみ表示）
            echo $e->getMessage();
        }
    }
}
?>










<!DOCTYPE html>
<html lang="ja">
  <head>
     <meta charset="utf-8">
     <title>book share</title>
     <!-- 特定のブラウザでデザインを崩さないため -->
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- BootstrapのCSS読み込み -->
     <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/master.css">
     <!-- jQuery読み込み -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- BootstrapのJS読み込み -->
     <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img class="profile-img-card" src="img/top.png" alt="" />
            <!-- <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="" method="post">
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <span id="reauth-email" class="reauth-email"></span>
                <!-- メールアドレス -->
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="login_email" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>" required autofocus>
                <!-- pass -->
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="login_pass" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login">Sign in</button>
            </form><!-- /form -->
            <a href="signup_book.php" class="forgot-password">
                Go to Sign Up
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script src="js/boost1.js"></script>
  </body>
</html>
