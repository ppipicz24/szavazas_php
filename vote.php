<?php 
session_start();
include_once 'util.php';
$logged_in = isset($_SESSION['user']);
$polls = read_json("./json/polls.json");

$error;
if(isset($_SESSION['vote_error']))
{
    $error = $_SESSION['vote_error'];
    unset($_SESSION['vote_error']);
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szavazás</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class='bold-line'></div>
<div class='container'>
    <div class='window2'>
    <div class='overlay2'></div>
    <div class='content'>
    <?php include_once 'navigation.php' ?>
    <?php if(isset($error)) : ?>
        <span class="error"><?= $error ?></span>
    <?php endif ?>
    
            <?php foreach($polls as $pollname => $poll) : ?>
                <?php foreach($poll as $key => $value) : ?>
                    <?php if($value["id"] == $_GET['question']) : ?>
                        <h1><?= $value["question"] ?></h1>

                <form action="./queries/poll_query.php" method="post">
                    <?php if($value["isMultiple"]==true) :?>
                        <?php foreach($value["options"] as $option) : ?>
                            <input type="checkbox" name="options" value="options"><?= $option ?><br>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <?php foreach($value["options"] as $option) : ?>
                            <?= $option ?><input type="radio" name="options" value="options"><br>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <br>
                    <input type="hidden" name="id" value="<?= $value['id'] ?>">
                    <button type="submit" class='ghost-round'>Szavazok</button>
                </form>
                <button class='ghost-round' onclick="window.location.href='index.php'">Vissza a kezdőoldalra</button>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>