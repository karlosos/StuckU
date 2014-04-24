<?php
/**
 * Plik z konfiguracja bazy danych
 * @package config
 * @author Karol Dzialowski
 */

$host = "localhost";        // Nazwa hosta
$login = "root";            // Login
$passwd = "";               // Haslo
$db = "stucku";             // Baza danych

/*
 * Includujemy klase bazy danych i tworzymy jej obiekt
 */
include 'db.php';
$db = new db(); 

/*
 * Laczymy sie z baza danych
 */
$db->connect($host, $login, $passwd, $db);