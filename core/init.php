<?php

/**
 * Plik inicjujący
 * @package core
 * @author Karol Działowski
 */
session_start();

/*
 * Wymagane pliki
 */
require '\config.php';
require '\layout.php';
require '\validate.php';
require '\user.php';
require '\articles.php';
require '\comments.php';
require '\administrator.php';

/*
 * Tworzony obiekt użytkownika i tablica z błędami
 */
$user = new user();
$errors = array();

/*
 * Jeżeli jesteśmy zalogowani i niezbanowani tworzy tablicę z naszymi danymi
 */
if (logged_in() === true) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email');
    if (user_active($user_data['username']) === false) {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

/**
 * Funkcja wyświetla błędy
 * 
 * @param array $errors
 * @return html
 */
function output_errors($errors) {
    return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

/**
 * Funkcja logowania
 * 
 * @return bool
 */
function logged_in() {
    return (isset($_SESSION['user_id'])) ? true : false;
}

/**
 * Funkcja tworzy tablicę z naszymi danymi
 * 
 * @param int $user_id
 * @return array
 */
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

/**
 * Funkcja sprawdza czy użytkownik jest aktywny
 * 
 * @param string $username
 * @return bool
 */
function user_active($username) {
    $username = sanitize($username);
    $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1");
    return (mysql_result($query, 0) == 1) ? true : false;
}

/**
 * Funkcja aktualizuje tytuł
 * 
 * @param string $title
 */
function update_title($title) {
    $title = sanitize($title);
    mysql_query("UPDATE info SET `title`='$title' WHERE `id`='0'");
}

/**
 * Funkcja aktualizuje opis
 * 
 * @param string $description
 */
function update_description($description) {
    $description = sanitize($description);
    mysql_query("UPDATE info SET `description`='$description' WHERE `id`='0'");
}

/**
 * Funkcja aktualizuje kluczowe słowa
 * 
 * @param string $keywords
 */
function update_keywords($keywords) {
    $keywords = sanitize($keywords);
    mysql_query("UPDATE info SET `keywords`='$keywords' WHERE `id`='0'");
}
