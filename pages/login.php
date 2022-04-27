<?php
if (LoggedIn()) {
  header('Location: /main');
  die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Discord Login Example</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
  <div class="parent">
    <div class="welcome">
      <a href="#"><img id="logo" src="assets/img/discord.png" alt=""></a>
      <h1>Discord Login</h1>
      <span>Hi, login with discord</span>
    </div>

    <form action="/discord" method="post">
      <div class="login">
        <input class="inp-cbx" id="cbx" type="checkbox" style="display: none;" required /><label class="cbx" for="cbx"><span><svg width="12px" height="9px" viewbox="0 0 12 9">
              <polyline points="1 5 4 8 11 1"></polyline>
            </svg></span><span>i accept the <a href="#">terms</a> or something...</span></label>
        <button class="btn">
          <img src="/assets/img/discord.png" alt="">
          <input type="text" name="action" value="login" style="display: none;">
          <span>Login with Discord</span>
        </button>
      </div>
    </form>
  </div>
</body>

</html>