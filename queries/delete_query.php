<?php 
include_once '../util.php';
session_start();

function success($username, $pollid)
{
    $_SESSION['user'] = $username;
    $_SESSION['delete_success'] = "Sikeres törlés!";
    //redirect to index.php
    remove_poll($username, $pollid);
    redirect('../index.php');
}

$polls = read_json("../json/polls.json");
foreach($polls as $pollname => $poll)
{
    foreach($poll as $key => $value)
    {
        if(isset($_SESSION['user']) && isset($_POST['id']))
        {
        if($value['id'] == $_get['question']) 
        {
            success($_SESSION['user'], $_POST['id']);
        }
    }
}
}

?>