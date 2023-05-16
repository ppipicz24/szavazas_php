<?php
include_once '../util.php';
session_start();
//TODO: Hibakezelés
if (!isset($_SESSION['user'])) redirect('../login.php');
function success($question, $options, $deadline, $needmore)
{
    add_polls($_SESSION['user'], $question, $options, $deadline, $needmore);
    redirect("../?add_poll=success");
}
function error($error)
{
    $_SESSION['add_poll_error'] = $error;
}
if (true) {
    success($_POST['question'], $_POST['options'], $_POST['deadline'], $_POST['needmore']);
} else {
    $error = "";
}

if (isset($error)) {
    error($error);
}