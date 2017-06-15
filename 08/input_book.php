<?php
 include('head.html');
 //セッション開始
 session_start();
 ?>

<!DOCTYPE html>
<html>
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
    <title>書籍登録画面</title>
  </head>
  <body>
    <div class="row">
     <div class="col-md-6 col-md-offset-3">
        <form action="insert_book.php" method="post" class="form-horizontal">

          <div class="form-group">
            <!-- <label for="input_password" class="col-md-2 control-label"書籍名</label> -->
            <label for="input_name" class="col-md-2 control-label">書籍名</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="input_name" placeholder="書籍名を入力してください" name="bkname" /><br />
            </div>
          </div>

          <div class="form-group">
            <label for="input_url" class="col-md-2 control-label">書籍URL</label>
            <div class="col-md-10">
              <input type="url" class="form-control" id="input_url" placeholder="Amazonなどの商品urlを入力してください" name="bkurl" /></label><br />
            </div>
          </div>

          <div class="form-group">
            <label for="input_text" class="col-md-2 control-label">書評</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="input_text" placeholder="書評を入力してください" name="bkcomment" /></label><br />
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
              <button type="submit" class="btn btn-primary btn-block">登録</button>
            </div>

          </div>
      　</form>
  　 </div>
  </div>
  </body>
</html>
