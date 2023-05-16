<?php
session_start();
include_once 'util.php';
if(isset($_SESSION['user']))
{
    redirect('index.php');
}

$error;
if(isset($_SESSION['register_error']))
{
    $error = $_SESSION['register_error'];
    unset($_SESSION['register_error']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class='bold-line'></div>
<div class='container'>
  <div class='window'>
    <div class='overlay'></div>
    <div class='content'> 
        <div class='welcome'>Regisztráció</div>
        <div class='input-fields'>
            <form action="./queries/register_query.php" method="post">
                <input type="text" name="username" id="username" placeholder='Felhasználónév' class='input-line full-width'>
                <input type="text" name="email" id="email" placeholder='Email cím' class='input-line full-width'>
                <input type="password" name="password1" id="password1" placeholder='Jelszó' class='input-line full-width'>
                <input type="password" name="password2" id="password2" placeholder='Jelszó mégegyszer' class='input-line full-width'>
                <button type="submit"class='ghost-round full-width'>Regisztráció</button>
            </form>
            <a href="login.php"><div><button name="done" id="done" class='ghost-round full-width'>Már van fiókom</button></div></a>
        </div>
        <?php if(isset($error)) : ?>
            <span class="error"><?= $error ?></span>
            <?php endif ?>
            <footer>⚠ Az oldal nem használ biztonságos kommunikációt, és plain textként tárolja a jelszavad a szerveren. <br />
        <b>Ne adj meg szenzitív adatokat, vagy olyan jelszót, amit máshol is használsz!</b>
    </footer>
    </div>
  </div>
</div>
</body>
</html>