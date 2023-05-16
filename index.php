<?php 
session_start();
include_once 'util.php';
$logged_in = isset($_SESSION['user']);
//if (!$logged_in) redirect('login.php');
//$user;
//$polls;
//if ($logged_in) {
  //  $user = $_SESSION['user'];
    //$polls = get_polls($user);

//}
$polls = read_json("./json/polls.json");
foreach($polls as $pollname => $poll) {
    /*foreach($poll as $key => $value)
    {
        rsort(date($value['createdAt']));
    }*/
    rsort($polls[$pollname]); // azért pollname alapjan mert a json fájlban amugyis növekvőben vannak a szavazatok létrehozás dátuma szerint.
}

$success;
if(isset($_SESSION['vote_success']))
{
    $success = $_SESSION['vote_success'];
    unset($_SESSION['vote_success']);
}
if(isset($_SESSION['delete_success']))
{
    $success = $_SESSION['delete_success'];
    //unset($_SESSION['delete_success']);
} 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kezdőlap</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class='bold-line'></div>
<div class='container'>
    <div class='window2'>
    <div class='overlay2'></div>
    <div class='content'>
    <?php include_once 'navigation.php' ?>
    <?php if(isset($success)) : ?>
        <span class="success"><?= $success ?></span>
    <?php endif ?>
    <?= $logged_in ? "<div class='welcome'>Üdvözöllek a szavazóoldalon, " . $_SESSION['user'] . "!</div>" : "<div class='welcome'>Üdvözöllek a szavazóoldalon!</div>" ?>
    <h2>A jelenleg elérhető szavazatok</h2>
        <table>
            <thead>
                <tr>
                    <th>Kérdés</th>
                    <th>Létrehozva</th>
                    <th>Lejárati idő</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($polls as $pollname => $poll) : ?>
                    <?php foreach($poll as $key => $value) : ?>
                        <?php if($value["deadline"] >= date("Y-m-d")) : ?>
                        <tr>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value["createdAt"] ?></td>
                            <td><?= $value["deadline"] ?></td>
                            <?php if(!$logged_in) : ?>
                            <td><a href="login.php?>"><button class='ghost-round'>Szavazás</button></a></td>
                            <?php elseif($logged_in  && $_SESSION['user']!="admin"):?>
                                <?php if(isset($_SESSION['vote_success'])) : ?>
                                    <td><a href="vote.php?question=<?= $value['id'] ?>"><button class='ghost-round'>Szavazat frissítése</button></a></td>
                                <?php else : ?>
                                <td><a href="vote.php?question=<?= $value['id'] ?>"><button class='ghost-round'>Szavazás</button></a></td>
                                <?php endif ?>
                            
                            <?php endif ?>
                            <?php if($logged_in && $_SESSION['user']=="admin") : ?>
                                <td><button class='ghost-round' action="">Szavazat módosítása</button></a></td>
                                <td><a href="./queries/delete_query.php?question=<?= $value['id'] ?>"><button class='ghost-round'>Törlés</button></a></td>
                            <?php endif ?>
                        </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endforeach ?>
            </tbody>
        </table>

    <h2>A már lejárt szavazatok</h2>
    <table>
            <thead>
                <tr>
                    <th>Kérdés</th>
                    <th>Létrehozva</th>
                    <th>Lejárati idő</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($polls as $pollname => $poll) : ?>
                    <?php foreach($poll as $key => $value) : ?>
                        <?php if($value["deadline"] < date("Y-m-d")) : ?>
                            
                        <tr>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value["createdAt"] ?></td>
                            <td><?= $value["deadline"] ?></td>
                        </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    </div>
</div>



</body>
</html>

