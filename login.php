<?php
session_start();
if(isset($_SESSION['user']))
{
    redirect('index.php');
}

$error;
if(isset($_SESSION['login_error']))
{
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class='bold-line'></div>
<div class='container'>
  <div class='window'>
    <div class='overlay'></div>
    <div class='content'>
    <?php if(isset($_GET['register'])) :  ?>
        <span class="success">Sikeres regisztráció!</span>
    <?php endif ?>
    <?php if(isset($error)) :  ?>
        <span class="error"><?=$error?></span>
    <?php endif ?>
      <div class='welcome'>Jelentkezz be!</div>
      <div class='input-fields'>
        <form action="./queries/login_query.php" method="post">
            <input type='text'name="username" id="username" placeholder='Felhasználónév' class='input-line full-width'></input>
            <input type='password'name="password" id="password" placeholder='Jelszó' class='input-line full-width'></input>
            <div><button type="submit" class='ghost-round full-width'>Bejelentkezés</button></div>
          </form>
        </div>
        <div class="subtitle">Ha még nincs fiókod, regisztrálj be!</div> <br>
      <a href="register.php"><div><button class='ghost-round full-width'>Regisztráció</button></div></a>
    </div>
  </div>
</div>
</body>
</html>
