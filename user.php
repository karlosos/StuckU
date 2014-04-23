<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Karol
 */
class user {

    static public function registerUser($register_data) {
            array_walk($register_data, 'array_sanitize');
            $register_data['password'] = md5($register_data['password']);

            $fields = '`' . implode('`, `', array_keys($register_data)) . '`';
            $data = '\'' . implode('\', \'', $register_data) . '\'';

            mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");

    }
    
    static public function login($username, $password) {
    $user_id = user::user_id_from_username($username);

    $username = sanitize($username);
    $password = md5($password);

    return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $user_id : false;
}
    static public function user_id_from_username($username) {
    $username = sanitize($username);
    $query = mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'");
    return mysql_result($query, 0, 'user_id');
}

    static public function user_moderator($username) {
    $username = sanitize($username);
    $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `moderator` = 1");
    return (mysql_result($query, 0) == 1) ? true : false;
}
}
