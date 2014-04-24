<?php

/**
 * Plik z klasa layout
 * @package class
 * @author Karol Dzialowski
 */

/**
 * Klasa odpowiada za wczytywanie layoutu
 */
class layout {

    /**
     * Wyswietla gore
     */
    public function getTop() {
        include 'includes/overlay/top.php';
    }

    /**
     * Wyswietla gore dla admina
     */
    public function getTopAdm() {
        include 'includes/overlay/top_adm.php';
    }

    /**
     * Wyswietla dol
     */
    public function getBottom() {
        include 'includes/overlay/bottom.php';
    }

    /**
     * Zwraca keywords
     * @return string
     */
    static public function getKeywords() {
        $query = mysql_query("SELECT `keywords` FROM `info` WHERE `id` = '0'");
        return mysql_result($query, 0, 'keywords');
    }

    /**
     * Zwraca opis
     * @return string
     */
    static public function getDescription() {
        $query = mysql_query("SELECT `description` FROM `info` WHERE `id` = '0'");
        return mysql_result($query, 0, 'description');
    }

    /**
     * Zwraca tytul
     * @return string
     */
    static public function getTitle() {
        $query = mysql_query("SELECT `title` FROM `info` WHERE `id` = '0'");
        return mysql_result($query, 0, 'title');
    }

    /**
     * Zwraca kod html menu
     * @return string html
     */
    static public function getMenu() {
        $query = mysql_query("SELECT `menu` FROM `info` WHERE `id` = '0'");
        return mysql_result($query, 0, 'menu');
    }

    /**
     * Wyswietla artykuly
     */
    public function getArticles() {
        include 'showarticles.php';
    }

    /**
     * Zwraca informacje o artykule
     * @param int $id
     * @return array
     */
    public function getArticleTop($id) {
        $news = Array();
        $news["title"] = title_from_id($id);
        $news["date"] = date_from_id($id);
        $news["author"] = author_from_id($id);

        return $news;
    }

    /**
     * Zwraca zawartosc artykulu
     * 
     * @param int $id
     * @return string
     */
    public function getArticleContent($id) {
        return content_from_id($id);
    }

    /**
     * Funkcja zwracajaca sidebar
     */
    public function getSidebar() {
        
    }

}
