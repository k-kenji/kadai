<?php include('head.html'); ?>
<?php
session_start();

if (isset($_SESSION["NAME"])) {
  $errorMessage = "ログアウト";
} else {
  $errorMessage = "";
}

//セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();
 ?>

 <!doctype html>
 <html>
     <head>
         <meta charset="UTF-8">
         <title>ログアウト</title>
     </head>
     <body>
         <h1><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></h1>
     </body>
 </html>
