<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szavazat hozzáadása</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    form {
  display: flex;
  flex-direction: column;
  gap: 5px;
}
form * {
  display: block;
  width: 350px;
}
</style>

<body>
<div class='bold-line'></div>
<div class='container'>
    <div class='window2'>
    <div class='overlay2'></div>
    <div class='content'>
    <?php include 'navigation.php' ?>
    <h1>Szavazat hozzáadása</h1>
    <form action="./queries/add_poll_query.php" method="post">
        <label for="question">Kérdés:</label>
        <input type="text" name="question" id="question">
            <label for="options">Adj meg a választási lehetőségeket:</label>
            <input type="text" name="options" id="options">
            <label for="deadline">Add meg a lejárati időt:</label>
            <input type="text" name="deadline" id="deadline">
            Legyen több választási lehetőség?<input type="checkbox" name="needmore" id="needmore">
            <button type="submit" class='ghost-round'>Szavazat hozzáadása</button>
    </form>
    <button class='ghost-round' onclick="window.location.href='index.php'">Vissza a kezdőoldalra</button>
    
    </div>
    </div>
</div>

</body>

</html>