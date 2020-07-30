<?php

mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])) {
  try {
    $pdo = new PDO("mysql:dbname=kairi; host=localhost;","root","");
  } catch(PDOException $e) {
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>");
  }

  $stmt = $pdo->prepare("select * from login_mypage where mail=? && password=?");

  $stmt->bindValue(1,$_POST['mail']);
  $stmt->bindValue(2,$_POST['password']);

  $stmt->execute();
  $pdo = NULL;

  while($row = $stmt->fetch()) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];
  }

  if (empty($_SSESION['id'])) {
    header('Location:login_error.php');
  }
  
  if(!empty($_SESSION['id']) && !empty($_POST['login_keep'])) {
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',true,time()+60*60*24*7);
  } else {
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage.css">
  </head>
  <body>
    <header>
      <img src="4eachblog_logo.jpg">
      <div class="logout"><a href="log_out.php">ログアウト</a></div>
    </header>
    <main>
      <div class="form">
        <div class="form_contents">
          <h2>会員情報</h2>
          <div class="main_text">
            <p>こんにちは！　<?php echo $_SESSION['name']; ?>さん</p>
            <div class="profile">
              <img src="<?php echo $_SESSION['picture']; ?>">
              <div class="name">
                <label>氏名：</label><p><?php echo $_SESSION['name']; ?></p>
              </div>
              <div class="mail">
                <label>メール：</label><p><?php echo $_SESSION['mail']; ?></p>
              </div>
              <div class="password">
                <label>パスワード：</label><p><?php echo $_SESSION['password']; ?></p>
              </div>
            </div>  
            <div class="comments">
              <p><?php echo $_SESSION['comments']; ?></p>
            </div>
            <form action="mypage_hensyu.php" method="post" class="form_center">
              <input type="hidden" value="<?php echo rand(1,10); ?>" name="form_mypage">
              <div class="button">
                <input type="submit" class="submit_button" size="35" value="編集する">
              </div>
            </form>
          </div>    
        </div>  
      </div>
    </main>
    <footer>
    @2018 InterNous.inc All rights reserved
    </footer>
  </body>
</html>