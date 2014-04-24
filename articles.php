<?php
/**
 * Funkcje odpowiadajace za artykuly
 * 
 * Wszystkie funkcje sluzace do dodawania, usuwania, aktualizowania i weryfikacji
 * 
 * @package functions
 * @author Karol Dzialowski
 * @copyright (c) 2014, Karol Działowski https://github.com/karlosos/SharU
 */

/**
 * Dodawanie artykulu
 * 
 * Funkcja laczy tablice w jeden string za pomoca implode() (wytlumaczone w pliku
 * od nauczyciela php.docx). Nastepnie wysyla zapytanie z zadaniem dodania artykulu.
 * 
 * @param void $article_data tablica z artykulem
 */
function add_article($article_data) {
    array_walk($article_data, 'array_sanitize');

    $fields = '`' . implode('`, `', array_keys($article_data)) . '`';
    $data = '\'' . implode('\', \'', $article_data) . '\'';

    mysql_query("INSERT INTO `articles` ($fields) VALUES ($data)");
}

/**
 * Aktualizawanie artykulu
 * 
 * Funkcja kazdy elementu tablicy $article_data przepuszcza przez funkcje array_sanitize
 * znajdujaca sie w pliku core/functions/general.php. Nastepnie aktualizuje wpis.
 * @param int $article_id Numer id artykulu
 * @param array $article_data Tablica z danymi do aktualizacji
 */
function update_article($article_id, $article_data) {
    array_walk($article_data, 'array_sanitize');
    $title = $article_data['title'];
    //$excerpt = $article_data['excerpt'];
    $content = $article_data['content'];
    mysql_query("UPDATE articles SET `title`='$title', `content`='$content' WHERE `id` = '$article_id'");
}

/**
 * Usuwanie artykulu
 * 
 * Funkcja przepuszcza argument przez funkcje sanitize znajdujaca sie w general.php 
 * Nastepnie usuwa dany wpis
 * @param int $article_id Numer id artykulu
 */
function delete_article($article_id) {
    $article_id = sanitize($article_id);
    //echo "DELETE FROM `articles` WHERE `id` = '$article_id'";
    mysql_query("DELETE FROM `articles` WHERE `id` = '$article_id'");
}

/**
 * Zwraca tytul z danego id
 * 
 * @param int $article_id Numer id artykulu
 * @return string Tytul artykulu
 */
function title_from_id($article_id) {
    $article_id = sanitize($article_id);
    $query = mysql_query("SELECT `title` FROM `articles` WHERE `id` = '$article_id'");
    return mysql_result($query, 0, 'title');
}

/**
 * Zwraca skrot artykulu z danego id
 * 
 * @param int $article_id Numer id artykulu
 * @return string Skrot artykulu
 */
function excerpt_from_id($article_id) {
    $article_id = sanitize($article_id);
    $query = mysql_query("SELECT `excerpt` FROM `articles` WHERE `id` = '$article_id'");
    return mysql_result($query, 0, 'excerpt');
}

/**
 * Zwraca tekst artykulu z danego id
 * 
 * @param int $article_id Numer id artykulu
 * @return string Tekst artykulu
 */
function content_from_id($article_id) {
    $article_id = sanitize($article_id);
    $query = mysql_query("SELECT `content` FROM `articles` WHERE `id` = '$article_id'");
    return mysql_result($query, 0, 'content');
}

/**
 * Zwraca autora artykulu z danego id
 * 
 * @param int $article_id Numer id artykulu
 * @return string Autor artykulu
 */
function author_from_id($article_id) {
    $article_id = sanitize($article_id);
    $query = mysql_query("SELECT `author` FROM `articles` WHERE `id` = '$article_id'");
    return mysql_result($query, 0, 'author');
}

/**
 * Zwraca date artykulu z danego id
 * 
 * @param int $article_id Numer id artykulu
 * @return string Data artykulu
 */
function date_from_id($article_id) {
    $article_id = sanitize($article_id);
    $query = mysql_query("SELECT `date` FROM `articles` WHERE `id` = '$article_id'");
    return mysql_result($query, 0, 'date');
}

?>