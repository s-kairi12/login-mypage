<?php
mb_internal_encoding("utf8");
session_start();

if (empty($_POST['form_mypage'])) {
  header('Location:login_error.php');
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
  </head>
  <body>
    <header>
      <img src="4eachblog_logo.jpg">
      <div class="logout"><a href="log_out.php">ログアウト</a></div>
    </header>
    <main>
      <form action="mypage_update.php" method="post">
        <div class="form_contents">
          <h2>会員情報</h2>
          <div class="main_text">
            <p>こんにちは！　<?php echo " ".$_SESSION['name']."さん"?></p>
            <div class="profile">
              <img src="<?php echo $_SESSION['picture']; ?>">
              <div class="name">
                <label>氏名：</label><input type="text" size="20" value="<?php echo $_SESSION['name']; ?>" name="name" required>
              </div>
              <div class="mail">
                <label>メール：</label><input type="text" size="20" value="<?php echo $_SESSION['mail']; ?>" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
              </div>
              <div class="password">
                <label>パスワード：</label><input type="text"  size="20" value="<?php echo $_SESSION['password']; ?>" name="password" pattern="^[a-zA-Z0-9]{6,}$" required>
              </div>
            </div>  
            <div class="comments">
              <textarea cols="65" rows="6" name="comments"><?php echo $_SESSION['comments']; ?></textarea>
            </div>
            <div class="button">
              <input type="submit" class="submit_button" size="35" value="この内容に変更する">
            </div>  
          </div>    
        </div>
      </form> 
    </main>
    <footer>
    @2018 InterNous.inc All rights reserved
    </footer>
  </body>
</html>