<?php
include_once '../util.php';
session_start();

function success($username)
{
    //write username to the session
    $_SESSION['user'] = $username;
    //redirect to index.php
    redirect('../index.php');
}

function error($error)
{
    //write to message to session
    $_SESSION['login_error'] = $error;
    //redirect to login
    redirect('../login.php');
}
if(check_post_parameter('username'))
{
    if(check_post_parameter('password'))
    {
        if(user_exists($_POST['username']))
        {
            if (get_password($_POST['username'])===$_POST['password'])
            {
                success($_POST['username']);
            }
            else
            {
                $error = "A megadott jelszó helytelen";
            }
        }
        else
        {
            $error = "A felhasználó nem létezik!";
        }
    }
    else
    {
        $error = "Adj meg jelszót!";
    }
}
else
{
    $error = "Adj meg egy felhasználónevet!";
}

if(isset($error))
{
    error($error);
}
?>