<?php
include_once '../util.php';
session_start();
function success(){

    $_SESSION['vote_success'] = "Sikeres szavazás!";
    redirect('../index.php');
}

function error($error){
    $_SESSION['vote_error'] = $error;
    redirect('../vote.php?question='.$_POST['id'].'');
}

if (isset($_SESSION['user']) && isset($_POST['id'])) {
    if(isset($_POST['options']))
    {
        success();
        
    } else {
        error("Nem adtál meg választ!");
    }
} 

if(isset($error)){
    error($error);
}
?>