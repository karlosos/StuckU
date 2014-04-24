<?php

/**
 * Plik z klasa bazy danych
 * @package class 
 * @author Karol Dzialowski
 */

/**
 * Klasa reprezentująca bazę danych
 */
class db {

    /**
     * Funkcja laczenia sie z baza
     * 
     * @param string $server
     * @param string $login
     * @param string $password
     * @param string $database
     */
    public function connect($server, $login, $password, $database) {
        $connect_error = 'Przepraszamy za problemy';
        mysql_connect('localhost', 'root', '') or die($connect_error);
        mysql_select_db('stucku') or die($connect_error);
    }

}
