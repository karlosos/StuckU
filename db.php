<?php
/**
 * Klasa reprezentująca bazę danych
 *
 * @author Karol
 * @package classes
 */
class db {
    public function connect($server, $login, $password, $database) {
        $connect_error = 'Przepraszamy za problemy';
        mysql_connect('localhost', 'root', '') or die($connect_error);
        mysql_select_db('stucku') or die($connect_error);
    }
}
