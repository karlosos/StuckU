<?php

function array_sanitize(&$item) {
    $item = mysql_real_escape_string($item);
}

function sanitize($data) {
    return mysql_real_escape_string($data);
}

function ifSpaces($data) {
    if (preg_match("/\\s/", $data) == true) 
            return true;
    else  {
        $errors[] = 'Twój login nie może zawierać spacji.';
    }            
}

function longerThan($data, $number) {
    if(strlen($data) < $number) {
        return true;
    } 
    else {
        $errors[] = 'Hasło musi być dłuższe niż '.$number.' znaki';
    }
}

function ifPasswdMatch($passwd, $passwd2) {
    if($passwd === $passwd2) 
        return true;
    else {
        $errors[] = 'Podane hasła nie pasują do siebie.';
    }
}

function checkMail($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
            return true;
    else {
        $errors[] = 'Nieprawidłowy email.'; 
    }
}

function userExists($username) {
    $username = sanitize($username);
    $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'");
    return (mysql_result($query, 0) == 1) ? true : false;
}

function emailExists($email) {
    $email = sanitize($email);
    $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'");
    return (mysql_result($query, 0) == 1) ? true : false;
}