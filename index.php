<?php
/**
 * @package name
 */
/**
 * Plik index
 * @package website
 * @author Karol Dzialowski
 */
/*
 * Includujemy inicjalizacyjny pli
 */
include 'core\init.php';

/*
 * Wyswietlamy gore
 */
$layout = new layout();
$layout->getTop();

/*
 * Wyswietlamy artykuly
 */
$layout->getArticles();

/*
 * Wyswietlamy dol strony
 */
$layout->getBottom();

