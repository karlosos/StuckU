<?php
session_start();

require '\config.php';
require '\layout.php';
require '\validate.php';
require '\user.php';

$user = new user();
$errors = array();

if (logged_in() === true) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email');
    if (user_active($user_data['username']) === false) {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

function output_errors($errors) {
    return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

function logged_in() {
    return (isset($_SESSION['user_id'])) ? true : false;
}

function user_data($user_id) {
    $data = array();
    $user_id = (int) $user_id;

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if ($func_num_args > 1) {
        unset($func_get_args[0]);

        $fields = '`' . implode('`, `', $func_get_args) . '`';
        $data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id"));
        return $data;
    }
}

function user_active($username) {
    $username = sanitize($username);
    $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1");
    return (mysql_result($query, 0) == 1) ? true : false;
}