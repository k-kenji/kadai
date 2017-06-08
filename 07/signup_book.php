<?php include('head.html'); ?>
<?php
require 'password_compat-master/lib/password.php';   // password_hash()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "";  // ユーザー名のパスワード
$db['dbname'] = "gs_db13";  // データベース名

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

// ログインボタンが押された場合
if (isset($_POST["signup"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["signup_name"])) {  // 値が空のとき
        $errorMessage = 'ユーザー名が未入力です。';
    } elseif (empty($_POST["signup_email"])) {
        $errorMessage = 'メールアドレスがが未入力です';
    } else if (empty($_POST["signup_pass"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["signup_pass2"])) {
        $errorMessage = 'パスワードが間違っています';
    }

    if (!empty($_POST["signup_name"]) && !empty($_POST["signup_pass"]) && !empty($_POST["signup_email"]) && !empty($_POST["signup_pass2"]) && $_POST["signup_pass"] === $_POST["signup_pass2"]) {
        // 入力したユーザIDとパスワードを格納
        $username = $_POST["signup_name"];
        $useremail = $_POST["signup_email"];
        $password = $_POST["signup_pass"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        // $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO('mysql:dbname=gs_db13;charset=utf8;host=localhost','root','');
            // $pdo = new PDO('mysql:dbname=gs_db13;charset=utf8;host=localhost','root','');  //接続完了

            $stmt = $pdo->prepare("INSERT INTO gs_userdata(name, email, password) VALUES (?, ?, ?)");

            $stmt->execute(array($username, $useremail, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。あなたの登録IDは '. $userid. ' です。ユーザー名は '. $username. ' です。メールアドレスは'. $useremail. 'です。';  // ログイン時に使用するIDとパスワード)
            header("Location: signin_book.php");


        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            $e->getMessage();
            echo $e->getMessage();
        }
    } else if($_POST["signup_pass"] != $_POST["signup_pass2"]) {
        $errorMessage = 'パスワードが一致していません';
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>book share</title>
        <!-- 特定のブラウザでデザインを崩さないため -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- BootstrapのCSS読み込み -->
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/signup_book.css">
        <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!-- jQuery読み込み -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- BootstrapのJS読み込み -->
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script src="js/signup_book.js"></script>
        <!-- アラート -->
        <script src="js/sweetalert-master/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="js/sweetalert-master/dist/sweetalert.css">
    </head>
    <body>
            <div class="text-center" style="padding:50px 0">
      	<div class="logo">register</div>
      	<!-- Main Form -->
        <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
        <div><font color="#0000ff"><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
      	<div class="login-form-1">
      		<form id="register-form" class="text-left" name="loginForm" method="post">
      			<div class="login-form-main-message"></div>
      			<div class="main-login-form">
      				<div class="login-group">
      					<div class="form-group">
      						<label for="reg_username" class="sr-only">Email address</label>
      						<input type="text" class="form-control" id="username" name="signup_name" placeholder="username" value="<?php if (!empty($_POST["signup_name"])) {echo htmlspecialchars($_POST["signup_name"], ENT_QUOTES);} ?>">
      					</div>

                <div class="form-group">
      						<label for="reg_email" class="sr-only">Email</label>
      						<input type="text" class="form-control" id="reg_email" name="signup_email" placeholder="email">
      					</div>

      					<div class="form-group">
      						<label for="reg_password" class="sr-only">Password</label>
      						<input type="password" class="form-control" id="reg_password" name="signup_pass" placeholder="password">
      					</div>
      					<div class="form-group">
      						<label for="reg_password_confirm" class="sr-only">Password Confirm</label>
      						<input type="password" class="form-control" id="reg_password_confirm" name="signup_pass2" placeholder="confirm password">
      					</div>

      				</div>
      				<button type="submit" class="login-button" name="signup"><i class="fa fa-chevron-right" name="signup"></i></button>
      			</div>
      			<div class="etc-login-form">
      				<p>already have an account? <a href="signin_book.php">login here</a></p>
      			</div>
      		</form>
      	</div>
      	<!-- end:Main Form -->
      </div>

    </body>
</html>
