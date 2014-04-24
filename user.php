<?php

/**
 * Plik z klasa user
 * @package class
 * @author Karol Dzialowski
 */

/**
 * Klasa user
 */
class user {

    /**
     * Funkcja rejestrujaca
     * @param array $register_data
     */
    static public function registerUser($register_data) {
        array_walk($register_data, 'array_sanitize');
        $register_data['password'] = md5($register_data['password']);

        $fields = '`' . implode('`, `', array_keys($register_data)) . '`';
        $data = '\'' . implode('\', \'', $register_data) . '\'';

        mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
    }

    /**
     * Funkcja logujaca
     * 
     * @param string $username
     * @param string $password
     * @return bool
     */
    static public function login($username, $password) {
        $user_id = user::user_id_from_username($username);

        $username = sanitize($username);
        $password = md5($password);

        return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $user_id : false;
    }

    /**
     * Pobiera id z username
     * @param string $username
     * @return int
     */
    static public function user_id_from_username($username) {
        $username = sanitize($username);
        $query = mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'");
        return mysql_result($query, 0, 'user_id');
    }

    /**
     * Sprawdza czy ma prawa admina
     * @param string $username
     * @return bool
     */
    static public function user_moderator($username) {
        $username = sanitize($username);
        $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `moderator` = 1");
        return (mysql_result($query, 0) == 1) ? true : false;
    }

}
