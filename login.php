<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- タイトル -->
    <title>Let's make a playlist!</title>
</head>
<body class="body_login_color">
  <h1>Let's make a playlist!</h1>
  <div class="login-page">
    <!-- 登録・ログイン -->
    <div class="form" id="login_register_area">
      <!-- 登録フォーム -->
      <form class="register-form" name="register_form" action="user_insert.php" method="post">
        <p>アカウント登録</p>
        <input type="text" placeholder="ユーザID" name="lid"/>
        <input type="text" placeholder="名前" name="name"/>
        <input type="password" placeholder="パスワード" name="lpw"/>
        <button type="submit" id="register_btn" class="login_btn_color">登録</button>
        <p class="message">すでに登録されている場合 <a href="#" class="login_message_color">ログインする</a></p>
      </form>
      <!-- ログインフォーム -->
      <form class="login-form" name="login_form" action="login_act.php" method="post">
        <p>ログイン</p>
        <input type="text" placeholder="ユーザID" name="lid"/>
        <input type="password" placeholder="パスワード" name="lpw"/>
        <button type="submit" id="login_btn" class="login_btn_color">ログイン</button>
        <p class="message">まだ登録されていない場合 <a href="#" class="login_message_color">アカウント登録</a></p>
      </form>
    </div>
    <!-- スクリプト -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- 自作JS -->
    <script src="js/style.js" charset="utf-8"></script>
</body>
</html>