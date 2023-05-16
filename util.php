<?php 
define('USER_PATH', __DIR__ . '/json/users.json');
define('POLL_PATH', __DIR__ . '/json/polls.json');

function redirect($destination){
    header("Location: " . $destination);
    die;
}

function check_post_parameter($field)
{
    return isset($_POST[$field]) && trim($_POST[$field]) != "";
}

function read_json($sourse, $associative=true)
{
    return json_decode(file_get_contents($sourse), $associative);
}

function write_json($destination,$data )
{
    file_put_contents($destination, json_encode($data, JSON_PRETTY_PRINT));
}
function user_exists($username)
{
    $users = read_json(USER_PATH);
    $usernames = array_column($users, "username");
    return !(array_search($username, $usernames) === false);
}
function email_exists($email)
{
    $users = read_json(USER_PATH);
    $emails = array_column($users, "email");
    return !(array_search($email, $emails) === false);
}

function poll_exists($userid, $pollid)
{
    $polls = read_json(POLL_PATH);
    $pollids = array_column($polls, "id");
    return !(array_search($pollid, $pollids) === false);
}
function correct_email($email)
{
    if(preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email)) {
        return true;
    }
}

function add_users($username,$email, $password)
{
    $users = read_json(USER_PATH);
    $id = count($users) + 1;
    $isAdmin = false;
    if ($username == "admin") {
        $isAdmin = true;
    }
    $new_user = [ "username" => $username, "email"=>$email, "password" => $password, "isAdmin" => $isAdmin];
    $users[] = $new_user;
    write_json(USER_PATH, $users);
}

function add_polls($username, $question, $options, $deadline, $needmore)
{
    $polls = read_json(POLL_PATH);
    foreach($polls as $poll)
    {
        $id = count($poll) + 1;
    }
    $created = date("Y-m-d");
    if($needmore == 'on')
    {
        $needmore = true;
    }
    else{
        $needmore = false;
    }
    $voted = get_user($username);
    $new_poll = ["id" => $id, "question" => $question, "options"=>explode(',', $options), "isMultiple" => $needmore, "createdAt" => $created, "deadline" => $deadline, "answers"=>[$options=>0], "voted" => [$voted['username']]];
    $polls[$username][$id] = $new_poll;
    write_json(POLL_PATH, $polls);
}

function remove_poll($username, $pollid)
{
    $polls = read_json(POLL_PATH);
    $arrax_index = array();
    foreach($polls[$username] as $key => $poll)
    {
        if($poll['id'] == $pollid)
        {
            $arrax_index[] = $key;
        }
    }
    foreach($arrax_index as $index)
    {
        unset($polls[$username][$index]);
    }
    
    write_json(POLL_PATH, $polls);
}
function get_user($username)
{
    $users = read_json(USER_PATH);
    return current(array_filter($users, function ($element) use ($username) {
        return $element['username'] === $username;
    }));

}
function get_polls($id)
{
    $polls= read_json(POLL_PATH);
    if(key_exists($id, $polls))
    {

        return $polls[$id];
    }
    else{
        return null;
    }

}
function get_password($username)
{
    $user = get_user($username);
    return $user['password'];
}


/*function increment_polls($username, $pollid, $option)
{
    $polls = read_json(POLL_PATH);
    $polls[$username][$pollid]['options'][$option]++;
    write_json(POLL_PATH, $polls);
}*/
?>