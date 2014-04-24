<?php
/**
 * Funkcje odpowiadajace za komentarze
 * 
 * Wszystkie funkcje sluzace do dodawania, usuwania, aktualizowania i aktywowania
 * 
 * @package functions
 * @todo funkcja akualizowania komentarzy
 * @author Karol Dzialowski
 * @copyright (c) 2014, Karol Działowski https://github.com/karlosos/SharU
 */

/**
 * Funkcja dodaje komentarz
 * 
 * Funkcja przechodzi po całej tablicy, zabezpiecza ją i scala w dwa łańcuchy
 * @param array $comment_data
 */
function add_comment($comment_data) {
    array_walk($comment_data, 'array_sanitize');

    $fields = '`' . implode('`, `', array_keys($comment_data)) . '`';
    $data = '\'' . implode('\', \'', $comment_data) . '\'';

    mysql_query("INSERT INTO `comments` ($fields) VALUES ($data)");
}

/**
 * Funkcja usuwa komentarz 
 * 
 * @param string $comment_id
 * @todo Jeszcze to nie ma zastosowania
 */
function delete_comment($comment_id) {
    $comment_id = sanitize($comment_id);
    mysql_query("DELETE FROM `comments` WHERE `id` = '$comment_id'");
}

function delete_all_comments() {
    $comment_id = sanitize($comment_id);
    mysql_query("DELETE FROM `comments` WHERE `active` = '0'");
}

/**
 * Funkcja aktywuje komentarz
 * 
 * @param string $comments
 */
function active_comment($comments) {
    foreach($comments as $id) {
        mysql_query("UPDATE `comments` SET `active`='1' WHERE id =".$id);
    }
}