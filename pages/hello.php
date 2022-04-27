<?php

if (!LoggedIn()) {
  header('Location: /login');
  die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
    <title>Hello</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="parent">
        <div class="welcome">
            <img id="logo2" src="<?= GetAvatar() ?>" alt="">
            <h1><?= GetUserName() ?></h1>
            <span>welcome to this page..</span>
        </div>

    </div>
</body>

</html>