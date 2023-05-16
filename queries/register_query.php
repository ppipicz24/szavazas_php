<?php
include_once "../util.php";
session_start();
function success($username,$email,$password)
{
    //add to json
    add_users($username, $email, $password);
    redirect('../login.php?register=success');
}
function error($error)
{
    $_SESSION['register_error'] = $error;
    redirect('../register.php');
}

if(check_post_parameter('username'))
{
    if(check_post_parameter('email'))
    {
        if(check_post_parameter('password1'))
        {
            if (check_post_parameter('password2')) 
            {
                if($_POST['password1']===$_POST['password2'])
                {
                    if(!user_exists($_POST['username']))
                    {
                        if (!email_exists($_POST['email'])) 
                        {

                            if (correct_email($_POST['email'])) 
                            {
                                success($_POST['username'], $_POST['email'], $_POST['password1']);
                            } else {
                                
                                $error = "A megadott email cím nem megfelelő formátumú!";
                            }
                        }
                        else{
                            $error = "A megadott email cím már foglalt!";
                        }
                    }
                    else
                    {
                        $error="A megadott felhasznalonev mar foglalt!";
                    }
                }
                else{
                    $error="A megadott jelszavak nem egyeznek!";
                }
            }
            else
            {
                $error = "erősítsd meg a jelszót!";
            }
        }
        else
        {
            $error = "Adj meg egy jelszót!";
        }
    }
    else
    {
        $error = "Adj meg egy email címet!";
    }
}
else
{
    $error = "adj meg egy felhasználónevet!";
}

if(isset($error))
{
    error($error);
}
?>